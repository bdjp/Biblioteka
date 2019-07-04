<?php
    namespace App\Controllers;

    use App\Core\ApiController;
    use App\Models\BookModel;
    use App\Models\CategoryModel;
    use App\Models\ActiveModel;
    use App\Models\LibrarianModel;
    use App\Models\StudentModel;
    use App\Models\ReservationModel;
    use App\Validators\NumberValidator;

    class LibrarianReservApiController extends ApiController {

        private function respond($errorCode, $message = '', $data = null) {
             ob_clean();
            header('Content-type: application/json; charset=utf-8');
            echo json_encode([
                'error'   => $errorCode,
                'message' => $message,
                'data'    => $data
            ]);
            exit;
        }
    
        public function __pre() {
            if (!$this->getSession()->get('libId', null)) {
                $this->respond(-1001, 'You are not logged it!');
            }
        }

        public function postAdd() {
            $studUsername  = \filter_input(INPUT_POST, 'add_username',     FILTER_SANITIZE_STRING);
            $starts        = \filter_input(INPUT_POST, 'add_starts',       FILTER_SANITIZE_STRING);
            $ends          = \filter_input(INPUT_POST, 'add_ends' ,        FILTER_SANITIZE_STRING);
            $book_id       = \filter_input(INPUT_POST, 'book_id',          FILTER_SANITIZE_NUMBER_INT);
                   
            $starts .= ' 23:59:59';
            $ends   .= ' 23:00:00';

            $bm = new BookModel($this->getDatabaseConnection());
            $book = $bm->getById($book_id);
            
            if(!$book) {
                $this->respond(-1002, 'Ova knjiga ne postoji!');
            }

            $stanje = $book->active_id;

            if($stanje != 1) {
                $this->respond(-1003, 'Ova knjiga nije dostupna!');
            }

            $resm = new ReservationModel($this->getDatabaseConnection());
            // sve rezervacije za ovu knjigu
            $rezervacije = $resm->getAllByFieldName('book_id', $book_id);

            // izvlacimo poslednju rezervaciju
            $id_rez = 0;
            foreach ($rezervacije as $rez){
                    if($rez->reservation_id > $id_rez) {
                        $id_rez = $rez->reservation_id;
                    } 
            }
            // uzimamo informacije o poslednjoj rezervaciji
            $poslednja_rez = $resm->getByFieldName('reservation_id', $id_rez);
            if($poslednja_rez) {
                if($poslednja_rez->stud_res == 1) {
                    $this->respond(-1013, 'Ova knjiga je rezervisana! (Rezervacija traje 1 dan)');
                }

                if($poslednja_rez->returned == 0) {
                    $this->respond(-1014, 'Ova knjiga nije vracena!' . $starts);
                }

                
            }


           

            $sm = new StudentModel($this->getDatabaseConnection());
            $stud = $sm->getByFieldName('username', $studUsername);
   

            if($stud->username !== $studUsername) {
                $this->respond(-1004, 'Nepostoji student sa tim username-om! pocinje:' . $starts . 'a zavrsava se' . $ends);
            }
        
            if(strtotime($starts) < strtotime('now') ) {
                $this->respond(-1005, 'Pocetni datum ne moze biti pre danasnjeg datuma');
            }

            if(strtotime($ends) < strtotime('+7 days') ) {
                $this->respond(-1006, 'Najmanje trajanje zaduzenja je 7 dana');
            }
   
            
            
   
            $resId = $resm->add ([
                'created_at'        => $starts,
                'expires_at'        => $ends,
                'student_id'        => $stud->student_id,
                'librarian_id'      => $this->getSession()->get('libId'),
                'book_id'           => $book_id,
                'taken'             => 1
      
            ]);
            
            if(!$resId) {
                $this->respond(-1007, 'Doslo je do greske prilikom dodavanja ovog zaduzenja');
            }

            $message = 'Uspesno ste zaduzili knjigu';
                

            $this->respond(0, $message . '.', $resId);

            
    
        }

        public function postRemove() {
            $book_id       = \filter_input(INPUT_POST, 'skr_book_id',  FILTER_SANITIZE_NUMBER_INT);
            // ---------------- Razduzivanje knjige ---------------------// 
            
            $resm = new ReservationModel($this->getDatabaseConnection());
            // sve rezervacije za ovu knjigu
            $rezervacije = $resm->getAllByFieldName('book_id', $book_id);

            // izvlacimo poslednju rezervaciju
            $id_rez = 0;
            foreach ($rezervacije as $rez){
                if($rez->returned == 0) {
                    if($rez->reservation_id > $id_rez) {
                        $id_rez = $rez->reservation_id;
                    }
                }
            }

            $poslednja_rez = $resm->getByFieldName('reservation_id', $id_rez);

            // student koji je zaduzio
            $sm = new StudentModel($this->getDatabaseConnection());
            $student = $sm->getByFieldName('student_id', $poslednja_rez->student_id);
            $this->set('student', $student);

             // pocetak zaduzenja
             $this->set('pocetak', $poslednja_rez->created_at);

             // kraj zaduzenja
             $this->set('kraj', $poslednja_rez->expires_at);

             $now = new \DateTime();
             $vracenaDatum = $now->format('Y-m-d H:i:s');
             
             

             $vracenaKnjiga = $resm->editById ($poslednja_rez->reservation_id, [
                'expires_at'      => $vracenaDatum,
                'returned'        => 1
                
            ]);

        }
    }
<?php
    namespace App\Controllers;

    use App\Core\Role\LibrarianRoleController;
    use App\Models\BookModel;
    use App\Models\CategoryModel;
    use App\Models\ActiveModel;
    use App\Models\LibrarianModel;
    use App\Models\StudentModel;
    use App\Models\ReservationModel;
    use App\Models\AuthorModel;
    use App\Models\BookAuthorModel;
    use App\Validators\NumberValidator;

    class LibrarianReservManController extends  LibrarianRoleController{


        public function getRes() {
        }

        public function postRes() {
            $isbn = filter_input(INPUT_POST, 'search_isbn', FILTER_SANITIZE_STRING);

            $bm = new BookModel($this->getDatabaseConnection());
            $searchedBooks = $bm->getAllByIsbn($isbn);
            $id = $searchedBooks->book_id;
            $this->set('book', $searchedBooks);

            if(!$searchedBooks) {
                $this->set('poruka', 'Nema knjiga za zadate kljucne reci');
                }

            $am = new ActiveModel($this->getDatabaseConnection());
            $act = $am->getAll();
            $this->set('stanja', $act);   

            // ---------------- Razduzivanje knjige ---------------------// 

            $resm = new ReservationModel($this->getDatabaseConnection());
            // sve rezervacije za ovu knjigu
            $rezervacije = $resm->getAllByFieldName('book_id', $searchedBooks->book_id);

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

            if(!$poslednja_rez) {
                $this->set('niko', 'Niko ne duzi ovu knjigu');
                return;
                
            }
            // student koji je zaduzio
            $sm = new StudentModel($this->getDatabaseConnection());
            $student = $sm->getByFieldName('student_id', $poslednja_rez->student_id);
            $this->set('student', $student);

             // pocetak zaduzenja
             $this->set('pocetak', $poslednja_rez->created_at);

             // kraj zaduzenja
             $this->set('kraj', $poslednja_rez->expires_at);
            

             // autor knjige!!! 
            $bam = new BookAuthorModel($this->getDatabaseConnection());
            $am = new AuthorModel($this->getDatabaseConnection());
            $svi_autori = $am->getAll();
            $autor = $bam->getByFieldName('book_id', $id);

            $imeAutora = '';
            $prezimeAutora = '';
            foreach ( $svi_autori as $jedana) {
                if($autor->author_id == $jedana->author_id) {
                    $imeAutora = $jedana->forename;
                    $prezimeAutora = $jedana->surname;
                }
            }
            $this->set('imeAutora', $imeAutora);
            $this->set('prezimeAutora', $prezimeAutora);
        }

        public function getRemove() {
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
                if($rez->returned == 0 ) {
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


             $vracenaKnjiga = $resm->editById ($poslednja_rez->reservation_id, [
                'returned'        => 1,



            ]);

        }

        public function getStudRes() {
            $rm = new ReservationModel($this->getDatabaseConnection());
            $bm = new BookModel($this->getDatabaseConnection());
            $sm = new StudentModel($this->getDatabaseConnection());

            // uzime sve rezervacije
            $rezervacije = $rm->getAllByFieldName('stud_res', 1);
            # print_r($rezervacije);
            foreach($rezervacije as $rez) {
                if($rez->taken == 1 && $rez->returned == 0 && $rez->stud_res_app == 0 ) {
                    $potrebneRezervacije[] = $rez;
                }
            }
            

            $knjige = $bm->getAll();
            $studenti = $sm->getAll();

            // uzimamo ime knjige
            foreach($potrebneRezervacije as $rez) {
                foreach($knjige as $knjiga) {
                    if($rez->book_id == $knjiga->book_id){
                        $rez->ime_knjige = $knjiga->title;
                    }
                }
            }
            // uzimamo ime i prezime studenta koji kreira rezervaciju
            foreach($potrebneRezervacije as $rez) {
                foreach($studenti as $student) {
                    if($rez->stud_res_id == $student->student_id){
                        $rez->ime_studenta = $student->forename;
                        $rez->prezime_studenta = $student->surname;
                    }
                }
            }
            /*print_r($rezervacije);*/
            $this->set('rezervacije', $potrebneRezervacije);


            //-------------- sve odobrene rezervacije ---------------------------//
                // uzime sve rezervacije
            $rezervacije2 = $rm->getAllByFieldName('stud_res', 1);
            # print_r($rezervacije);
            foreach($rezervacije2 as $rez) {
                if($rez->taken == 0 && $rez->returned == 0 ) {
                    $potrebneRezervacije2[] = $rez;
                }
            }


            // uzimamo ime knjige
            foreach($potrebneRezervacije2 as $rez) {
                foreach($knjige as $knjiga) {
                    if($rez->book_id == $knjiga->book_id){
                        $rez->ime_knjige = $knjiga->title;
                    }
                }
            }
            // uzimamo ime i prezime studenta koji kreira rezervaciju
            foreach($potrebneRezervacije2 as $rez) {
                foreach($studenti as $student) {
                    if($rez->stud_res_id == $student->student_id){
                        $rez->imeStudenta = $student->forename;
                        $rez->prezimeStudenta = $student->surname;
                    }
                }
            }
            /*print_r($rezervacije);*/
            $this->set('odrezervacije', $potrebneRezervacije2);
        }

        public function approve($id) {
            $resm = new ReservationModel($this->getDatabaseConnection());
            $bm = new BookModel($this->getDatabaseConnection());
            $sm = new StudentModel($this->getDatabaseConnection());

            // sve rezervacije za ovu knjigu
            $rezervacije = $resm->getAllByFieldName('book_id', $id);

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
            //print_r($poslednja_rez);

            $pocetak = $poslednja_rez->expires_at;
            $kraj = date('Y-m-d H:i:s', strtotime($pocetak . ' +1 day'));

            $rez_knjiga_id = $poslednja_rez->book_id;
           /* print_r('OVO JE ID KNJIGE: ' . $rez_knjiga_id);
            exit;*/
            $this->set('pomoziBoze', $rez_knjiga_id);

            $rez_student_id = $poslednja_rez->stud_res_id;

            /*print_r('Id knjige je: ' . $rez_knjiga_id . ' .' );
            exit;*/

            $knjiga             = $bm->getByFieldName('book_id', $rez_knjiga_id);
            $studentKojiRezrvise = $sm->getByFieldName('student_id', $rez_student_id);

            //print_r($studentKojiRezrvise);

            $this->set('pocetak', $pocetak);
            $this->set('kraj', $kraj);
            $this->set('naziv', $knjiga->title);
            $this->set('studentIme', $studentKojiRezrvise->forename);
            $this->set('studentPrezime', $studentKojiRezrvise->surname);

            

        }


        public function postApp($id) {
            $resm = new ReservationModel($this->getDatabaseConnection());
            $bm = new BookModel($this->getDatabaseConnection());
            $sm = new StudentModel($this->getDatabaseConnection());

            // sve rezervacije za ovu knjigu
            $rezervacije = $resm->getAllByFieldName('book_id', $id);

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

            /*print_r($poslednja_rez);*/
            $pocetak = $poslednja_rez->expires_at;
            $kraj = date('Y-m-d H:i:s', strtotime($pocetak . ' +1 day'));

            $book_id = $poslednja_rez->book_id;
            $rez_student_id = $poslednja_rez->stud_res_id;


            $knjigaKojajeRezervisana = $bm->getByFieldName('book_id', $book_id);
            $studentKojiRezrvise = $sm->getByFieldName('student_id', $rez_student_id);

            
            
            $resId = $resm->add ([
                'created_at'        => $pocetak,
                'expires_at'        => $kraj,
                'student_id'        => $studentKojiRezrvise->student_id,
                'librarian_id'      => 1,
                'book_id'           => $knjigaKojajeRezervisana->book_id,
                'stud_res'          => 1,
                'stud_res_app'      => 1

      
            ]);

            if(!$resId) {
                $this->set('poruka', 'Doslo je do greske prilikom odobravanja rezervacije');
            }

            // uzimamo poseledju rezervaciju koja nije vracena i ima ID ove knjige
            $id_rezz = 0;
            foreach ($rezervacije as $rez){
                if($rez->returned == 0 && $rez->book_id == $id) {
                    if($rez->reservation_id > $id_rezz) {
                        $id_rezz = $rez->reservation_id;
                    }
                }
            }

            $poslednja_rezz = $resm->getByFieldName('reservation_id', $id_rezz);

            $brisi = $resm->editById ($poslednja_rezz->reservation_id, [
                'stud_res_app'      => 1,

            ]);
        }

        
    }
<?php
    namespace App\Controllers;

    use App\Core\Role\StudentRoleController;
    use App\Models\BookModel;
    use App\Models\CategoryModel;
    use App\Models\ActiveModel;
    use App\Models\LibrarianModel;
    use App\Models\StudentModel;
    use App\Models\ReservationModel;
    use App\Models\BookAuthorModel;
    use App\Models\AuthorModel;
    use App\Validators\NumberValidator;

    class StudentBookManController extends  StudentRoleController{

       public function getSearch($id) {
        $bm = new BookModel($this->getDatabaseConnection());
        $book = $bm->getById($id);
        $this->set('book', $book);

        $cm = new CategoryModel($this->getDatabaseConnection());
         $items = $cm->getAll();
         $this->set('categories', $items);

         $lm = new LibrarianModel($this->getDatabaseConnection());
         $lib = $lm->getAll();
         $this->set('bibliotekari', $lib);

         $sm = new StudentModel($this->getDatabaseConnection());
         $stud = $sm->getAll();
         $this->set('studenti', $stud);

         $stud2 = $sm->getByFieldName('username', 's_n.nikolic');
         /*print_r($stud2);
         exit;*/

         $am = new ActiveModel($this->getDatabaseConnection());
         $act = $am->getAll();
         $this->set('stanja', $act);

         $rm = new ReservationModel($this->getDatabaseConnection());

         // sva zaduzenja gde je book_id jednak id-ju knjige iz url-a 
         $zaduzenja = $rm->getAllByFieldName('book_id', $id);
         if(!$zaduzenja) {
          $this->set('poruka', 'Knjiga trenutno nije zauzeta, mozete je uzeti.');
          return;
        }
          // izvlacimo poslednju rezervaciju
          $poslednja_rez = 0;
          foreach ($zaduzenja as $rez){
                  if($rez->reservation_id > $poslednja_rez) {
                      $poslednja_rez = $rez->reservation_id;
                  } 
          }
          $poslednja_rez = $rm->getByFieldName('reservation_id', $poslednja_rez);
          //print_r($poslednja_rez);
          if($poslednja_rez->returned == 0 && $poslednja_rez->stud_res == 0) {
            $this->set('porukaZauzeta', 'Knjiga je zauzeta. Očekivani datum vraćanja knjige je: '. $poslednja_rez->expires_at);
          }

          if($poslednja_rez->returned == 1 && $poslednja_rez->stud_res == 0) {
            $this->set('poruka', 'Knjiga trenutno nije zauzeta, mozete je uzeti.');
          }

          if($poslednja_rez->returned == 1 && $poslednja_rez->stud_res == 1) {
            $this->set('poruka', 'Knjiga trenutno nije zauzeta, ali je rezervisana. (Rezervacije traju jedan dan, ako je student koji je rezervisao ne preuzme, vi mozete doci po nju).');
          }

          if($poslednja_rez->returned == 0 && $poslednja_rez->stud_res == 1) {
            $this->set('poruka', 'Knjiga je zauzeta a i rezervisana nakon trenutnog zaduzenja. Očekivani datum vraćanja knjige je: '. $poslednja_rez->expires_at);
          }
       }



       public function postSearch($id) {

        $resm = new ReservationModel($this->getDatabaseConnection());
        // sva zaduzenja gde je book_id jednak id-ju knjige iz url-a 
        $zaduzenja = $resm->getAllByFieldName('book_id', $id);
        if(!$zaduzenja) {
         $this->set('poruka', 'Knjiga trenutno nije zauzeta, mozete je uzeti.');
         return;
       }
         // izvlacimo poslednju rezervaciju
         $poslednja_rez = 0;
         foreach ($zaduzenja as $rez){
                 if($rez->reservation_id > $poslednja_rez) {
                     $poslednja_rez = $rez->reservation_id;
                 } 
         }

        $rezKnjiga = $resm->editById ($poslednja_rez, [
          'stud_res'        => 1,
          'stud_res_id'      => $this->getSession()->get('studentId')

        ]);

        if(!$rezKnjiga) {
          $this->set( 'poruka', 'Doslo je do greske prilikom rezervisanja ove knjige');
        }

        $this->set( 'poruka', 'Uspesno ste rezervisali ovu knjigu');
       }

  }
<?php
    namespace App\Controllers;

    use App\Core\Role\LibrarianRoleController;
    use App\Models\BookModel;
    use App\Models\CategoryModel;
    use App\Models\ActiveModel;
    use App\Models\LibrarianModel;
    use App\Models\StudentModel;
    use App\Models\ReservationModel;
    use App\Models\BookAuthorModel;
    use App\Models\AuthorModel;

    class LibrarianDashboardController extends  LibrarianRoleController{

       public function index() {

         $lm = new LibrarianModel($this->getDatabaseConnection());   
         $id = $this->getSession()->get('libId');
         $items = $lm->getById($id);

         $this->set('bib', $items);
       }

       public function getStats() {
        $bm = new BookModel($this->getDatabaseConnection());
        $knjige = $bm->getAll();

        $bm = new ReservationModel($this->getDatabaseConnection());
        $rezervacije = $bm->getAll();

        foreach($rezervacije as $rez) {
          foreach($knjige as $knjiga) { 
            if($rez->book_id == $knjiga->book_id) {
              $rez->ime_knjige = $knjiga->title;
             unset($rez->reservation_id);
             unset($rez->created_at);
             unset($rez->expires_at);
             unset($rez->student_id);
             unset($rez->librarian_id);
             unset($rez->taken);
             unset($rez->returned);
             unset($rez->stud_res);
             unset($rez->stud_res);
             unset($rez->stud_res_app);
            }
          }
        }

        //$count = count(get_object_vars($rezervacije->book_id));

        $this->set('rez', $rezervacije);

        print_r($rezervacije);

       // $broj_rezervacija = array_count_values($book_ids);

       // print_r($citanjeKnjige);
     
        
       
      }
       public function postStats() {
         
      }

      


    }
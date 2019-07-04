<?php
    namespace App\Controllers;

    use App\Core\Role\StudentRoleController;
    use App\Models\CategoryModel;
    use App\Models\BookModel;
    use App\Models\ReservationModel;
    use App\Models\LibrarianModel;

    class StudentDashboardController extends  StudentRoleController{

       public function index() {
        $bm = new BookModel($this->getDatabaseConnection());
        $items = $bm->getAll();

       }

       public function getSearch() {
         $cm = new CategoryModel($this->getDatabaseConnection());
         $items = $cm->getAll();
         $this->set('categories', $items);
       }

       public function postSearch() {
        $cm = new CategoryModel($this->getDatabaseConnection());
        $items = $cm->getAll();
        $this->set('categories', $items);

        $keyword  = filter_input(INPUT_POST, 'search_any', FILTER_SANITIZE_STRING);
        
        $bm = new BookModel($this->getDatabaseConnection());
        $searchedBooks = $bm->getAllByAnyWord($keyword); 
        
        
        $rm = new ReservationModel($this->getDatabaseConnection());
        $res = $rm->getAll();

        // uzete a nisu vracene knjige
        foreach($searchedBooks as $knjiga ) {
          $knjiga->is_taken = 0;

          foreach($res as $rezervacija ) {
            if($rezervacija->book_id == $knjiga->book_id ) {
              if($rezervacija->taken == 1 && $rezervacija->returned == 0) {
               if ($knjiga->is_taken) {
                 break;
               }
               $knjiga->is_taken = true;
            }
          }
        }
      }
      $this->set('trazeneKnjige', $searchedBooks);


        if(!$searchedBooks) {
           $this->set('poruka', 'Nema knjiga za zadate kljucne reci');
        }
       }

       public function catSearch() {
        $keyword = filter_input(INPUT_POST, 'category_id', FILTER_SANITIZE_NUMBER_INT); 

        $bm = new BookModel($this->getDatabaseConnection());
        $cm = new CategoryModel($this->getDatabaseConnection());
        $items = $cm->getAll();
        $this->set('categories', $items);
        $items = $cm->getById($keyword);

        // knjige sa kategorijom dobijenom iz view-a
        $knjige = $bm ->getAllByFieldName('category_id', $items->category_id);
      
        $rm = new ReservationModel($this->getDatabaseConnection());
        $res = $rm->getAll();

        // uzete a nisu vracene knjige
        foreach($knjige as $knjiga ) {
          $knjiga->is_taken = 0;

          foreach($res as $rezervacija ) {
            if($rezervacija->book_id == $knjiga->book_id ) {
              if($rezervacija->taken == 1 && $rezervacija->returned == 0) {
               if ($knjiga->is_taken) {
                 break;
               }
               $knjiga->is_taken = true;
            }
          }
        }
      }
      

       $this->set('trazeneKnjige', $knjige);
       //print_r($knjige);
    }

    public function debt() {
      $bm = new BookModel($this->getDatabaseConnection());
      $knjige = $bm->getAll();

      $rm = new LibrarianModel($this->getDatabaseConnection());
      $libs = $rm->getAll();

      $student_id = $this->getSession()->get('studentId');

      // uzmi sva dugovanja ovog studenta
      $rm = new ReservationModel($this->getDatabaseConnection());
      $rez = $rm->getAllByFieldName('student_id', $student_id);


      // sve nevracene rezervacije
      $sve_rez = []; // prazan niz
      foreach($rez as $rezervacija ) {
        if($rezervacija->returned == 0)  {
          $sve_rez[] = $rezervacija;
        }
      }
      


      // uzimamo ime knjige
      foreach($sve_rez as $rez ) {
        $rez->ime_knjige = 0;
        foreach ($knjige as $knjiga) {
          if($rez->book_id == $knjiga->book_id) {
            $rez->ime_knjige = $knjiga->title;
          }
        }
      }

      
      // uzimamo ime bibliotekara
      foreach($sve_rez as $rez ) {
        $rez->ime_bib = 0;
        foreach ($libs as $lib) {
          if($rez->librarian_id == $lib->librarian_id) {
            $rez->ime_bib = $lib->forename;
          }
        }
      }

      $this->set('rezervacija', $sve_rez);
      

      

       



    }
  }
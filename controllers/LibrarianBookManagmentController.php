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
    use App\Validators\NumberValidator;

    class LibrarianBookManagmentController extends  LibrarianRoleController{

       public function books() {
         $bm = new BookModel($this->getDatabaseConnection());

            $id = rand(1,10);
            $books = $bm->getAll();
            // shuffle($books);
            //$this->set('books', $books);

            $resm = new ReservationModel($this->getDatabaseConnection());
            $reservations = $resm->getAll();

            
            foreach ( $books as $book) {             // za svaku knjigu 
                foreach ( $reservations as $res) {   // za svaku rezervaciju
                     // ako knjiga postoji u rezervacijama i uzetaje a nije vracena upisi je u niz
                    if($book->book_id == $res->book_id && $res->taken == 1 && $res->returned == 0) {
                        $knjige[] = $book; 
                        }
                }
            }
            $this->set('books', $knjige);
          



           





            // deo za izbor kategorija
            $cm = new CategoryModel($this->getDatabaseConnection());
            $items = $cm->getAll();
            $this->set('categories', $items);

            // deo za izbor autora
           /* $abm = new BookAuthorModel($this->getDatabaseConnection());
            $autori_knjiga = $abm->getAll();

            // izvlacimo Id-jevi autora
            foreach ( $autori_knjiga as $autor) {
                $autori_idijevi[] = $autor->author_id;
            }*/
            
            // uzimamo iz tabele autor sve idejeve
            $am = new AuthorModel($this->getDatabaseConnection());
            $autori= $am->getAll();
            $this->set('autori', $autori);
            
            /*$autori_id = $am->getFieldValues('author_id');


            $autori_ime = $am->getFieldValues('forename');
            

            print_r($autori_ime);
            exit;*/

            /* ako id iz tabele book_author jedan id-ju iz tabele author
            for ($i=0; $i<count($autori_idijevi); $i++) { 
                    if($autori_idijevi[$i] == $autori_id->author_id) {
                        $this->set('hmm', $items);
                    }
            }*/

            /*print_r($autori_idijevi);
            exit;*/
            $this->set('categories', $items);


       }

       public function bookId($id) {
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
         $res = $rm->getAll();
         $this->set('rezervacije', $res);


        // sva zaduzenja gde je book_id jednak id-ju knjige iz url-a 
        $zaduzenja = $rm->getAllByFieldName('book_id', $id);
        /*print_r($zaduzenje);
        exit;*/
        if(!$zaduzenja) {
            return;
        }
        // za svako zaduzenje izvuci id studenta
        foreach ( $zaduzenja as $zad) {
            foreach ( $stud as $student) {
                if($zad->student_id == $student->student_id) {
                    $zad->imeStudenta = $student->forename;
                    $zad->prezimeStudenta = $student->surname;
                }
                if($zad->returned == 1) {
                    $zad->vracena = 1;
                }
            }
        }
        $this->set('rezervacije', $zaduzenja);

        
        
        

        foreach ( $zaduzenja as $trajanje) {
            $kreirano[] = $trajanje->created_at;
        }

            $this->set('uzeo', $kreirano);

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

       public function getAdd() {
         $cm = new CategoryModel($this->getDatabaseConnection());
         $items = $cm->getAll();
         $this->set('categories', $items);
       }

       private function doUpload($fieldName, $filename) {
         $path = new \Upload\Storage\FileSystem(\Configuration::UPLOAD_DIR);
         $file = new \Upload\File($fieldName, $path);
         $file->setName($filename);
         $file->addValidations([
             new \Upload\Validation\Mimetype('image/jpeg'),
             new \Upload\Validation\Size('3M')
         ]);
 
         try {
             $file->upload();
             return true;
         } catch (\Exception $e) {
             $this->set('message', 'Došlo je do greške: ' . implode(', ', $file->getErrors()));
             return false;
         }
     }

       public function postAdd() {
         $title         = filter_input(INPUT_POST, 'title',        FILTER_SANITIZE_STRING);
         $description   = filter_input(INPUT_POST, 'description',  FILTER_SANITIZE_STRING);
         $isbn          = filter_input(INPUT_POST, 'isbn' ,        FILTER_SANITIZE_STRING);
         $published_at  = filter_input(INPUT_POST, 'published_at', FILTER_SANITIZE_STRING);
         $categoryId    = filter_input(INPUT_POST, 'category_id',  FILTER_SANITIZE_NUMBER_INT);
         $authorId      = filter_input(INPUT_POST, 'author_id',  FILTER_SANITIZE_NUMBER_INT);
 
         $bm = new BookModel($this->getDatabaseConnection());
         $bam = new BookAuthorModel($this->getDatabaseConnection());

         if (strlen($isbn) != 13 )  {
            $this->set('message', 'ISBN mora imati tacno 13 cifara.');
            return;
        }
 

         $novaKnjiga = $bm->add ([
             'title'        => $title,
             'description'  => $description,
             'isbn'         => $isbn,
             'published_at' => $published_at,
             'image_path'   => rand(100,9999) . '.jpg',
             'category_id'  => $categoryId,
             'librarian_id' => $this->getSession()->get('libId'),
             'active_id'    => 1
             
         ]);


         if (!$novaKnjiga) {
             $this->set('message', 'Došlo je do greške prilikom dodavanja nove knjige.');
             return;
         }

         // zapis veze izmedju knjige i autora u tabelu book_author
         // na osnovu isbn-a uzimamo id knjige
         $book = $bm->getByFieldName('isbn', $isbn);
         $bookId = $book->book_id;

         $novaVezaBookAuthor = $bam->add ([
            'book_id' => $bookId,
            'author_id' => $authorId,
         ]);

         if (!$novaVezaBookAuthor) {
            $this->set('message', 'Došlo je do greške prilikom dodavanja nove knjige.');
            return;
        }
 
         if (!$this->doUpload('image', $novaKnjiga)) { 
             return;
     }
 
         \ob_clean();
         header('Location: ' . BASE . 'librarian/books/');
         exit;
     }

     public function postSearch() {
      $keyword = filter_input(INPUT_POST, 'search', FILTER_SANITIZE_STRING);

      $bm = new BookModel($this->getDatabaseConnection());

      $searchedBooks = $bm->getAllBySearch($keyword);

      $this->set('searchedBooks', $searchedBooks);

      if(!$searchedBooks) {
         $this->set('poruka', 'Nema knjiga za zadate kljucne reci');
      }
  }  

      public function getEdit($id) {
         $bm = new BookModel($this->getDatabaseConnection());

         $book = $bm->getById($id);
         $this->set('book', $book);
         $this->getAdd();

        $am = new ActiveModel($this->getDatabaseConnection());
        $active = $am->getAll();
        $this->set('stanja', $active);

        $atm = new AuthorModel($this->getDatabaseConnection());
        $autori_knjiga = $atm->getAll();
        $this->set('autori', $autori_knjiga);

        

        /* test 1 */
        // uzimamo zapis o autoru knjige na osnovu id-ja knjige
        $bam = new BookAuthorModel($this->getDatabaseConnection());
        $autor_ove_knjige = $bam->getByFieldName('book_id', $id);
        
        // izvlacimo ime autora iz tog zapisa
        $autorm = new AuthorModel($this->getDatabaseConnection());
        $ime_autora = $autorm->getByFieldName('author_id', $autor_ove_knjige->author_id);

        $this->set('imeAutora', $ime_autora);
        /*print_r($ime_autora);
        exit;

        
        $this->set('ime_autora', $ime_autora->forename);*/
        
         
         }

         public function postEdit($id) {
            $title         = filter_input(INPUT_POST, 'title',        FILTER_SANITIZE_STRING);
            $description   = filter_input(INPUT_POST, 'description',  FILTER_SANITIZE_STRING);
            $isbn          = filter_input(INPUT_POST, 'isbn' ,        FILTER_SANITIZE_STRING);
            $published_at  = filter_input(INPUT_POST, 'published_at', FILTER_SANITIZE_STRING);
            $categoryId    = filter_input(INPUT_POST, 'category_id',  FILTER_SANITIZE_NUMBER_INT);
            $activeId    = filter_input(INPUT_POST,   'active_id',    FILTER_SANITIZE_NUMBER_INT);
            $authorId      = filter_input(INPUT_POST, 'author_id',  FILTER_SANITIZE_NUMBER_INT);

            $bm = new BookModel($this->getDatabaseConnection());
            $bam = new BookAuthorModel($this->getDatabaseConnection());
           
            if (strlen($isbn) != 13 )  {
               $this->set('message', 'ISBN mora imati tacno 13 cifara.');
               return;
           }
    
   
            $novaKnjiga = $bm->editById ($id, [
                'title'        => $title,
                'description'  => $description,
                'isbn'         => $isbn,
                'published_at' => $published_at,
                'category_id'  => $categoryId,
                'active_id'    => $activeId
                
            ]);
   
            if (!$novaKnjiga) {
                $this->set('message', 'Došlo je do greške prilikom izmene ove knjige.');
                return;
            }

            $novaVezaBookAuthor = $bam->editById ($id, [
                'book_id' => $id,
                'author_id' => $authorId,
            ]);

            if (!$novaVezaBookAuthor) {
                $this->set('message', 'Došlo je do greške prilikom dodavanja nove knjige.');
                return;
            }
    
    
            \ob_clean();
            header('Location: ' . BASE . 'librarian/books/');
            exit;
        }
    }
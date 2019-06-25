<?php
    namespace App\Controllers;

    use App\Core\Role\LibrarianRoleController;
    use App\Models\BookModel;
    use App\Models\CategoryModel;
    use App\Models\ActiveModel;
    use App\Validators\NumberValidator;

    class LibrarianBookManagmentController extends  LibrarianRoleController{

       public function books() {
         $bm = new BookModel($this->getDatabaseConnection());

            $id = rand(1,10);
            $books = $bm->getAll();
            shuffle($books);
            $this->set('books', $books);

            // deo za izbor kategorija
            $cm = new CategoryModel($this->getDatabaseConnection());
            $items = $cm->getAll();
            $this->set('categories', $items);
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
 
         $bm = new BookModel($this->getDatabaseConnection());
     
         $published_at .= ':00';

         $published_at = str_replace('T', ' ', $published_at);

        
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
         
            /*print_r($title);
            print_r($this->getSession()->get('libId'));
            print_r($category_id);
            print_r($isbn);
            print_r($description);
            print_r($published_at);
            print_r(rand(100,9999) .'.jpg');
            echo 'sad ce $bookId =   =   =';
            echo 'ovo je broj: ' . $bookId;
            exit;*/

         if (!$novaKnjiga) {
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

         
         }
    }
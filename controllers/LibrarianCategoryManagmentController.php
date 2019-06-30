<?php
    namespace App\Controllers;

    use App\Core\Role\LibrarianRoleController;

    class LibrarianCategoryManagmentController extends LibrarianRoleController {

       public function categories() {

            $categoryModel = new \App\Models\CategoryModel($this->getDatabaseConnection());
            $categories = $categoryModel->getAll();
            

            $bookModel = new \App\Models\BookModel($this->getDatabaseConnection());
            $knjige = $bookModel->getAll();

            foreach ($categories as $category) {
                $category->bookCount = 0;

                foreach ($knjige as $knjiga) {
                    if($knjiga->category_id == $category->category_id) {
                        $category->bookCount++;
                    }
                }
            }
            $this->set('categories', $categories);
            $this->set('knjige', $knjige);


       }

       public function getEdit() {
           $categoryModel = new \App\Models\CategoryModel($this->getDatabaseConnection());
           $categories = $categoryModel->getAll();

           $this->set('categories', $categories);

       }

       public function postEdit() {
        $categoryModel = new \App\Models\CategoryModel($this->getDatabaseConnection());
        $name = filter_input(INPUT_POST, 'name_edit', FILTER_SANITIZE_STRING);
        $id =  filter_input(INPUT_POST, 'category_id', FILTER_SANITIZE_STRING);

        $categoryModel->editById($id, [
            'name' => $name
        ]);
        $this->redirect(\Configuration::BASE . 'librarian/categories');
       }


       public function getAdd() {

       }

       public function postAdd() {
        $categoryModel = new \App\Models\CategoryModel($this->getDatabaseConnection());
        $name = filter_input(INPUT_POST, 'name_add', FILTER_SANITIZE_STRING);

        $categoryId = $categoryModel ->add ([
            'name' => $name
        ]);

        if($categoryId) {
            $this->redirect(\Configuration::BASE . 'librarian/categories');
        }

        $this->set('message', 'Doslo je do greske: Nije moguce dodati ovu kategoriju!');
       }

    }
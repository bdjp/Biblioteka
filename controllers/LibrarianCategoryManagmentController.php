<?php
    namespace App\Controllers;

    use App\Core\Role\LibrarianRoleController;

    class LibrarianCategoryManagmentController extends LibrarianRoleController {

       public function categories() {

            $categoryModel = new \App\Models\CategoryModel($this->getDatabaseConnection());
            $categories = $categoryModel->getAll();
            $this->set('categories', $categories);

            $bookModel = new \App\Models\BookModel($this->getDatabaseConnection());
            $knjige = $bookModel->getAll();
            $this->set('knjige' , $knjige);
       }

       public function getEdit($categoryId) {
           $categoryModel = new \App\Models\CategoryModel($this->getDatabaseConnection());
           $category = $categoryModel->getById($categoryId);

           if(!$category) {
               $this->redirect(\Configuration::BASE . 'user/categories');
           }

           $this->set('category', $category);

           return $categoryModel;
       }

       public function postEdit($categoryId) {
        $categoryModel = $this->getEdit($categoryId);
        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);

        $categoryModel->getById($categoryId, [
            'name' => $name
        ]);
        $this->redirect(\Configuration::BASE . 'user/categories');
       }


       public function getAdd() {

       }

       public function postAdd() {
        $categoryModel = $this->getEdit($categoryId);
        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);

        $categoryId = $categoryModel ->add ([
            'name' => $name
        ]);

        if($categoryId) {
            $this->redirect(\Configuration::BASE . 'user/categories');
        }

        $this->set('message', 'Doslo je do greske: Nije moguce dodati ovu kategoriju!');
       }

    }
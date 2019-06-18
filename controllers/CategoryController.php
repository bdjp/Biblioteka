<?php 
    namespace App\Controllers;

    class CategoryController extends \App\Core\Controller {

         public function show($id) {
            $categoryModel = new \App\Models\CategoryModel($this->getDatabaseConnection());
            $category = $categoryModel->getById($id);
             $this->set('category', $category);


            $bookModel = new \App\Models\BookModel($this->getDatabaseConnection());
            $booksInCategory = $bookModel->getAllByCategoryId($id);
            $this->set('booksInCategory', $booksInCategory);
        
    }
}
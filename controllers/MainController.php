<?php 
namespace App\Controllers;


class MainController extends \App\Core\Controller {
    private $dbc;

    public function home() {
        $categoryModel = new \App\Models\CategoryModel($this->getDatabaseConnection());
        $categories = $categoryModel->getAll();

        $this->set('categories', $categories);

        $userModel = new \App\Models\BookModel($this->getDatabaseConnection());
        $userModel->editById(11, ['title' => 'ozbiljna knjiga']);

        
    }

}
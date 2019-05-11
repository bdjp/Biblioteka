<?php 
namespace App\Controllers;

class MainController {
    private $dbc;


    public function __construct(\App\Core\DatabaseConnection &$dbc) {
        $this->dbc = $dbc;
    }


    public function home() {
        $categoryModel = new \App\Models\CategoryModel($this->dbc);
        $categories = $categoryModel->getAll();

        return [
            'categories' => $categories
        ];

    }
}
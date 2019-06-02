<?php 
namespace App\Controllers;


class MainController extends \App\Core\Controller {
    private $dbc;

    public function home() {
        $categoryModel = new \App\Models\CategoryModel($this->getDatabaseConnection());
        $categories = $categoryModel->getAll();

        $this->set('categories', $categories);

        $bookModel = new \App\Models\BookModel($this->getDatabaseConnection());
        $bookModel->add([
            'title'        => 'Zasto nece knjiugu da mi spostavo',
            'description'  => 'ovo je opis neke jako ozbiljne knjige',
            'isbn'         => '1234567891234',
            'published_at' => '2014-03-11 10:05:11',
            'image_path'   => 'img/assets/123.jpg',
            'is_active'    => 1,

            'category_id'  => 5,
            'librarian_id' => 2
            ]);

        //$this->getSession()->put('neki_kljuc', 'Neka vrednost' . rand(100, 999));
        
        $staraVrednost = $this->getSession()->get('neki_kljuc', '/');
        $this->set('podatak', $staraVrednost);

        $this->getSession()->clear();
    }

    


}
<?php 
namespace App\Controllers;


class MainController extends \App\Core\Controller {
    private $dbc;

    public function home() {
        $categoryModel = new \App\Models\CategoryModel($this->getDatabaseConnection());
        $categories = $categoryModel->getAll();

        $this->set('categories', $categories);

       /* $bookModel = new \App\Models\BookModel($this->getDatabaseConnection()); metod ne radi???
        $bookModel->add([
            'title'        => 'Zasto nece knjiugu da mi spostavo',
            'description'  => 'ovo je opis neke jako ozbiljne knjige',
            'isbn'         => '1234567891234',
            'published_at' => '2014-03-11 10:05:11',
            'image_path'   => 'img/assets/123.jpg',
            'is_active'    => 1,

            'category_id'  => 5,
            'librarian_id' => 2
            ]);*/

        //$this->getSession()->put('neki_kljuc', 'Neka vrednost' . rand(100, 999));
        
        $staraVrednost = $this->getSession()->get('brojac', 0);
        $novaVrednost = $staraVrednost + 1;
        $this->getSession()->put('brojac', $novaVrednost);

        $this->set('podatak', $novaVrednost);

       
    }
        public function getLogin() {

        }

        public function postLogin() {
            $username = \filter_input(INPUT_POST, 'login_username', FILTER_SANITIZE_STRING);
            $password = \filter_input(INPUT_POST, 'login_password', FILTER_SANITIZE_STRING);

            $validanPassword = (new \App\Validators\StringValidator())->setMinLength(7)->setMaxLength(120)->isValid($password);

            if(!$validanPassword) {
                $this->set('message', 'Doslo je do greske: Lozinka nije ispravnog formata.');
                return;
            }

            $userModel = new \App\Models\StudentModel($this->getDatabaseConnection());

            $user = $userModel->getByFieldName('username', $username);
            if(!$user) {
                $this->set('message', 'Doslo je do greske: Ne postoji korisnik sa tim username-om.');
                return;
            }

            $passHash = \password_hash($user->password, PASSWORD_DEFAULT);

            if(!password_verify($password, $passHash)) {
               sleep(1);
                $this->set('message', 'Doslo je do greske: Lozinka nije ispravna.');
                return;
            }

            $this->getSession()->put('user_id', $user->user_id);
            $this->getSession()->save();

            
            $this->redirect(\Configuration::BASE . 'user/dashboard');

        }
    


}
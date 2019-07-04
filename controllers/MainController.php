<?php 
namespace App\Controllers;

use App\Validators\StringValidator;
use App\Models\CategoryModel;
use App\Core\Controller;
use App\Models\StudentModel;
use App\Models\LibrarianModel;

class MainController extends Controller {
    private $dbc;

    public function home() {
        $categoryModel = new CategoryModel($this->getDatabaseConnection());
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

        // Metod koji bira da li se radi sa studentom ili bibliotekarom
        public function roleSwitch() {
            $username = \filter_input(INPUT_POST, 'login_username', FILTER_SANITIZE_STRING);
            $sm = new StudentModel($this->getDatabaseConnection());
            $lm = new LibrarianModel($this->getDatabaseConnection());
            $osoba = '';

            if (preg_match('/^s_[a-z]\.[a-z]+$/', $username)) {
                $osoba = $sm->getByFieldName('username', $username);
            }

            if (preg_match('/^b_[a-z]\.[a-z]+$/', $username)) {
                $osoba = $lm->getByFieldName('username', $username);
            }

            if($osoba === '') {
                return;
            }

            // vraca stdClass sa podacima o biblotekaru ili studentu
            return $osoba;

        }
        // metod za upis u sesiju
        public function upisiSesiju() {
           // uzimamo osobu bibliotekar ili student
           $user = $this->roleSwitch();

           // ako je bibliotekar - upisi u sesiju libId - njegov id i postavi studentId na ''
            if (preg_match('/^b_[a-z]\.[a-z]+$/', $user->username)) {
                $this->getSession()->put('libId', $user->librarian_id);
                $this->getSession()->put('studentId', '');
                $this->getSession()->save();
                \ob_clean();
                header('Location: ' . BASE . 'librarian/dashboard');
            }  
            // ako je student - upisi u sesiju libId - njegov id i postavi libId na ''
            if (preg_match('/^s_[a-z]\.[a-z]+$/', $user->username)) {
             $this->getSession()->put('studentId', $user->student_id);
             $this->getSession()->put('libId', '');
             $this->getSession()->save();
             \ob_clean();
             header('Location: ' . BASE . 'student/dashboard/');
             
             exit;
            }
        }

        public function postLogin() {
            $username = \filter_input(INPUT_POST, 'login_username', FILTER_SANITIZE_STRING);
            $password = \filter_input(INPUT_POST, 'login_password', FILTER_SANITIZE_STRING);

           
            //ako nema bibliotekara ili osobe prekini
            $osoba = $this->roleSwitch();
            if(!$osoba) {
                $this->set('message', 'Doslo je do greske: Ne postoji korisnik sa tim username-om.');
                return;
            }
            $validanPassword = (new StringValidator())->setMinLength(7)->setMaxLength(120)->isValid($password);

            if(!$validanPassword) {
                $this->set('message', 'Doslo je do greske: Lozinka nije ispravnog formata.');
                return;
            }
            
           // $passHash = \password_hash($osoba->password, PASSWORD_DEFAULT);
             $passHash = $osoba->password;

            if(!password_verify($password, $passHash)) {
               sleep(1);
                $this->set('message', 'Doslo je do greske: Lozinka nije ispravna.');
                return;
            }
            // upis sesije
            $this->upisiSesiju();

        }

        public function getLogout() {
            $this->getSession()->clear();
            $this->getSession()->save();
    
            header('Location: ' . BASE . '');
        }
    


}
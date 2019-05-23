<?php 
    namespace App\Controllers;

    class BookController extends \App\Core\Controller {

         public function show($id) {
            $bookModel = new \App\Models\BookModel($this->getDatabaseConnection());
            $book = $bookModel->getById($id);

            if(!$book) {
                header('Location: /Biblioteka/');
                exit;
            }

            $this->set('book', $book);


          /*  $userModel = new \App\Models\UserModel($this->getDatabaseConnection());
            $userModel ->add( 
                [   
                    'student_id' => $id,
                    'forename'   => 'Milan',
                    'surname'    => 'stefanos',
                    'username'    => 'stefanos',
                    'class'    => '2',
                    'grade'    => '1',
                    'password'    => 'stefanos',
                    'salt'    => 'stefanos'
                ]
                );*/
        
    }

   /* private function getLastReservationExpireDate($bookId) {
        $reservationModel = new \App\Models\ReservationModel($this->getDatabaseConnection());
        $reservations = $reservationModel->getAllByBookId($bookId);
        $lastDate = $reservations->expires_at;
        return $lastDate;
    }*/
}
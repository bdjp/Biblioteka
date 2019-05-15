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

        
    }

   /* private function getLastReservationExpireDate($bookId) {
        $reservationModel = new \App\Models\ReservationModel($this->getDatabaseConnection());
        $reservations = $reservationModel->getAllByBookId($bookId);
        $lastDate = $reservations->expires_at;
        return $lastDate;
    }*/
}
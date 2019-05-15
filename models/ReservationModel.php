<?php 
    namespace App\Models;

    use App\Core\Model;

    class ReservationModel extends Model{
    
        public function getAllByBookId(int $bookId): array {
            $items = $this->getAllByFieldName('book_id', $bookId);
            usort($items, function($a, $b) {
                return strcmp($a->expires_at, $b->expires_at);
            });
            return $items;
        }

       
    }
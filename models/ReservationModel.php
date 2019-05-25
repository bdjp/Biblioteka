<?php 
    namespace App\Models;

    use App\Core\Model;
    use App\Core\Field;

    class ReservationModel extends Model{
        protected function getFields(): array {
            return [
                'reservation_id'      => Field::readonlyInteger(11),
                'created_at'          => Field::readonlyDateTime(),

                'expires_at'          => Field::editableDateTime(),
                
                'student_id'          => Field::editableInteger(11),
                'category_id'         => Field::editableInteger(11),
                'librarian_id'        => Field::editableInteger(11)
            ];
        }

        public function getAllByBookId(int $bookId): array {
            $items = $this->getAllByFieldName('book_id', $bookId);
            usort($items, function($a, $b) {
                return strcmp($a->expires_at, $b->expires_at);
            });
            return $items;
        }

       
    }
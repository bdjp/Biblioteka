<?php 
    namespace App\Models;

    use App\Core\Model;
    use App\Core\Field;

    class BookModel extends Model {
        protected function getFields(): array {
            return [
                'book_id'      => Field::readonlyInteger(11),

                'title'        => Field::editableString(255),
                'description'  => Field::editableString(64*1024),
                'isbn'         => Field::editableInteger(13),
                'published_at' => Field::editableDate(),
                'image_path'   => Field::editableString(255),
                'is_active'    => Field::editableBit(),

                'category_id'  => Field::editableInteger(11),
                'librarian_id' => Field::editableInteger(11)
            ];
        }

        public function getAllByCategoryId(int $categoryId): array {
            return $this->getAllByFieldName('category_id', $categoryId);
        
        }
    }
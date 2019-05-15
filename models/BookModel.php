<?php 
    namespace App\Models;

    use App\Core\Model;

    class BookModel extends Model {
       

        public function getAllByCategoryId(int $categoryId): array {
            return $this->getAllByFieldName('category_id', $categoryId);
        
        }
    }
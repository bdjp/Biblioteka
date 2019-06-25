<?php 
    namespace App\Models;

    use App\Core\Model;
    use App\Core\Field;

    class CategoryModel extends Model {
        protected function getFields(): array {
            return [
                'category_id'      => Field::readonlyInteger(11),
                
                'name'          => Field::editableString(64)

            ];
        }

        public function getAllByCategoryId(int $categoryId): array {
            return $this->getAllByFieldName('category_id', $categoryId);
        
        }
    }
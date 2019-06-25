<?php 
    namespace App\Models;

    use App\Core\Model;
    use App\Core\Field;

    class ActiveModel extends Model {
        protected function getFields(): array {
            return [
                'active_id'     => Field::readonlyInteger(11),
                
                'name'          => Field::editableString(64)

            ];
        }

       
    }
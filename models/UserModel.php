<?php 
    namespace App\Models;

    use App\Core\Model;
    use App\Core\Field;

    class UserModel extends Model {
        protected function getFields(): array {
            return [
                'student_id' => Field::readonlyInteger(11),
                'forename'   => Field::editableString(),
                'surname'    => Field::editableString(),
                'username'   => Field::editableString(),
                'password'   => Field::editableString(),
                'salt'       => Field::editableString(),
                'grade'      => Field::editableInteger(),
                'class'      => Field::editableInteger()
            ];
        }

        public function getByUsername(string $username) {
            $this->getAllByFieldName('username', $username);
           
    }
  
}
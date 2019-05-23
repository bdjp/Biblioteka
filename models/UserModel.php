<?php 
    namespace App\Models;

    use App\Core\Model;
    use App\Core\Field;

    class UserModel extends Model {
       
        public function getByUsername(string $username) {
            $this->getAllByFieldName('username', $username);
           
    }


        protected function getFields(): array {
            return [
                'student_id' => new Field('|^[1-9][0-9]{0,10}$|', true),
                'forename'   => new Field('|^.{0,64}$|', true),
                'surname'    => new Field('|^.{0,64}$|', true),
                'username'    => new Field('|^.{0,64}$|', true),
                'password'    => new Field('|^.{0,64}$|', true),
                'salt'    => new Field('|^.{0,64}$|', true),
                'grade'    => new Field('|^.{0,64}$|', true),
                'class'    => new Field('|^.{0,64}$|', true)
            ];
        }
}
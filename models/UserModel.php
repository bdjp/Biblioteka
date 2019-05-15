<?php 
    namespace App\Models;

    use App\Core\Model;

    class UserModel extends Model {
       
        public function getByUsername(string $username) {
            $this->getAllByFieldName('username', $username);
           
    }
}
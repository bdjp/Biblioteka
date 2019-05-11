<?php 
    namespace App\Models;

    use App\Core\DatabaseConnection;

    class UserModel {
        private $dbc;

        public function __construct(DatabaseConnection &$dbc) {
            $this->dbc = $dbc;
        }

        public function getById(int $userId) {
            $sql = 'SELECT * FROM user WHERE user_id =?;';
            $prep = $this->dbc->getConnection()->prepare($sql);
            $res = $prep->execute([$user_id]);

            $user = [];
            if($res) {
                $user = $prep->fetch(\PDO::FETCH_OBJ);
            }
            return $user;
        }

        public function getAll(): array {
            $sql = 'SELECT * FROM user; ';
            $prep = $this->dbc->getConnection()->prepare($sql);
            $res = $prep->execute();

            $user = [];
            if($res) {
                $user = $prep->fetchAll(\PDO::FETCH_OBJ);
            }
            return $user;
        }

        public function getByUsername(string $username) {
            $sql = 'SELECT * FROM librarian WHERE username = ?;';
            $prep = $this->dbc->getConnection()->prepare($sql);
            $res = $prep->execute([$username]);

            $user = [];
            if($res) {
                $user = $prep->fetch(\PDO::FETCH_OBJ);
            }
            return $user;
        }
    }
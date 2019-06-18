<?php 
    namespace App\Models;

    use App\Core\Model;
    use App\Core\Field;
    use App\Validators\DateTimeValidator;
    use App\Validators\NumberValidator;
    use App\Validators\StringValidator;
    use App\Validators\BitValidator;

    class LibrarianModel extends Model {
        protected function getFields(): array {
            return [
                'librarian_id' => new Field(
                                (new NumberValidator())
                                    ->setInteger()
                                    ->setUnsigned()
                                    ->setIntegerLength(11), false),
                'forename'   => new Field(
                                (new StringValidator())
                                    ->setMinLength(1)
                                    ->setMaxLength(64)),
                'surname'    => new Field(
                                (new StringValidator())
                                    ->setMinLength(1)
                                    ->setMaxLength(64)),
                'username'   => new Field(
                                (new StringValidator())
                                    ->setMinLength(1)
                                    ->setMaxLength(64)),
                'password'   => new Field(
                                (new StringValidator())
                                     ->setMinLength(1)
                                     ->setMaxLength(128)),
            ];
        }

        public function getByUsername(string $username) {
            $this->getAllByFieldName('username', $username);
           
    }
  
}
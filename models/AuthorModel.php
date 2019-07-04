<?php 
    namespace App\Models;

    use App\Core\Model;
    use App\Core\Field;
    use App\Validators\NumberValidator;
    use App\Validators\StringValidator;
    
    class AuthorModel extends Model {
        protected function getFields(): array {
            return [
                'author_id'     => new Field((new NumberValidator())->setInteger()
                                                                    ->setUnsigned()
                                                                    ->setIntegerLength(10), false),
                
                'forename'           => new Field((new StringValidator())->setMaxLength(255)),
                'surname'           => new Field((new StringValidator())->setMaxLength(255)),
                'country'           => new Field((new StringValidator())->setMaxLength(255)),

            ];
        }

       
    }
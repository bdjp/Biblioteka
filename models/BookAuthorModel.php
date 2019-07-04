<?php 
    namespace App\Models;

    use App\Core\Model;
    use App\Core\Field;
    use App\Validators\NumberValidator;
    use App\Validators\StringValidator;
    
    class BookAuthorModel extends Model {
        protected function getFields(): array {
            return [
                'book_author_id'     => new Field((new NumberValidator())->setInteger()
                                                                    ->setUnsigned()
                                                                    ->setIntegerLength(10), false),
                
                'book_id'           => new Field((new NumberValidator())->setInteger()
                                                                    ->setUnsigned()
                                                                    ->setIntegerLength(10)),
                'author_id'           => new Field((new NumberValidator())->setInteger()
                                                                    ->setUnsigned()
                                                                    ->setIntegerLength(10))
                

            ];
        }

       
    }
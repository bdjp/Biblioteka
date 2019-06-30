<?php 
    namespace App\Models;

    use App\Core\Model;
    use App\Core\Field;
    use App\Validators\NumberValidator;
    use App\Validators\StringValidator;
    
    class ActiveModel extends Model {
        protected function getFields(): array {
            return [
                'active_id'     => new Field((new NumberValidator())->setInteger()
                                                                    ->setUnsigned()
                                                                    ->setIntegerLength(10), false),
                
                'name'           => new Field((new StringValidator())->setMaxLength(255)),

            ];
        }

       
    }
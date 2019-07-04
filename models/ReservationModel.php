<?php 
    namespace App\Models;

    use App\Core\Model;
    use App\Core\Field;
    use App\Validators\NumberValidator;
    use App\Validators\StringValidator;
    use App\Validators\DateTimeValidator;
    use App\Validators\BitValidator;

    class ReservationModel extends Model{
        protected function getFields(): array {
            return [
                'reservation_id'      =>  new Field((new NumberValidator())->setInteger()
                                                                            ->setUnsigned()
                                                                            ->setIntegerLength(10), false),
                'created_at'          => new Field(new DateTimeValidator()),

                'expires_at'          => new Field((new DateTimeValidator())->allowDate()->allowTime()),
                
                'student_id'          =>  new Field((new NumberValidator())->setInteger()
                                                                            ->setUnsigned()
                                                                            ->setIntegerLength(10)),
                'librarian_id'        =>  new Field((new NumberValidator())->setInteger()
                                                                            ->setUnsigned()
                                                                            ->setIntegerLength(10)),
                'book_id'             =>  new Field((new NumberValidator())->setInteger()
                                                                            ->setUnsigned()
                                                                            ->setIntegerLength(10)),                                                            
                'taken'              => new Field(new BitValidator()),
                'returned'           => new Field(new BitValidator()),
                'stud_res'           => new Field(new BitValidator()),
                'stud_res_id'         => new Field((new NumberValidator())->setInteger()
                                                                         ->setUnsigned()
                                                                         ->setIntegerLength(10)), 
                'stud_res_app'           => new Field(new BitValidator())                                                      
            ];
        }

        public function getAllByBookId(int $bookId): array {
            $items = $this->getAllByFieldName('book_id', $bookId);
            usort($items, function($a, $b) {
                return strcmp($a->expires_at, $b->expires_at);
            });
            return $items;
        }

       
    }
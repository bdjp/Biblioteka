<?php 
    namespace App\Models;

    use App\Core\Model;
    use App\Core\Field;
    use App\Validators\NumberValidator;
    use App\Validators\StringValidator;
    use App\Validators\DateTimeValidator;

    class ReservationModel extends Model{
        protected function getFields(): array {
            return [
                'reservation_id'      =>  new Field((new NumberValidator())->setInteger()
                                                                            ->setUnsigned()
                                                                            ->setIntegerLength(10), false),
                'created_at'          => new Field(new DateTimeValidator(), false),

                'expires_at'          => new Field(new DateTimeValidator(), false),
                
                'student_id'         =>  new Field((new NumberValidator())->setInteger()
                                                                            ->setUnsigned()
                                                                            ->setIntegerLength(10)),
                'category_id'        =>  new Field((new NumberValidator())->setInteger()
                                                                            ->setUnsigned()
                                                                            ->setIntegerLength(10)),
                'librarian_id'       =>  new Field((new NumberValidator())->setInteger()
                                                                            ->setUnsigned()
                                                                            ->setIntegerLength(10))
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
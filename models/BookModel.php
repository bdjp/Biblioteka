<?php 
    namespace App\Models;

    use App\Core\Model;
    use App\Core\Field;
    use App\Validators\NumberValidator;
    use App\Validators\StringValidator;
    use App\Validators\DateTimeValidator;
    use App\Validators\BitValidator;

    class BookModel extends Model {
        protected function getFields(): array {
            return [
                'book_id'      => new Field((new NumberValidator())->setInteger()
                                                                   ->setUnsigned()
                                                                   ->setIntegerLength(10), false),

                'title'        => new Field((new StringValidator())->setMaxLength(255)),
                'description'  => new Field((new StringValidator())->setMaxLength(64000)),
                'isbn'         => new Field((new NumberValidator())->setIntegerLength(13)),
                'published_at' => new Field((new DateTimeValidator())->allowDate()->allowTime()),
                'image_path'   => new Field((new StringValidator())->setMaxLength(255)),
                

                'category_id'  => new Field((new NumberValidator())->setInteger()
                                                                    ->setUnsigned()
                                                                    ->setIntegerLength(10)),
                'librarian_id' => new Field((new NumberValidator())->setInteger()
                                                                    ->setUnsigned()
                                                                    ->setIntegerLength(10)),
                'active_id'    => new Field((new NumberValidator())->setInteger()
                                                                    ->setUnsigned()
                                                                    ->setIntegerLength(10)),
            ];
        }

        public function getAllByCategoryId(int $categoryId): array {
            return $this->getAllByFieldName('category_id', $categoryId);
        
        }

        public function getAllBySearch($keyword) {
            $sql = 'SELECT
                        *
                    FROM
                        book
                    WHERE
                        title LIKE ? ';
                    
            
            $prep = $this->getDatabaseConnection()->getConnection()->prepare($sql);

            $res = $prep->execute([ '%' . $keyword . '%' ]);

            if ($res) {
                return $prep->fetchAll(\PDO::FETCH_OBJ);
            }

            return [];
        }
    }
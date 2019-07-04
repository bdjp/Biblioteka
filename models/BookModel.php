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
                'published_at' => new Field((new DateTimeValidator())->allowDate()->disallowTime()),
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

        public function getAllByIsbn($isbn) {
            $sql = 'SELECT
                        *
                    FROM
                        book
                    WHERE
                        isbn LIKE ? ';
                    
            
            $prep = $this->getDatabaseConnection()->getConnection()->prepare($sql);

            $res = $prep->execute([ $isbn ]);

            if ($res) {
                return $prep->fetch(\PDO::FETCH_OBJ);
            }

            return [];
        }


        public function getAllByAnyWord($keyword) {
            $sql = 'SELECT
                        book.*
                    FROM
                        book
                        LEFT JOIN book_author ON book_author.book_id = book.book_id
                        LEFT JOIN author ON author.author_id = book_author.author_id
                    WHERE
                        book.title LIKE ? 
                        OR  book.isbn LIKE ? 
                        OR  author.forename LIKE ? 
                        OR  author.surname LIKE ? 
                    GROUP BY
                        book.book_id';
                    
            
            $prep = $this->getDatabaseConnection()->getConnection()->prepare($sql);

            $res = $prep->execute([ '%' . $keyword . '%',  $keyword , '%' . $keyword . '%', '%' . $keyword . '%' ]);

            if ($res) {
                return $prep->fetchAll(\PDO::FETCH_OBJ);
            }

            return [];
        }
    }
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
                'book_id'      => new Field((new NumberValidator())->setIntegerLength(11), false),

                'title'        => new Field((new StringValidator())->setMaxLength(255)),
                'description'  => new Field((new StringValidator())->setMaxLength(64*1024)),
                'isbn'         => new Field((new NumberValidator())->setIntegerLength(13)),
                'published_at' => new Field((new DateTimeValidator())->allowDate()->allowTime()),
                'image_path'   => new Field((new StringValidator())->setMaxLength(255)),
                'is_active'    => new Field(new BitValidator()),

                'category_id'  => new Field((new NumberValidator())->setIntegerLength(11)),
                'librarian_id' => new Field((new NumberValidator())->setIntegerLength(11))
            ];
        }

        public function getAllByCategoryId(int $categoryId): array {
            return $this->getAllByFieldName('category_id', $categoryId);
        
        }
    }
<?php
    namespace App\Core;

    abstract class Model {
        private $dbc;

        final public function __construct(DatabaseConnection &$dbc) {
            $this->dbc = $dbc;
        }

        final protected function getConnection() {
            return $this->dbc->getConnection();
        }

        final private function getTableName(): string {
            $matches= [];
            preg_match('|^.*\\\((?:[A-Z][a-z]+)+)Model$|', static::class, $matches);
            return substr(\strtolower(\preg_replace('|[A-Z]|', '_$0', $matches[1] ?? '')), 1);
        }

        final private function getPrimaryKeyName(): string {
            return $this->getTableName() . '_id';
        }



        final public function getById(int $id): ?\stdClass {
            $tableName = $this->getTableName();
            $sql = 'SELECT * FROM ' . $tableName .' WHERE ' . $tableName . '_id = ?;';
            $prep = $this->dbc->getConnection()->prepare($sql);
            $res = $prep->execute([$id]);

            $item = NULL;
            if($res) {
                $item = $prep->fetch(\PDO::FETCH_OBJ);
            }
            return $item;
        }

        final public function getAll(): array {
            $tableName = $this->getTableName();
            $sql = 'SELECT * FROM ' . $tableName . '; ';
            $prep = $this->dbc->getConnection()->prepare($sql);
            $res = $prep->execute();

            $items = [];
            if($res) {
                $items = $prep->fetchAll(\PDO::FETCH_OBJ);
            }
            return $items;
        }

        private function isFieldNameValid(string $fieldName) {
            return boolval(preg_match('|^[a-z][a-z_0-9]+[a-z0-9]$|', $fieldName));
        }


        final public function getByFieldName(string $fieldName, $value) {
            if(!$this->isFieldNameValid($fieldName)) {
                throw new Exception ('Invalid field name: '. $fieldName);
            }

            $tableName = $this->getTableName();
            $sql = 'SELECT * FROM ' . $tableName .' WHERE ' . $fieldName . ' = ?;';
            $prep = $this->dbc->getConnection()->prepare($sql);
            $res = $prep->execute([$value]);

            $item = NULL;
            if($res) {
                $item = $prep->fetch(\PDO::FETCH_OBJ);
            }
            return $item;
        }

        final public function getAllByFieldName(string $fieldName, $value)  {
            if($this->isFieldNameValid($fieldName) == false) {
                throw new Exception ('Invalid field name: '. $fieldName);
            }

            $tableName = $this->getTableName();
            $sql = 'SELECT * FROM ' . $tableName .' WHERE ' . $fieldName . '= ?;';
            $prep = $this->dbc->getConnection()->prepare($sql);
            $res = $prep->execute([$value]);

            $items = [];
            if($res) {
                $items = $prep->fetchAll(\PDO::FETCH_OBJ);
            }
            return $items;
        }
       
    }
<?php
    namespace App\Core;

    abstract class Model {
        private $dbc;

        final public function __construct(DatabaseConnection &$dbc) {
            $this->dbc = $dbc;
        }

        //doprema informaciju o spisku svih onih polja koja postoje u tabeli i koja mozemo da menjamo
        // kao i informacija sta znaci validna vrednost za to polje

        protected function getFields(): array {
            return [];
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


        final private function checkFieldList(array $data) {
            $fields = $this->getFields();

            $supportedFieldNames = array_keys($fields);
            $requestedFieldNames = array_keys($data);

            foreach ($requestedFieldNames as $requestedFieldName) {
                if(!\in_array($requestedFieldName, $supportedFieldNames)) {
                    throw new \Exception('Field ' . $requestedFieldName . ' is not supported!');
                }

                if( !$fields[$requestedFieldName]->isEditable()) {
                    throw new \Exception('Field ' . $requestedFieldName . ' is not editable!');
                }

                if( !$fields[$requestedFieldName]->isValid($data[$requestedFieldName])) {
                    throw new \Exception('The value for the field ' . $requestedFieldName . ' is not valid!');
                }
            }
        }

        final public function add(array $data) {
            $this-checkFieldList($data);

            $tableName = $this->getTableName();
            $sqlFieldNames = implode(', ', array_keys($data));
            $questionMarks = str_repeat('?,', \count($data));
            $questionMarks = substr($questionMarks, 0, -1);
            $sql = "INSERT INTO {$tableName} ({$sqlFieldNames}) VALUES ({$questionMarks});";
            $prep = $this->dbc->getConnection()->prepare($sql);
            $res = $prep->execute(array_values($data));

            if(!$res) {
                return false;
            }
            return $this->dbc->getConnection()->lastInsertId();
        }
        

        final public function editById(int $id, array $data) {
            $this->checkFieldList($data);

            $tableName = $this->getTableName();
            $editlist = [];
            foreach (array_keys($data) as $fieldName => $value) {
                $editlist[] = "{$fieldName} =?";
                $values[] = $value;
            }
            $editString = implode(', ', $editlist);
            $values[] = $id;

            $sql = "UPDATE {$tableName} SET {$editString} WHERE {$tableName}_id = ?;";
            $prep = $this->dbc->getConnection()->prepare($sql);
            return $prep->execute($values);
        }
        

        final public function deleteById(int $id) {
            $tableName = $this->getTableName();
            $sql = 'DELETE  FROM ' . $tableName .' WHERE ' . $tableName . '_id = ?;';
            $prep = $this->dbc->getConnection()->prepare($sql);
            return $prep->execute([$id]);

            
        }
    }
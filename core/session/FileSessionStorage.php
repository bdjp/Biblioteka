<?php
namespace App\Core\Session;

class FileSessionStorage implements SessionStorage {
        private $path;

        public function __construct($path) {
            $this->path = $path;
        }

        public function save($sessionId, $data) {
            @mkdir($this->path, 0755, true);
            $sessionFile = $this->path . $sessionId . '.json';
            $dataJson = json_encode($data);
            file_put_contents($sessionFile, $dataJson);
        }

        public function load($sessionId) {
            $sessionFile = $this->path . $sessionId . '.json';

            if (!file_exists($sessionFile)) {
                return (object) [];
            }

            $dataJson = file_get_contents($sessionFile);
            $data = json_decode($dataJson);

            if (!$data) {
                return (object) [];
            }

            return $data;
        }

        public function delete($sessionId) {
            unlink($this->path . $sessionId . '.json');
        }

        public function cleanUp($age) {
            // ???
        }
    }

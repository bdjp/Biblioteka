<?php
    namespace App\Core\Session;

    class FileSessionStorage implements SessionStorage {
        private $sessionPath;

        public function __construct( $sessionPath) {
            $this->sessionPath = $sessionPath;
        }
        public function save($sessionId, $sessionData) {
            $sessionFileName = $this->sessionPath . $sessionId . '.json';
            file_put_contents($sessionFileName, $sessionData);
        }

        public function load($sessionId): string {
            $sessionFileName = $this->sessionPath . $sessionId . '.json';
            if(!file_exists($sessionFileName)) {
                return '{}';
            }
            return \file_get_contents($sessionFileName);
        }

        public function delete($sessionId){
            $sessionFileName = $this->sessionPath . $sessionId . '.json';

            if(!file_exists($sessionFileName)) {
                unlink($sessionFileName);
            }
        }

        public function cleanUp(int $sessionAge){
            // TODO: Implement
        }
    }
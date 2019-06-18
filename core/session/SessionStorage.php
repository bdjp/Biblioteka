<?php
    namespace App\Core\Session;

    interface SessionStorage {
        public function save($sessionId, $data);
        public function load($sessionId);
        public function delete($sessionId);
        public function cleanUp($age);
    }
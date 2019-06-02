<?php
    namespace App\Core\Session;

    interface SessionStorage {

        public function save(string $essionId, string $sessionData);
        public function load(string $essionId): string;
        public function delete(string $essionId);
        public function cleanUp(int $sessionAge);
    }
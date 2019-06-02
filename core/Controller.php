<?php
    namespace App\Core;

    class Controller {  // Osnovni kontroler - ostali kontroleri ne moraju da brinu u implementaciji konstruktora i uzimanju dbc
        private $dbc;
        private $session;
        private $data = [];

        
        // Ucicemo ovaj konstructor Finalnim, kako ne bi mogle klase koje nasledjuju osnovni kontroler da promene ovo ponasanje
        final public function __construct(\App\Core\DatabaseConnection &$dbc) {
            $this->dbc = $dbc;
        }
        final public function &getSession(): \App\Core\Session\Session {
            return $this->session;
        }

        final public function setSession(\App\Core\Session\Session &$session) {
            $this->session = $session;
        }

        // dbc je dostupan klasama koje je nasledjuju ovaj kontroler kroz Geter
        final public function &getDatabaseConnection(): \App\Core\DatabaseConnection {
            return $this->dbc;  // objekat dbc vracamo po referenci
        }

        // public i protected clanovi podaci mogu da budu pozvani od strane klase koja nasledjuje ovu klasu
        // private clanovi ne mogu biti pozvani

        final protected function set(string $name, $value): bool {
            $result = false;
            
            if (preg_match('/^[a-z][a-z0-9]+(?:[A-Z][a-z0-9]+)*$/', $name)) {
                $this->data[$name] = $value;
                $result = true;
            }
            return $result;
        }

        final public function getData(): array {  // vraca vrednost data
            return $this->data;
        }
    }
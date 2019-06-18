<?php
    namespace App\Core\Role;

    class LibrarianRoleController extends \App\Core\Controller {
        public function __pre() {

            if (!$this->getSession()->get('libId', null)) {
                ob_clean();
                header('Location: ' . BASE . 'user/login', true, 307);
                exit;
            }
        }
    }
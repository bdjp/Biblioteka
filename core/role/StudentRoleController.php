<?php
    namespace App\Core\Role;

    class StudentRoleController extends \App\Core\Controller {
        public function __pre() {

            if (!$this->getSession()->get('studentId', null)) {
                ob_clean();
                header('Location: ' . BASE . 'user/login', true, 307);
                exit;
            }
        }
    }
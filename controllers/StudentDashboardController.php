<?php
    namespace App\Controllers;

    use App\Core\Role\StudentRoleController;
    use App\Models\CategoryModel;

    class StudentDashboardController extends  StudentRoleController{

       public function index() {
           
       }

       public function getSearch() {
         $cm = new CategoryModel($this->getDatabaseConnection());
         $items = $cm->getAll();
         $this->set('categories', $items);
       }
    }
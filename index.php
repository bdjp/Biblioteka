<?php

    require_once 'vendor/autoload.php';

    use App\Core\DatabaseConnection;
    use App\Core\DatabaseConfiguration;
    use App\Models\UserModel;

    $databaseConfiguration = new DatabaseConfiguration('localhost', 'root', '', 'auction_project');
    $databaseConnection = new databaseConnection($databaseConfiguration);
    

    $controller = new \App\Controllers\MainController($databaseConnection);
    $data = $controller->home();
    print_r($data);
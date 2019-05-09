<?php

    require_once('DatabaseConfiguration.php');
    require_once('DatabaseConnection.php');
    require_once('models/UserModel.php');


    $databaseConfiguration = new DatabaseConfiguration('localhost', 'root', '', 'auction_project');
    $databaseConnection = new databaseConnection($databaseConfiguration);
    

    $userModel = new UserModel($databaseConnection);

    $user = $userModel->getByUsername('user_one');


    print_r($user);

 
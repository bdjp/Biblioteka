<?php
    require_once 'Configuration.php';
    require_once 'vendor/autoload.php';

    ob_start();

    use App\Core\DatabaseConnection;
    use App\Core\DatabaseConfiguration;
    use App\Models\UserModel;
    use App\Core\Router;

    $databaseConfiguration = new DatabaseConfiguration(
        Configuration::DATABASE_HOST,
        Configuration::DATABASE_USER,
        Configuration::DATABASE_PASS,
        Configuration::DATABASE_NAME
    );

    $databaseConnection = new databaseConnection($databaseConfiguration);
    
    $url = strval(filter_input(INPUT_GET, 'URL'));
    $httpMethod = filter_input(INPUT_SERVER, 'REQUEST_METHOD');

    $router = new Router();
    foreach (require_once 'Routes.php' as $route) {
        $router->add($route);
    }

    $foundRoute = $router->find($httpMethod, $url);
    $arguments = $foundRoute->extractArguments($url);
    $method = $foundRoute->getMethodName();
    
    
    $fullControllerName = '\\App\\Controllers\\' . $foundRoute->getControllerName() . 'Controller';

    $controllerInstance = new $fullControllerName($databaseConnection);

    $sessionStorageClassName = Configuration::SESSION_STORAGE;
    $sessionStorageArgs = Configuration::SESSION_STORAGE_DATA;
    $sessionStorage = new $sessionStorageClassName(...$sessionStorageArgs);

    $session = new \App\Core\Session\Session($sessionStorage, Configuration::SESSION_LIFETIME);
    $controllerInstance->setSession($session);
    $controllerInstance->getSession()->reload();

    call_user_func_array([$controllerInstance, $method], $arguments);
    $controllerInstance->getSession()->save();

    $data = $controllerInstance->getData();

   /* foreach ($data as $name => $value) {
        $$name = $value;
    }

    require_once 'views/' . $foundRoute->getControllerName() . '/'. $foundRoute->getMethodName() . '.php';*/

    if($controllerInstance instanceof \App\Core\ApiController) {
        ob_clean();
        header('Content-type: application/json; charset=utf-8');
        header('Access-Control-Allow-Origin: *');
        echo json_encode($data);
        exit;
    }


    $loader = new Twig_Loader_Filesystem("./views"); // mesto ucitavanja datoka za view generatore
    $twig = new Twig_Environment($loader, [
        "cache" => "./twig-cache",
        "auto_reload" => true
    ]);

    

    echo $html = $twig->render($foundRoute->getControllerName() . '/'. $foundRoute->getMethodName() . '.html', $data);
    
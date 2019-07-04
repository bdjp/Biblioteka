<?php
/*
    require_once 'Configuration.php';
    require_once 'vendor/autoload.php';

    ob_start();

    use App\Core\DatabaseConnection;
    use App\Core\DatabaseConfiguration;
    use App\Models\UserModel;
    use App\Core\Router;

    $databaseConfiguration = new DatabaseConfiguration(
        \Configuration::DATABASE_HOST,
        \Configuration::DATABASE_USER,
        \Configuration::DATABASE_PASS,
        \Configuration::DATABASE_NAME
    );

    define('BASE', Configuration::BASE);

    $databaseConnection = new databaseConnection($databaseConfiguration);
    
    $url = strval(filter_input(INPUT_GET, 'URL'));
    $httpMethod = filter_input(INPUT_SERVER, 'REQUEST_METHOD');

    $router = new Router();
    foreach (require_once 'Routes.php' as $route) {
        $router->add($route);
    }
    /*print($httpMethod);
    print($url);
    exit;

    $foundRoute = $router->find($httpMethod, $url);
    

    $arguments = $foundRoute->extractArguments($url);
    $method = $foundRoute->getMethodName();
    
    
    $fullControllerName = '\\App\\Controllers\\' . $foundRoute->getControllerName() . 'Controller';

    $controllerInstance = new $fullControllerName($databaseConnection);

    $fingerpringProviderFactoryClass = Configuration::FINGERPRINT_PROVIDER_FACTORY;
    $fingerpringProviderFactoryMethod = Configuration::FINGERPRINT_PROVIDER_METHOD;
    $fingerpringProviderFactoryArgs = Configuration::FINGERPRINT_PROVIDER_ARGS;
    $fingerpringProviderFactory = new $fingerpringProviderFactoryClass;
    $fingerpringProvider = $fingerpringProviderFactory->$fingerpringProviderFactoryMethod(...$fingerpringProviderFactoryArgs);


    $sessionStorageClassName = Configuration::SESSION_STORAGE;
    $sessionStorageArgs = Configuration::SESSION_STORAGE_DATA;
    $sessionStorage = new $sessionStorageClassName(...$sessionStorageArgs);

    $session = new \App\Core\Session\Session($sessionStorage, Configuration::SESSION_LIFETIME);
    $session->setFingerpringProvider($fingerpringProvider);
    
    $controllerInstance->setSession($session);
    $controllerInstance->getSession()->reload();
    $controllerInstance->__pre();

    call_user_func_array([$controllerInstance, $method], $arguments);
    $controllerInstance->getSession()->save();

    $data = $controllerInstance->getData();


    require_once 'views/' . $foundRoute->getControllerName() . '/'. $foundRoute->getMethodName() . '.php';

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
    
    $data['BASE'] = BASE;
    

    echo $html = $twig->render($foundRoute->getControllerName() . '/'. $foundRoute->getMethodName() . '.html', $data);
    */
    require_once 'Configuration.php';
    require_once 'vendor/autoload.php';

    ob_start();

    use App\Core\DatabaseConfiguration;
    use App\Core\DatabaseConnection;
    use App\Core\Router;
    use App\Core\ApiController;
    use App\Core\Session\Session;

    $dbConf = new DatabaseConfiguration(
        \Configuration::DATABASE_HOST,
        \Configuration::DATABASE_USER,
        \Configuration::DATABASE_PASS,
        \Configuration::DATABASE_NAME
    );

    define('BASE', Configuration::BASE);

        $router = new Router();
        foreach (require_once 'Routes.php' as $route) {
            $router->add($route);
        }

        $url = strval(filter_input(INPUT_GET, 'URL'));
        $httpMethod = filter_input(INPUT_SERVER, 'REQUEST_METHOD');

        $foundRoute = $router->find($httpMethod, $url);

        $dbCon = new App\Core\DatabaseConnection($dbConf);

        $sessionStorageClassName = Configuration::SESSION_STORAGE_CLASS;
        $sessionStorage = new $sessionStorageClassName(...Configuration::SESSION_STORAGE_ARGUMENTS);
        $session = new Session($sessionStorage);

        $fingerprintProviderClassName = Configuration::FINGERPRINT_PROVIDER_CLASS;
        $fingerprintProvider = new $fingerprintProviderClassName();
        $session->setFingerprintProvider($fingerprintProvider);

        $session->reload();
        $fullControllerName = 'App\\Controllers\\'. $foundRoute->getControllerName() . 'Controller';
        $method = $foundRoute->getMethodName();

        $parameters = $foundRoute->extractArguments($url);
        $controllerInstance = new $fullControllerName($dbCon);
        $controllerInstance->setSession($session);

        $controllerInstance->__pre();
        call_user_func_array([ $controllerInstance, $method ], $parameters);

        $controllerInstance->getSession()->save();

        $data = $controllerInstance->getData();

    //Poziv apija
    if($controllerInstance instanceof ApiController) {
        ob_clean();
        header('Content-type: application/json; charset=utf-8');
        header('Access-Control-Allow-Origin: *');
        echo json_encode($data);
        exit;
    }


    // Twig tip controllera
    $loader = new Twig_Loader_Filesystem('./views');
    $twig = new Twig_Environment($loader, [
    'cache' => './twig-cache',
    'auto_reload' => true
    ]);

    $data['BASE'] = BASE;
    $data['SESSION'] = $session->getData();

    echo $twig->render($foundRoute->getControllerName() . '/' . $foundRoute->getMethodName() . '.html', $data);
<?php 
    namespace App\Core;
    
   /* final class Route {

        private $requestMethod = 'any';
        private $pattern;
        private $controller;
        private $method;



        private function  __construct (string $requestMethod, string $pattern, string $controller, string $method) {
            $this->requestMethod = $requestMethod;
            $this->pattern = $pattern;
            $this->controller = $controller;
            $this->method = $method;
        }

        public static function get(string $controller, string $pattern, string $method): Route {
            return new Route('GET', $pattern, $controller, $method);
        }

        public static function post(string $controller, string $pattern, string $method): Route {
            return new Route('POST',$pattern, $controller, $method);
        }

        public static function any(string $controller, string $pattern, string $method): Route {
            return new Route('GET|POST',$pattern, $controller, $method);
        }

        public function matches($method,  $url): bool {
            if (preg_match('/^' . $this->requestMethod . '$/', $method)) {
                return false;
            }

            return boolval (preg_match($this->pattern, $url));
        }  */

        class Route {
            private $controllerName;
            private $methodName;
            private $pattern;
            private $httpMethod;
        
            private function __construct($httpMethod, $pattern, $controllerName, $methodName) {
                $this->httpMethod     = $httpMethod;
                $this->pattern        = $pattern;
                $this->controllerName = $controllerName;
                $this->methodName     = $methodName;
            }
        
            public static function get($pattern, $controllerName, $methodName) {
                return new Route('GET', $pattern, $controllerName, $methodName);
            }
        
            public static function post($pattern, $controllerName, $methodName) {
                return new Route('POST', $pattern, $controllerName, $methodName);
            }
        
            public static function any($pattern, $controllerName, $methodName) {
                return new Route('GET|POST', $pattern, $controllerName, $methodName);
            }
        
            public function matches($httpMethod, $url) {
                if (!\preg_match('/^' . $this->httpMethod . '$/', $httpMethod)) {
                    return false;
                }
        
                if (!\preg_match($this->pattern, $url)) {
                    return false;
                }
        
                return true;
            }

        public function getControllerName(): string {
            return $this->controllerName;
        }

        public function getMethodName(): string {
            return $this->methodName;
        }

        public function &extractArguments(string $url): array {
            $arguments = [];
            preg_match_all($this->pattern, $url, $arguments);

            return $arguments;
        }
    }
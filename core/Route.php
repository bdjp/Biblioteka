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

        /*public function &extractArguments($url): array {
            $arguments = [];
            preg_match_all($this->pattern, $url, $arguments);

            return $arguments;
        } */ //OVDE JE BILA GRESKA

          public function &extractArguments($url) {
            # Polazna pretpostavka je da nema uparenih grupa iz URL-a
            $matches = [];
    
            # Metod koji po regularnom izrazu iz URL-a uzima uaprene grupe
            preg_match_all($this->pattern, $url, $matches);
    
            # Brisemo brvi element niza, jer on sadrzi ceo URL
            unset($matches[0]);
    
            # Pripremimo niz za buduce argumente izvucene iz URL-a na osnovu reg. izr.
            $arguments = [];
    
            # Za svaku uparenu grupu iz matches uzimamo samo vrednost argumenta
            foreach ($matches as $match) {
                # i dodajemo tu vrednos tu prethodno napravljeni niz argumenata
                $arguments[] = $match[0];
            }
    
            # Tako napravljeni niz vracamo nazad da bude prosledjen metodu kontrolera
            return $arguments;
        }
    }
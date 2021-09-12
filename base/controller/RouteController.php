<?php

namespace base\controller;

use base\settings\Settings;

class RouteController extends BaseController
{
    use Singleton;

    private function __construct()
    {
        $address_str = $_SERVER['REQUEST_URI'];

        if($_SERVER['QUERY_STRING']) {
            $address_str = substr($address_str, 0, strpos($address_str, $_SERVER['QUERY_STRING']) - 1);
        }

        $path = substr($_SERVER['PHP_SELF'], 0, strpos($_SERVER['PHP_SELF'], 'index.php'));

        if($path === PATH) {
            if(strrpos($address_str, '/') === strlen($address_str) - 1 &&
                strrpos($address_str, '/') !== strlen(PATH) - 1) {
                $redirect = rtrim($address_str, '/');

                header("Location: $redirect");
                exit;
            }

            $this->routes = Settings::get('routes');

            if(!$this->routes) echo '////////////////////////////mistake//////////////////////////////';

            $url = explode('/', substr($address_str, strlen(PATH)));

            if($url[0] && $url[0] === $this->routes['admin']['alias']) {

//                if (!isset($_SESSION['admin'])) header("Location: /main");

                array_shift($url);

                $this->controller = $this->routes['admin']['path'];

                $route = 'admin';
            } else {

                $this->controller = $this->routes['user']['path'];

                $route = 'user';
            }
        }

        $this->createRoute($route, $url);

        if($url[1]) {
//            $this->page = $url[1];
            $count = count($url);
            $key = '';

            if($route = 'user') {
                $i = 1;
            }else{
                $i = 2;
            }

            for( ; $i < $count; $i++) {
                if(!$key) {
                    $key = $url[$i];
                    $this->parameters[$key] = '';
                }else{
                    $this->parameters[$key] = $url[$i];
                    $key = '';
                }
            }
        }
    }

    private function createRoute($var, $arr) {
        $route = [];

        if(!empty($arr[0])) {
            if($this->routes[$var]['routes'][$arr[0]]) {
                $route = explode('/', $this->routes[$var]['routes'][$arr[0]]);

                $this->controller .= ucfirst($route[0].'Controller');
            }else{
                $this->controller .= ucfirst($arr[0].'Controller');
            }
        }else{
            $this->controller .= $this->routes['default']['controller'];
        };

        $this->inputMethod = $route[1] ? $route[1] : $this->routes['default']['inputMethod'];
        $this->outputMethod = $route[2] ? $route[2] : $this->routes['default']['outputMethod'];

        return;
    }
}
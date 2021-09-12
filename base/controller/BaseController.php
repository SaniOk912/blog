<?php

namespace base\controller;
use base\model\Model;
use base\settings\Settings;

class BaseController
{
    protected $controller;
    protected $inputMethod;
    protected $outputMethod;
    protected $parameters;

    protected $content;
    protected $header;
    protected $footer;
    protected $template;

    protected $routes;
    protected $page;
    protected $data;
    protected $model;
    protected $columns;
    protected $table;
    protected $id;
    protected $action;

    public function route()
    {
        $controller = str_replace('/', '\\', $this->controller);

        try{
            $object = new \ReflectionMethod($controller, 'request');

            $args = [
                'parameters' => $this->parameters,
                'inputMethod' => $this->inputMethod,
                'outputMethod' => $this->outputMethod
            ];

            $object->invoke(new $controller, $args);
        }
        catch (\ReflectionException $e) {
            echo '<br>' . "controller doesn't exists" . '<br>' . $controller . '<br>';
            echo $e;
//            throw new RouteException($e->getMessage());
        }
    }

    public function request($args)
    {
        $this->parameters = $args['parameters'];

        $inputData = $args['inputMethod'];
        $outputData = $args['outputMethod'];

        $data = $this->$inputData();

        if(method_exists($this, $outputData)) {

            $page = $this->$outputData($data);
            if($page) {
                $this->page = $page;
            }

        }elseif($data){
            $this->page = $data;
        }

//        if($this->errors) {
//            $this->writeLog($this->errors);
//        }

        $this->getPage();
    }

    protected function getPage()
    {
        if(is_array($this->page)) {
            foreach ($this->page as $block) echo $block;
        }else{
            echo $this->page;
        }
    }

    protected function render($path = '', $parameters = [])
    {
        extract($parameters);

        if(!$path) {

            $class = new \ReflectionClass($this);

            $space = str_replace('\\','/', $class->getNamespaceName() . '\\');
            $routes = Settings::get('routes');

            if($space === $routes['user']['path']) $template = TEMPLATE;
            else $template = ADMIN_TEMPLATE;

            $path = $template . explode('controller', strtolower($class->getShortName()))[0];
        }

        ob_start();

        if(!@include_once $path . '.php') throw new RouteException('Такого шаблона не существует - ' . $path);

        return ob_get_clean();
    }

}
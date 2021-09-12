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

    protected function createTableData($settings = false) {

        if(!$this->table) {
            if($this->parameters) $this->table = array_keys($this->parameters)[0];
            else{
                if(!$settings) $settings = Settings::instance();
                $this->table = $settings::get('defaultTable');
            }
            if(!$this->id) $this->id = $this->parameters[$this->table];
        }

        $this->columns = $this->model->showColumns($this->table);
    }

    protected function createData($arr = [])
    {
        $fields = [];

        if(!$this->columns['id_row']) return $this->data = [];
        if($this->columns['name']) $fields['name'] = 'name';

        $fields[] = $this->columns['id_row'] . ' as id';

        if(count($fields) < 3) {
            foreach ($this->columns as $key => $item) {
                if(!$fields['name'] && strpos($key, 'name') !== false) {
                    $fields['name'] = $key . ' as name';
                }
                if(!$fields['img'] && strpos($key, 'img') === 0) {
                    $fields['img'] = $key . ' as img';
                }
            }
        }
        print_arr($fields);

        if($arr['fields']) {

            if(is_array($arr['fields'])) {

                for($i = 0; $i < count($arr['fields']); $i++) {

                    if(key_exists($arr['fields'][$i], $this->columns)) $fields[] = $arr['fields'][$i];
                }

            }elseif(key_exists($arr['fields'], $this->columns)) $fields[] = $arr['fields'];
        }
        if($arr['where']) $where = $arr['where'];

        $this->data = $this->model->get($this->table, [
            'fields' => $fields,
            'where' => $where
        ]);

        if($fields['img']) {
            foreach ($this->data as $key => $value) {
                $this->data[$key]['img'] = implode(',' , json_decode($value['img']));
            }
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

    protected function clearStr($str) {

        if(is_array($str)) {
            foreach ($str as $key => $item) $str[$key] = trim(strip_tags($item));
            return $str;
        }else{
            return trim(strip_tags($str));
        }

    }

    protected function clearNum($num) {
        return $num * 1;
    }

    protected function clearPostFields()
    {
        $arr = &$_POST;
        foreach ($arr as $key => $value) {
            $arr[$key] = $this->clearStr($value);
        }
    }

    protected function checkPost()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->clearPostFields();
            $this->table = $this->clearStr($_POST['table']);
            unset($_POST['table']);

            if($this->table) $this->editData();
        }
    }

    protected function editData()
    {
        $method = $this->action;
//        print_arr($this->table);

        if($_POST[$this->columns['id_row']]) {
            echo'123';
            $id = is_numeric($_POST[$this->columns['id_row']]) ?
                $this->clearNum($_POST[$this->columns['id_row']]) :
                $this->clearStr($_POST[$this->columns['id_row']]);
            if($id) {
                $where = [$this->columns['id_row'] => $id];
                $method = 'edit';
            }
        }



//        Model::instance()->$method($this->table, $_POST);
    }
}
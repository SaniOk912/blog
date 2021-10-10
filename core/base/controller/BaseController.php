<?php

namespace core\base\controller;

//use core\base\model\Model;
use core\base\settings\Settings;
use libraries\FileEdit;
//use core\base\exceptions\RouteException;

abstract class BaseController
{
    use BaseMethods;

    protected $controller;
    protected $inputMethod;
    protected $outputMethod;
    protected $parameters;

    protected $content;
    protected $header;
    protected $footer;
    protected $template;
    protected $settings;
    protected $fileArray;
    protected $styles;
    protected $scripts;

    protected $routes;
    protected $page;
    protected $data;
    protected $model;
    protected $columns;
    protected $table;
    protected $action;
    protected $alias;

    protected $isAjax;

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

    protected function init($admin = false) {

        if(!$admin) {
            if(USER_CSS_JS['styles']) {
                foreach(USER_CSS_JS['styles'] as $item) $this->styles[] = PATH . TEMPLATE . trim($item, '/');
            }

            if(USER_CSS_JS['scripts']) {
                foreach(USER_CSS_JS['scripts'] as $item) $this->scripts[] = PATH . TEMPLATE . trim($item, '/');
            }
        }else{
            if(ADMIN_CSS_JS['styles']) {
                foreach(ADMIN_CSS_JS['styles'] as $item) $this->styles[] = PATH . ADMIN_TEMPLATE . trim($item, '/');
            }

            if(ADMIN_CSS_JS['scripts']) {
                foreach(ADMIN_CSS_JS['scripts'] as $item) $this->scripts[] = PATH . ADMIN_TEMPLATE . trim($item, '/');
            }
        }
    }

    protected function createTableData() {

        if(!$this->table) {
            if($this->parameters) $this->table = array_keys($this->parameters)[0];
            else{
                $settings = Settings::instance();
                $this->table = $settings::get('defaultTable');
            }
        }

        $this->columns = $this->model->showColumns($this->table);

//        if(!$this->columns) new RouteException('cant find fields in table ' . $this->table, 2);
    }

    protected function createData($arr = false)
    {
        $fields = [];

        if(!$this->columns['id_row']) return $this->data = [];

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

        if($arr['fields']) {

            if(is_array($arr['fields'])) {

                for($i = 0; $i < count($arr['fields']); $i++) {

                    if(key_exists($arr['fields'][$i], $this->columns)) $fields[$arr['fields'][$i]] = $arr['fields'][$i];
                }

            }elseif(key_exists($arr['fields'], $this->columns)) $fields[] = $arr['fields'];
        }

        $this->data = $this->model->get($this->table, [
            'fields' => $fields
        ]);
    }

    protected function editData()
    {
        $method = $this->action;

        if($_POST[$this->columns['id_row']]) {
            $id = is_numeric($_POST[$this->columns['id_row']]) ?
                $this->clearNum($_POST[$this->columns['id_row']]) :
                $this->clearStr($_POST[$this->columns['id_row']]);
            if($id) {
                $where = [$this->columns['id_row'] => $id];
                $method = 'edit';
            }
        }

        $this->createFile();

        $this->createAlias($id);

        $this->model->$method($this->table, [
            'fields' => $_POST,
            'files' => $this->fileArray,
            'where' => $where,
            'return_id' => true
        ]);

        $this->redirect();
    }

    protected function createAlias($id = false)
    {
        if($this->columns['alias']) {
            if(!$_POST['alias']) {
                if($_POST['name']) {
                    $alias_str = $this->clearStr($_POST['name']);
                }else{
                    foreach ($_POST as $key => $item) {
                        if(strpos($key, 'name') !== false && $item) {
                            $alias_str = $this->clearStr($item);
                            break;
                        }
                    }
                }
            }else{
                $alias_str = $_POST['alias'] = $this->clearStr($_POST['alias']);
            }

            $textModify = new \libraries\TextModify();
            $alias = $textModify->translit($alias_str);

            $where['alias'] = false;
            $operand[] = '=';

            if($id) {
                $where[$this->columns['id_row']] = $id;
                $operand[] = '<>';
            }

            $res_alias = $this->model->get($this->table, [
                'fields' => ['alias'],
                'where' => $where,
                'operand' => $operand,
                'limit' => '1'
            ])[0];

            if(!$res_alias) {
                $_POST['alias'] = $alias;
            }else{
                $this->alias = $alias;
                $_POST['alias'] = '';
            }
        }
    }

    protected function createFile() {
        $fileEdit = new FileEdit();
        $this->fileArray = $fileEdit->addFile();
    }

    protected function checkPost()
    {
        if($this->isPost()) {
            $this->clearPostFields();
            $this->table = $this->clearStr($_POST['table']);
            unset($_POST['table']);

            if($this->table) {
                $this->createTableData();
                $this->editData();
            }
        }
    }
}
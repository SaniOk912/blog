<?php

namespace core\admin\controller;

use core\base\controller\BaseController;
use core\admin\model\Model;
use core\base\settings\Settings;

class BaseAdmin extends BaseController
{
    protected $adminPath;

    protected function inputData() {

        $this->init(true);

        if(!$this->model) $this->model = Model::instance();
        if(!$this->adminPath) $this->adminPath = PATH . Settings::get('routes')['admin']['alias'] . '/';

    }

    protected function outputData() {

        if(!$this->content) {
            $args = func_get_arg(0);
            $vars = $args ? $args : [];

            $this->header = $this->render(ADMIN_TEMPLATE . 'include/header');
            $this->footer = $this->render(ADMIN_TEMPLATE . 'include/footer');

            $this->content = $this->render($this->template, $vars);
        }

        return $this->render(ADMIN_TEMPLATE . 'layout/default');
    }

    protected function execBase() {
        self::inputData();
    }
}
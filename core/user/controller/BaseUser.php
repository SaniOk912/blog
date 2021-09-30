<?php

namespace core\user\controller;

use core\base\controller\BaseController;
use core\base\settings\Settings;
use core\user\model\Model;

class BaseUser extends BaseController
{
    protected function inputData() {

        if(!$this->model) $this->model = Model::instance();
        if(!$this->settings) $this->settings = Settings::instance();

    }

    protected function outputData() {

        if(!$this->content) {
            $args = func_get_arg(0);
            $vars = $args ? $args : [];

            $this->content = $this->render($this->template, $vars);
        }

        $this->header = $this->render(ADMIN_TEMPLATE . 'include/header');
        $this->footer = $this->render(ADMIN_TEMPLATE . 'include/footer');

        return $this->render(ADMIN_TEMPLATE . 'layout/default');
    }

    protected function execBase() {
        self::inputData();
    }
}
<?php

namespace admin\controller;

use base\controller\BaseController;
use base\model\Model;

class BaseAdmin extends BaseController
{
    protected function inputData() {

        if(!$this->model) $this->model = Model::instance();

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
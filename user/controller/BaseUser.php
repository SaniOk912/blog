<?php

namespace user\controller;

use base\controller\BaseController;
use base\model\Model;

class BaseUser extends BaseController
{
    protected function inputData() {

        if(!$this->model) $this->model = Model::instance();

    }

    protected function execBase() {
        self::inputData();
    }
}
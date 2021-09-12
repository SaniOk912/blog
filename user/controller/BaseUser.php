<?php

namespace user\controller;

use base\controller\BaseController;

class BaseUser extends BaseController
{
    protected function inputData() {

        echo 'qwe';

    }

    protected function execBase() {
        self::inputData();
    }
}
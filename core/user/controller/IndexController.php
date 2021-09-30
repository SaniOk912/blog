<?php

namespace core\user\controller;

class IndexController extends BaseUser
{
    protected function inputData()
    {
        $this->execBase();
        header('Location: main');
    }

}
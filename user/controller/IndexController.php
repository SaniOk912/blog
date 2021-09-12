<?php

namespace user\controller;

class IndexController extends BaseUser
{
    protected function inputData()
    {
        $this->execBase();

        return '123';
    }

}
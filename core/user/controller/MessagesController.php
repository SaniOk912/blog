<?php

namespace core\user\controller;

class MessagesController extends BaseUser
{
    protected function inputData()
    {
        $this->execBase();

        $this->createData(['messages']);
    }
}
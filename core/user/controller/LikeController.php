<?php

namespace core\user\controller;

class LikeController extends BaseUser
{
    protected function inputData()
    {
        $this->execBase();

        $this->checkLike();

//        $this->content = json_encode($_POST);
    }

}
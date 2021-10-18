<?php

namespace core\user\controller;

class LikeController extends BaseUser
{
    protected function inputData()
    {
        $this->execBase();
        $action = array_keys($this->parameters)[0];

        if($action === 'like') $this->checkLike();
        else $this->checkComment($action);

//        $this->content = json_encode($_POST);
    }

}
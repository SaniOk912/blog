<?php

namespace core\user\controller;

class LikeController extends BaseUser
{
    protected function inputData()
    {
        if(isset($_SESSION['id'])) {

            $this->execBase();
            $action = array_keys($this->parameters)[0];

            if(isset($_SESSION['id']) && $action === 'like') $this->checkLike();
        }else{
            $this->content = 'error';
        }

    }

}
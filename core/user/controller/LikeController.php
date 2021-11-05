<?php

namespace core\user\controller;

class LikeController extends BaseUser
{
    protected function inputData()
    {
        $this->execBase();
        $action = array_keys($this->parameters)[0];

        if(isset($_SESSION['id'])) {
            if($action === 'like') $this->checkLike();
            elseif ($action === 'comment') $this->checkComment($action);
            elseif ($action === 'read') $this->readMessage();
        }

    }

}
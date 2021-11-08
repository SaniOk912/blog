<?php

namespace core\user\controller;

class LikeController extends BaseUser
{
    protected function inputData()
    {
        if(isset($_SESSION['id'])) {

            $this->execBase();
            $action = array_keys($this->parameters)[0];

            if(isset($_SESSION['id'])) {
                if($action === 'like') $this->checkLike();
                elseif ($action === 'comment') $this->checkComment($action);
                elseif ($action === 'read') $this->readMessage();
            }
//            $this->content = $_POST['date'];
        }else{
            $this->content = 'error';
        }

    }

}
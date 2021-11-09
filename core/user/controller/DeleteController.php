<?php

namespace core\user\controller;

class DeleteController extends BaseUser
{
    protected function inputData()
    {
        $this->execBase();

        $this->createTableData();

        $post_id = $this->parameters[$this->table];

        $author_id = $this->model->get($this->table, [
            'fields' => ['author_id'],
            'where' => ['id' => $post_id]
        ])[0]['author_id'];

        if($author_id == $_SESSION['id']) {
            $this->deleteData();

            $this->redirect('/main/' . $_SESSION['id']);
        }


    }
}
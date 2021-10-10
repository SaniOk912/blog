<?php

namespace core\admin\controller;

class ShowController extends BaseAdmin
{
    protected function inputData()
    {
        $this->execBase();

        $this->createTableData();

        $this->createData();

        if ($_POST['id'] && $_POST['user_id'] ) {

            $stmt = $this->model->get('likes', [
                'where' => ['user_id' => $_POST['user_id'], 'post_id' => $_POST['id']]
            ])[0];

            $likes = $this->model->get('posts', [
                'fields' => ['likes'],
                'where' => ['id' => $_POST['id']]
            ])[0]['likes'];

            if($stmt['id']) {
                $this->model->delete('likes', [
                    'where' => ['id' => $stmt['id']]
                ]);
                $likes--;
            }else{
                $this->model->add('likes', [
                    'fields' => ['user_id' => $_POST['user_id'], 'post_id' => $_POST['id']]
                ]);
                $likes++;
            }
            $this->model->edit('posts', [
                'fields' => ['likes' => $likes],
                'where' => ['id' => $_POST['id']]
            ]);

            $this->content = json_encode($likes);

//            echo json_encode(array('success' => 1));
        }
    }

}
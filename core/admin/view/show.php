<?php
?>

<?php foreach ($this->data as $data):?>
    <div table="table qwerty" class="check">qwerty</div>
    <div table="id"><?=$data['id']?></div>
    <a href="<?=$this->adminPath . 'edit/' . $this->table . '/' . $data['id']?>"><div><?=$data['name']?></div></a>
    <div table="img"><?=$data['img']?></div>
    <div table="separator">====================</div>
<?php endforeach;?>

<!--<div style="width: 100px; height: 100px; background-color: bisque;"></div>-->
<!--<div style="width: 200px; height: 200px; background-color: lightseagreen;"></div>-->

<?php
$user_id = 1;
$id = 1; // ID статьи
?>

<span id="like" user-id="<?=$user_id?>" data-id="<?=$id?>">&#10084;</span>
<span id="likeNum">3</span>
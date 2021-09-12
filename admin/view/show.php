<div style="color: red">content</div>

<?php
//    print_arr($this->data);
//?>

<?php foreach ($this->data as $key => $value):?>
    <div><?=$value['id']?></div>
<!--    <div>--><?//=$value['name']?><!--</div>-->
    <div><?=$value['img']?></div>
<?php endforeach;?>

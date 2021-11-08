<div class="vg-header"><?=$key?></div>
<div>

    <input type="file" name="<?=$key?>">

    <?php if($this->data[$key]):?>
        <img width="640" height="480" src="<?=PATH . UPLOAD_DIR . $this->data[$key]?>">
    <?php endif;?>
</div>
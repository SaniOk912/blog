<div class="vg-header"><?=$key?></div>
<div>
    <?php if($this->data[$key]):?>
        <img src="<?=PATH . UPLOAD_DIR . $this->data[$key]?>">
    <?php endif;?>
    <input type="file" name="<?=$key?>" class="single_img">
</div>
<?php

?>

<div class="add-form-wrapper">
    <div class="search search-user add-form" id="search-aside">
        <form action="/<?=$this->action?>" method="POST" enctype="multipart/form-data">
            <?php if($this->data):?>
                <input type="hidden" name="<?=$this->columns['id_row']?>" value="<?=$this->data[$this->columns['id_row']]?>">
            <?php endif;?>
            <input type="hidden" name="table" value="<?=$this->table?>">

            <?php
            foreach ($this->pattern as $key => $value) {
                include $_SERVER['DOCUMENT_ROOT'] . '/' . $this->formTemplates . '/' . $value . '.php';
            }
            ?>

            <input type="submit" class="add-form-btn" value="Сохранить">
        </form>
    </div>
</div>


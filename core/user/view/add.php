<?php

?>
<form class="vg-wrap vg-element vg-ninteen-of-twenty" method="POST" action="/<?=$this->action?>" enctype="multipart/form-data">
    <?php if($this->data):?>
        <input type="hidden" name="<?=$this->columns['id_row']?>" value="<?=$this->data[$this->columns['id_row']]?>">
    <?php endif;?>
    <input type="hidden" name="table" value="<?=$this->table?>">

    <?php
        foreach ($this->pattern as $key => $value) {
            include $_SERVER['DOCUMENT_ROOT'] . '/' . $this->formTemplates . '/' . $value . '.php';
        }
    ?>

    <input type="submit" class="vg-text vg-firm-color1 vg-firm-background-color4 vg-input vg-button" value="Сохранить">
</form>
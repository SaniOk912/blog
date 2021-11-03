<?php
?>
<?php foreach ($this->data as $key => $value):?>
    <?php foreach ($value as $num => $items):?>
        <div>
            <span><?=$items['message']?></span><br>
            <span class="date"><?=$items['date']?></span>
            <span style="margin-left: 30px; color: blue" class="read">read</span>
            <div>====================</div>
        </div>
    <?php endforeach;?>
<?php endforeach;?>
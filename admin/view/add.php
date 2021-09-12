<form action="/admin/<?=$this->action?>" method="post" enctype="multipart/form-data">
    <input type="hidden" name="table" value="<?=$this->table?>">
    <div>
        <label for="username">Enter your name</label>
        <input name="username" id="say" value="<?php if($this->data) echo $this->data['name']?>">
    </div>
    <div>
        <label for="password">Enter your password</label>
        <input name="password" id="to" value="your password">
    </div>
    <div>
        <input type="submit" value="Отправить">
    </div>
<!--    <div>123</div>-->
<!--    <p><input size="25" name="word">-->
<!--        <input type="hidden" name="name" value="Vasya">-->
<!--        <input type="hidden" name="password" value="pupkin"></p>-->
<!--    <p><input type="submit" value="Отправить"></p>-->
</form>
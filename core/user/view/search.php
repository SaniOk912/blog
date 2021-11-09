<?php
?>

<article class="post hentry user-info">
    <h2 class="post-title entry-title">
        <a href="/main/<?=$this->userInfo['id']?>"><?=$this->userInfo['username']?></a>
    </h2>
    <div class="post-header-line-1"></div>
    <div class="post-body entry-content">
        <div id="summary5932965271549108047">
            <span style="float:left; padding:0px 10px 5px 0px;">
                <img src="/userfiles/<?=$this->userInfo['img']?>" width="200px" height="200px" class="postthumbimg" alt="">
            </span>
            <div class="us-info"><?=$this->userInfo['username']?></div></div>
        <div class="us-info"><?=$this->userInfo['age']?></div></div>
    <div class="us-info"><?=$this->userInfo['status']?></div>
    <?php if($this->userInfo['id'] == $_SESSION['id']):?>
        <div style='float:right;padding-right:10px;margin-top:10px;'>
            <a class='morer' href='/edit/users/<?=$this->userInfo['id']?>'>edit</a>
        </div>
    <?php endif;?>
    <div style="clear: both;"></div>
</article>

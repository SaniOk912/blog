<?php

?>

<?php if($this->posts):?>

<article class="post hentry user-info">
    <h2 class="post-title entry-title">
        <span><?=$this->userInfo['username']?></span>
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

<?php else:?>
    <article class="post hentry user-info">
        <h2 class="post-title entry-title">
            <div>Пожалуйста, введите имя пользователя выше, или авторизируйтесь</div>
        </h2>
        <div class="post-header-line-1"></div>

        <div style="clear: both;"></div>
    </article>
<?php endif;?>

<div id='wrapper'>

    <div class='blogbblock clearfix' id='content' role='main'>
        <div id='mainblogpart'>
            <div class='mainblog section' id='mainblog'><div class='widget Blog' data-version='1' id='Blog1'>
                    <div class='blog-posts hfeed'>

                        <div class="date-outer">

                            <div class="date-posts">

                                <div class='post-outer'>

                                    <?php foreach ($this->posts as $key => $value):?>
                                        <article class='post hentry'>
                                            <div class='postmeta'>
                                                <div class='meta-text'>
                                                    <?=$value['date']?><br/><br/>
                                                    By <?=$this->userInfo['username']?><br/><br/>
                                                    <br/><br/>
                                                    <img src='http://4.bp.blogspot.com/-QjB9nIoDi2w/UkoXa5HiyAI/AAAAAAAABuc/zKPbwqrlFaU/s1600/ico_comments.png'/>
                                                    <a href='/post/<?=$value['id']?>' onclick=''>comments</a>
                                                </div>
                                            </div>
                                            <h2 class='post-title entry-title'>
                                                <a href='/post/<?=$value['id']?>'><?=$value['name']?></a>
                                            </h2>
                                            <div class='post-header-line-1'></div>
                                            <div class='post-body entry-content'>
                                                <div id='<?=$value['id']?>'>
                                                    <div class="separator" style="clear: both; text-align: center;">
                                                        <a href="http://4.bp.blogspot.com/-Z0FD8z84Ohs/UPC6WsxzWVI/AAAAAAAAAdE/_tRVXUN1R4s/s1600/100_3582.JPG" imageanchor="1" style="margin-left: 1em; margin-right: 1em;">
                                                            <img border="0" height="480" src="/userfiles/<?=$value['img']?>" width="640" />
                                                        </a>
                                                    </div>
                                                    <br/><?=$value['content']?><br />
                                                </div>
                                                <script type='text/javascript'>createSummaryAndThumb("<?=$value['id']?>");</script>


                                                <?php if($this->userInfo['id'] == $_SESSION['id']):?>
                                                    <div style='float:right;padding-right:10px;margin-top:10px;'>
                                                        <a class='morer' href='/edit/posts/<?=$value['id']?>'>edit</a>
                                                    </div>
                                                <?php endif;?>

                                                <div style='clear: both;'></div>
                                            </div>
                                        </article>
                                        <div style='clear: both;'></div>
                                    <?php endforeach;?>


                                </div>
                            </div>
                        </div>

                    </div>

<?php
?>

<div id='wrapper'>

    <div class='blogbblock clearfix' id='content' role='main'>
        <div id='mainblogpart'>
            <div class='mainblog section' id='mainblog'><div class='widget Blog' data-version='1' id='Blog1'>
                    <div class='blog-posts hfeed'>

                        <div class="date-outer">

                            <div class="date-posts">

                                <div class='post-outer'>

                                    <?php foreach ($this->data['posts'] as $key => $value):?>
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
<?php

?>
<div class='blogbblock clearfix' id='content' role='main'>
    <div id='mainblogpart'>
        <div class='mainblog section' id='mainblog'><div class='widget Blog' data-version='1' id='Blog1'>
                <div class='blog-posts hfeed'>
                    <div class="date-outer">
                        <h2 class='date-header'><span>Friday, January 11, 2013</span></h2>
                        <div class="date-posts">

                            <?php foreach ($this->posts as $key => $value):?>
                                <article class='post hentry'>
                                    <div class='postmeta'>
                                        <div class='meta-text'>
                                            <?=$value['date']?><br/><br/>
                                        </div>
                                    </div>
                                    <h2 class='post-title entry-title'>
                                        <a href='/post/<?=$value['id']?>'><?=$value['name']?></a>
                                    </h2>
                                    <div class='post-header-line-1'></div>
                                    <div class='post-body entry-content'>
                                        <div id='<?=$value['id']?>'><div class="separator" style="clear: both; text-align: center;">
                                                <img border="0" height="480" src="/userfiles/<?=$value['img']?>" width="640" />
                                            </div>
                                            <br /><?=$value['content']?><br />
                                        </div>
                                        <?php if($value['author_id'] == $_SESSION['id']):?>
                                            <a href="/delete/posts/<?=$value['id']?>" style="float: right; margin-left: 10px;">delete</a>
                                            <a href="/edit/posts/<?=$value['id']?>" style="float: right; margin-left: 10px;">edit</a>
                                        <?php elseif ($_SESSION['admin']):?>
                                            <a href="/admin/delete/posts/<?=$value['id']?>" style="float: right; margin-left: 10px;">delete</a>
                                        <?php endif;?>
                                        <div style="float:right;">
                                            <span date="<?=$value['date']?>" author_id="<?=$value['author_id']?>" table="posts" class="like">Like</span>
                                            <span class="like-num"><?=$value['likes']?></span> ||
                                        </div>
                                        <div style='clear: both;'></div>
                                    </div>
                                </article>
                                <div style='clear: both;'></div>
                            <?php endforeach;?>



                            <div class='comments' id='comments'>
                                <h4>comments:</h4>
                                <form action="/post" method="POST">
                                    <textarea class="textarea" name="content"></textarea>
                                    <input type="submit" class="add-form-btn" value="Add Comment">
                                    <input type="hidden" name="post_id" value="<?=$this->posts[0]['id']?>">
                                    <input type="hidden" name="table" value="comments">
                                </form>
                                <br><br>
                                <hr>
                                <div class='comments-content'>
                                    <div id='comment-holder'>
                                        <div class="comment-thread toplevel-thread">
                                            <ol id="top-ra">

                                                <?php for ($i = 0; $i < count($this->comments); $i++):?>
                                                    <li class="comment">
                                                        <div class="avatar-image-container">
                                                            <img src="/userfiles/<?=$this->userInfo[$i]['img']?>" alt=""/>
                                                        </div>
                                                        <div class="comment-block">
                                                            <div class="comment-header">
                                                                <cite class="user">
                                                                    <a href="/main/<?=$this->userInfo[$i]['id']?>" rel="nofollow"><?=$this->userInfo[$i]['username']?></a>
                                                                </cite>
                                                                <span class="datetime secondary-text"> -
                                                                    <?=$this->comments[$i]['date']?>
                                                                </span>
                                                            </div>
                                                            <p class="comment-content"><?=$this->comments[$i]['content']?></p>
                                                            <span class="comment-actions secondary-text">
                                                                <div>
                                                                    <span date="<?=$this->comments[$i]['date']?>" author_id="<?=$this->userInfo[$i]['id']?>" table="comments" class="like">Like</span>
                                                                    <span class="like-num"><?php if($this->comments[$i]['likes']) echo $this->comments[$i]['likes']; else echo '0'?></span> ||

                                                                    <?php if($this->userInfo[$i]['id'] == $_SESSION['id']):?>
                                                                        <a href="/delete/comments/<?=$this->comments[$i]['id']?>">Delete</a> ||
                                                                    <?php elseif ($_SESSION['admin']):?>
                                                                        <a href="/admin/delete/comments/<?=$this->comments[$i]['id']?>">Delete</a> ||
                                                                    <?php endif;?>

                                                                </div>
                                                            </span>
                                                        </div>
                                                    </li>
                                                    <br><hr>
                                                <?php endfor;?>

                                            </ol>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div style='clear: both;'></div>
        </div>
    </div>
</div>

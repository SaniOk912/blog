<?php
//print_arr($this->data);
$user_id = 1;
$id = 1; // ID статьи
?>

<div>ADMIN</div>

<?php foreach ($this->posts as $post):?>
    <div><?=$post['name']?></div>
    <div><?=$post['content']?></div>
    <div><?=$post['img']?></div>
    <div>written by <?=$post['author_id']?></div>
    <div><?=$post['date']?></div><br>
    <span id="like" table="posts" user-id="<?=$user_id?>" data-id="<?=$id?>">&#10084;</span>
    <span id="likeNum">3</span>
    <div>====================</div>
<?php endforeach;?>

<div class="posts">
    <ul table="posts">
        <li>POST 1
            <div class="author" id="1">STEPAN</div>
            <div class="date">2021-10-10</div>
            <span class="like">like</span>
            <span class="likeNum">0</span>
            <div class="comment">comment</div>
            <ul table="comments">
                <li>
                    COMMENT 1
                    <div class="author" id="1">STEPAN1</div>
                    <div class="date">2021-10-10</div>
                    <span class="like">like</span>
                    <span class="likeNum">0</span>
                    <div class="comment">comment</div>
                    <div class="edit">edit</div>
                </li>
                <li>
                    COMMENT 2
                    <div class="author" id="2">STEPAN2</div>
                    <div class="date">2021-10-10</div>
                    <span class="like">like</span>
                    <span class="likeNum">0</span>
                    <div class="comment">comment</div>
                    <div class="edit">edit</div>
                </li>
                <li>
                    COMMENT 3
                    <div class="author" id="3">STEPAN3</div>
                    <div class="date">2021-10-10</div>
                    <span class="like">like</span>
                    <span class="likeNum">0</span>
                    <div class="comment">comment</div>
                </li>
            </ul>
        </li>
        <li>POST 2
            <div class="author" id="1">STEPAN</div>
            <div class="date">2021-10-10</div>
            <span class="like">like</span>
            <span class="likeNum">0</span>
            <div>comment</div>
            <ul table="posts">
                <li>
                    COMMENT 1
                    <div class="author" id="1">STEPAN1</div>
                    <div class="date">2021-10-10</div>
                    <span class="like">like</span>
                    <span class="likeNum">0</span>
                    <div>comment</div>
                </li>
                <li>
                    COMMENT 2
                    <div class="author" id="2">STEPAN2</div>
                    <div class="date">2021-10-10</div>
                    <span class="like">like</span>
                    <span class="likeNum">0</span>
                    <div>comment</div>
                </li>
                <li>
                    COMMENT 3
                    <div class="author" id="3">STEPAN3</div>
                    <div class="date">2021-10-10</div>
                    <span class="like">like</span>
                    <span class="likeNum">0</span>
                    <div>comment</div>
                </li>
            </ul>
        </li>
        <li>POST 3
            <div class="author" id="1">STEPAN</div>
            <div class="date">2021-10-10</div>
            <span class="like">like</span>
            <span class="likeNum">0</span>
            <div>comment</div>
            <ul table="posts">
                <li>
                    COMMENT 1
                    <div class="author" id="1">STEPAN1</div>
                    <div class="date">2021-10-10</div>
                    <span class="like">like</span>
                    <span class="likeNum">0</span>
                    <div>comment</div>
                </li>
                <li>
                    COMMENT 2
                    <div class="author" id="2">STEPAN2</div>
                    <div class="date">2021-10-10</div>
                    <span class="like">like</span>
                    <span class="likeNum">0</span>
                    <div>comment</div>
                </li>
                <li>
                    COMMENT 3
                    <div class="author" id="3">STEPAN3</div>
                    <div class="date">2021-10-10</div>
                    <span class="like">like</span>
                    <span class="likeNum">0</span>
                    <div>comment</div>
                </li>
            </ul>
        </li>
    </ul>
</div>
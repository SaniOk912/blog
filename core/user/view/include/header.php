<!DOCTYPE html>
<head>
    <title>Shortnotes</title>
    <meta content='text/html; charset=UTF-8' http-equiv='Content-Type'/>
    <meta content='blogger' name='generator'/><meta content='http://shortnotes-lovely.blogspot.com/' property='og:url'/>
    <meta content='Shortnotes' property='og:title'/>
    <meta content='' property='og:description'/>
    <script src='https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js' type='text/javascript'></script>
    <script src="/core/user/view/js/index.js"></script>

    <?php foreach ($this->styles as $style):?>
        <link rel="stylesheet" href="<?=$style?>">
    <?php endforeach;?>
    <?php foreach ($this->scripts as $script):?>
        <script type="text/javascript" src="<?=$script?>"></script>
    <?php endforeach;?>
</head>
<body>

<header role='banner'>
    <div class='blogbblock clearfix'>
        <div id='logo'>
            <div class='header section' id='header'>
                <div class='widget Header' data-version='1' id='Header1'>
                    <div id='header-inner'>
                        <a href='<?php if(isset($_SESSION['id'])) echo '/main/' . $_SESSION['id'];
                                       else echo '/login'?>' style='display: block'>
                            <img alt='Shortnotes' class='headerlogoimg' height='62px; ' id='Header1_headerimg' src='http://2.bp.blogspot.com/-HY4r_JO4nLk/UkocyqErkXI/AAAAAAAABvI/oGA5O9DfmCU/s1600/logo.png' style='display: block;padding-left:0px;padding-top:20px;' width='264px; '/>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="search search-user" id="search-aside" style="width: 200px">
            <form action="/search"  method="get">
                <input name="q" type="text" placeholder="enter user name">
            </form>
        </div>
        <div style="float:right;">

            <?php if(isset($_SESSION['id'])):?>
                <a href="/logout">Logout</a>
            <?php else:?>
                <a href="/login">Login</a>
            <?php endif;?>


        </div>
    </div>
</header>
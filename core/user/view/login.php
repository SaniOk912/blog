<?php
echo'123';
?>
<html>
<head>
</head>
<body>
<form action="login" method="post">
    <h2>LOGIN</h2>

    <?php if (isset($_GET['error'])) { ?>
        <p class="error"><?php echo $_GET['error'];?></p>
    <?php } ?>

    <label>Email</label>
    <input type="text" name="email" placeholder="Email"><br>

    <label>Password</label>
    <input type="password" name="password" placeholder="User password"><br>

    <button type="submit">Login</button>
    <a href="signup">Create an account</a><br>

    <!--    --><?php
    //    if (isset($_SESSION['id']) && isset($_SESSION['user_name']) && $_SESSION['admin']) {
    //        ?>
    <!--        <a href="admin.php">Admin Panel</a>-->
    <!--        --><?php
    //    }elseif (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {
    //        ?>
    <!--        <a href="home.php">Home Page</a>-->
    <!--    --><?php //}?>
</form>
</body>
</html>

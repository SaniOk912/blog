<?php
?>

<html>
<head>
</head>
<body>
<div class="add-form-wrapper">
    <div class="search search-user add-form" id="search-aside">
        <form action="signup" method="post">
            <h2>SIGN UP</h2>

            <label>Name</label>
                <input type="text" name="username" placeholder="Name"><br>

            <label>Email</label>
                <input type="text" name="email" placeholder="Email"><br>

            <label>Password</label>
            <input type="password" name="password" placeholder="Password"><br>

            <label>Repeat Password</label>
            <input type="password" name="re_password" placeholder="Re_Password"><br>

<!--            <button type="submit">sign up</button>-->
            <button class="add-form-btn" type="submit">Sign Up</button>
            <a href="login">Already have an account ?</a>
        </form>
    </div>
</div>
</body>
</html>

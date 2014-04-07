<?php
    if (isset($loginMsg))
    {
        echo("<div class=\"alert alert-danger\">$loginMsg</div>");
    }
?>

<form role="form" method="post" action="index.php?page=<?php
    if (isset($_GET['page']) && $_GET['page'] != "login")
    {
        echo($_GET['page']);
    }
    else
    {
        echo(isset($_GET['returnTo']) ? $_GET['returnTo'] : 'home'); 
    }
    foreach ($_GET as $key => $value)
    {
        if ($key != "page" && $key != "returnTo" && $key != "logout")
        {
            echo('&amp;'.$key.'='.$value);
        }
    }
?>" name="loginform">
    <div class="form-group">
        <label for="login_input_username">Username</label>
        <input id="login_input_username" placeholder="Enter your username here" class="form-control" type="text" name="user_name" required />
    </div>
    <div class="form-group">
        <label for="login_input_password">Password</label>
        <input id="login_input_password" placeholder="Enter your password here" class="form-control" type="password" name="user_password" autocomplete="off" required />
    </div>
    <button type="submit" class="btn btn-lg btn-default" name="login" value="Log in">Log in</button>
    <button type="button" class="btn btn-lg btn-default" onclick="window.location.href='index.php?page=register'">Register</button>
</form>
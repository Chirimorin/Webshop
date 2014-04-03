<?php
require_once("database/dbconfig.php");
require_once("classes/login.class.php");
    


    $login = new Login();
?>
<div class="panel panel-primary">
<!-- login form box -->
<div class="panel panel-heading">
Inloggen&nbsp;
<?php
// show potential errors / feedback (from login object)
if (isset($login)) {
    if ($login->errors) {
        foreach ($login->errors as $error) {
            echo $error;
        }
    }
    if ($login->messages) {
        foreach ($login->messages as $message) {
            echo $message;
        }
    }
}
?>

</div>
<div class="panel panel-body">
<form method="post" action="index.php?page=login" name="loginform">

    <label for="login_input_username">Username</label>
    <input id="login_input_username" class="login_input" type="text" name="user_name" required />
    <br/>
    <label for="login_input_password">Password</label>
    <input id="login_input_password" class="login_input" type="password" name="user_password" autocomplete="off" required />
    <br/>
    <button type="submit" class="btn btn-lg btn-default" name="login" value="Log in">Log in</button>
    <button type="button" class="btn btn-lg btn-default" onclick="window.location.href='index.php?page=register'">Register</button>
    
    
</div>

</form>


</div>
</div>


<?php
require_once("database/dbconfig.php");
require_once("classes/login.class.php");
    


    $login = new Login();
?>
<div class="panel panel-primary">
<!-- login form box -->
<div class="panel panel-heading">
Log in&nbsp;

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
<form role="form" method="post" action="index.php?page=login" name="loginform">
    
    <div class="form-group">
    <label for="login_input_username">Username</label>
    <input id="login_input_username" placeholder="Enter your username here"class="form-control" type="text" name="user_name" required />
    </div>
    <div class="form-group">
    <label for="login_input_password">Password</label>
    <input id="login_input_password" placeholder="Enter your password here"class="form-control" type="password" name="user_password" autocomplete="off" required />
    </div>
    
    <button type="submit" class="btn btn-lg btn-default" name="login" value="Log in">Log in</button>
    <button type="button" class="btn btn-lg btn-default" onclick="window.location.href='index.php?page=register'">Register</button>
    
    
</div>

</form>


</div>
</div>
<?php
/*}
else{
    ?>
    <!--<div class="panel panel-body">
        <button type="button" class="btn btn-lg btn-default" onclick="<?php Login::doLogout() ?>;window.location.href='index.php?page=login';">Log out</button>
    </div>-->
    <?php
}*/
?>

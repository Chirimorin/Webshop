<?php
require_once("database/dbconfig.php");
require_once("classes/registration.class.php");

$registration = new Registration();
?>
<div class="panel panel-primary">

<div class="panel panel-heading">
    Registreren&nbsp;
    <?php
// show potential errors / feedback (from registration object)
if (isset($registration)) {
    if ($registration->errors) {
        foreach ($registration->errors as $error) {
            echo $error;
        }
    }
    if ($registration->messages) {
        foreach ($registration->messages as $message) {
            echo $message;
        }
    }
}
?>

</div>
<div class="panel panel-body">
<!-- register form -->
<form method="post" action="index.php?page=register" name="registerform">

    <!-- the user name input field uses a HTML5 pattern check -->
    <label for="login_input_username">Username (only letters and numbers, 2 to 64 characters)</label>
    <input id="login_input_username" class="login_input" type="text" pattern="[a-zA-Z0-9]{2,64}" name="user_name" required />
    <br/>
    <label for="login_input_password_new">Password (min. 6 characters)</label>
    <input id="login_input_password_new" class="login_input" type="password" name="user_password_new" pattern=".{6,}" required autocomplete="off" />
    <br/>
    <label for="login_input_password_repeat">Repeat password</label>
    <input id="login_input_password_repeat" class="login_input" type="password" name="user_password_repeat" pattern=".{6,}" required autocomplete="off" />
    <br/>
    <button type="submit" class="btn btn-lg btn-default" name="register" value="Register">Register</button>
    <button type="button" class="btn btn-lg btn-default" onclick="window.location.href='index.php?page=login'">Log in</button>

</form>


</div>
</div>

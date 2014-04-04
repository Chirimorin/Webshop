<a href="index.php">Home</a> > Register

<div class="page-header">
    <h1>Register</h1>
</div>

<?php
    require_once("database/dbconfig.php");
    require_once("classes/registration.class.php");

    $registration = new Registration();

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


<form role="form" method="post" action="index.php?page=register" name="registerform">

    <!-- the user name input field uses a HTML5 pattern check -->
    <div class="form-group">
        <label for="login_input_username">Username (only letters and numbers, 2 to 64 characters)</label>
        <input id="login_input_username" placeholder="Enter your username here" class="form-control" type="text" pattern="[a-zA-Z0-9]{2,64}" name="user_name" required />
    </div>
    <div class="form-group">
        <label for="login_input_password_new">Password (min. 6 characters)</label>
        <input id="login_input_password_new" placeholder="Enter your password here"class="form-control" type="password" name="user_password_new" pattern=".{6,}" required autocomplete="off" />
    </div>
    <div class="form-group">
        <label for="login_input_password_repeat">Repeat password</label>
        <input id="login_input_password_repeat" placeholder="Enter your password here again"class="form-control" type="password" name="user_password_repeat" pattern=".{6,}" required autocomplete="off" />
    </div>
    <button type="submit" class="btn btn-lg btn-default" name="register" value="Register">Register</button>
    <button type="button" class="btn btn-lg btn-default" onclick="window.location.href='index.php?page=login'">Log in</button>
</form>

<?php
	session_start();
    
    require_once("database/dbconfig.php");
    require_once("classes/login.class.php");
    $login = new Login();

    if (isset($login)) {
        if ($login->errors)
        {
            if (isset($_GET['page']))
            {
                $_GET['returnTo'] = $_GET['page'];
            }
            $_GET['page'] = "login";
        }
    }
    
	include("layout/header.php");
	include("layout/menu.php");
	
    // show potential errors / feedback (from login object)
    if (isset($login)) {
        if ($login->errors) {
            foreach ($login->errors as $error) {
                echo "<div class=\"alert alert-danger alert-dismissable\">$error<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button></div>";
            }
        }
        if ($login->messages) {
            foreach ($login->messages as $message) {
                echo "<div class=\"alert alert-success alert-dismissable\">$message<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button></div>";
            }
        }
    }

	
	
	if (isset($_GET['page']))
	{
		if (file_exists("controllers/".$_GET['page'].".php"))
		{
			include("controllers/".$_GET['page'].".php");
		}
		else
		{
			include("controllers/404.php");
		}
	}
	else
	{
		include("controllers/home.php");
	}
	include("layout/footer.php");
?>
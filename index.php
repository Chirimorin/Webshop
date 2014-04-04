<?php
	session_start();
    
    require_once("database/dbconfig.php");
    require_once("classes/login.class.php");
    $login = new Login();

	include("layout/header.php");
	include("layout/menu.php");
	
    // show potential errors / feedback (from login object)
    if (isset($login)) {
        if ($login->errors) {
            foreach ($login->errors as $error) {
                echo "<div class=\"alert alert-danger\">$error</div>";
            }
        }
        if ($login->messages) {
            foreach ($login->messages as $message) {
                echo "<div class=\"alert alert-success\">$message</div>";
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
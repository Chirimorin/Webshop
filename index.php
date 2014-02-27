<?php
	session_start();
	include("layout/header.php");
	include("layout/menu.php");
	
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
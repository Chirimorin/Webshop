<?php
	if(Login::isUserLoggedIn() && $_SESSION['accesslevel'] !== null && $_SESSION['accesslevel']>1)
	{
		include_once("database/dbfunctions.inc.php");
        if (isset($_GET['cmsid']))
        {
            if (file_exists("views/CMS/CMS-".$_GET['cmsid'].".php"))
            {
                include("views/CMS/CMS-".$_GET['cmsid'].".php");
            }
            else
            {
                include("views/CMS/home.php");
            }
        }
        else
        {
            include("views/CMS/home.php");
        }
    }
    else{
    	if(!Login::isUserLoggedIn()){
    		$loginMsg = "You must be logged in to view this page.";
            include("views/login.php");
    	}
    	else{
    		echo "<div class=\"alert alert-danger\">You dont have access to this page</div>";
    	}
    }
?>

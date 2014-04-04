<?php
	if(Login::isUserLoggedIn() && $_SESSION['accesslevel'] !== null && $_SESSION['accesslevel']>1)
	{
		include_once("database/dbfunctions.inc.php");
        
        if (file_exists("views/CMS/CMS-".$_GET['cmsid'].".php"))
		{
			include("views/CMS/CMS-".$_GET['cmsid'].".php");
		}
    }
    else{
    	if(!Login::isUserLoggedIn()){
    		echo "You need to log in to show this page";
    	}
    	else{
    		echo "You dont have access to this page";
    	}
    }
?>



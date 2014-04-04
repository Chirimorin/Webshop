<?php
	include_once("classes/login.class.php");


	if(Login::isUserLoggedIn() && $_SESSION['accesslevel'] !== null && $_SESSION['accesslevel']>1)
	{
		include_once("database/dbfunctions.inc.php");
    	switch($_GET['cmsid']){
    		case 1:
    			include_once("includes/userFunctions.inc.php");
    			include_once("classes/user.class.php");
    			if (isset($_GET['username'])){
    				$username = $_GET['username'];
    				$user = new User($username);
    				editUser($user);
    			}
    			else{
	    			echo "Users</br>";
	    			$users = get_all_users();
	    			foreach ($users as $user) {
	    				showUser($user);
	    			}
	    		}
    			break;
    		case 2:
    			echo "Categories";
    			break;
    		case 3:
    			echo "Products";
    			break;
    		case 4:
    			echo "Orders";
    			break;
    		default:
    			echo "id# " . $_GET['cmsid'] . " doesnt exist";
    			break;
    		
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



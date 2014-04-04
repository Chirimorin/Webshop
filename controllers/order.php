<?php 
    include_once("classes/product.class.php");
    
    if (isset($_GET['step']))
    {
        if (file_exists("views/order/".$_GET['step'].".php"))
		{
            if (login::isUserLoggedIn())
            {
                include("views/order/".$_GET['step'].".php");
            }
            else
            {
                $loginMsg = "You must be logged in to view this page.";
                include("views/login.php");
            }
		}
        else
        {
            include("views/order/cart.php");
        }
    }
    else
    {
        include("views/order/cart.php");
    }
?>
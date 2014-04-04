<?php 
    include_once("classes/product.class.php");
    
    $items = array();
    
    //Load current shopping cart if available
    if (isset($_SESSION["items"]))
    {
        $items = $_SESSION["items"];
    }
    
    //Modify the cart as needed
    if (isset($_POST["amounts"]))
    {
        $amounts = $_POST["amounts"];
        
        foreach ($amounts as $ID => $amount)
        {
            if ($amount > 0)
            {
                $items[$ID] = $amount;
            }
            else
            {
                unset($items[$ID]);
            }
        }
        
        echo("<div class=\"alert alert-info alert-dismissable\">Your order has been updated.<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button></div>");
    }
    
    ksort($items);
    
    //Generate view.
    if (count($items) == 0)
    {
        echo("<div class=\"alert alert-warning\">You currently have no items in your shopping cart.</div>");
    }
    else
    {
        //Make the form and a list
        echo ("<form action=\"index.php?page=order\" method=\"post\" id=\"order-form\"><div class=\"list-group\">");
        
        $totalPrice = 0;
        
        //Add each item
        foreach ($items as $ID => $amount)
        {
            $product = new Product($ID);
            
            if ($product->get('id') == $ID)
            {
                $productTotal = $product->get('price') * $amount;
                
                $totalPrice += $productTotal;
                
                echo("
                    <a href=\"#\" class=\"list-group-item\">
                        <div class=\"cartItemTitle\">".$product->get('name')."</div>
                        <div class=\"cartAmount\"><input class=\"amount\" name=\"amounts[".$product->get('id')."]\" type=\"number\" value=\"".$amount."\"></div>
                        <div class=\"cartPrice\">&euro;".number_format($productTotal,2)."</div>
                        &nbsp;
                    </a>
                    ");
            }
            
            else //Nonexisting product found in the cart, remove it. 
            {
                unset($items[$ID]);
            }
        }
        
        //Add total and buttons
        echo("
            <a href=\"#\" class=\"list-group-item active\">
                <div class=\"cartItemTitle\">Total</div>
                <div class=\"cartPrice\">&euro;".number_format($totalPrice, 2)."</div>
                &nbsp;
            </a></div>
            <input type=\"submit\" class=\"btn btn-s btn-default order-form\" value=\"Update amounts\" />
            </form>
            ");
        //$login = new Login();
        
        if (login::isUserLoggedIn())
        {
            echo("<a class=\"btn btn-s btn-success cart-order\" href=\"index.php?page=order&amp;step=adress\">Adress info</a>");
        }
        else
        {
            echo("<a class=\"btn btn-s btn-success cart-order\" href=\"index.php?page=login&amp;returnTo=order\">Login</a>");
        }
    }
    
    $_SESSION["items"] = $items;
?>
<?php 
    session_start();
    
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
        
        echo("<div class=\"alert alert-info alert-dismissable\">Your cart has been updated.<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button></div>");
    }
    
    if (isset($_GET["method"]))
    {
        $method = $_GET["method"];
        
        switch ($method)
        {
            case "add": //An item gets added
                if (isset($_GET["itemID"]) && isset($_GET["amount"]))
                {
                    $itemID = $_GET["itemID"];
                    $amount = $_GET["amount"];
                    
                    if ($amount < 0)
                    {
                        $amount = 0;
                    }
                    
                    if (isset($items[$itemID]))
                    {
                        $items[$itemID] += $amount;
                    }
                    else
                    {
                        $items[$itemID] = $amount;
                    }
                    
                    if ($items[$itemID] <= 0)
                    {
                        unset($items[$itemID]);
                    }
                    else
                    {
                        echo("<div class=\"alert alert-success alert-dismissable\">The item has been added to your cart.<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button></div>");
                    }
                }
                break;
            case "empty": //The cart is emptied
                $items = array();
                break;
        }
    }
    
    ksort($items);
    
    //Generate view for the shopping cart.
    if (count($items) == 0)
    {
        echo("<div class=\"alert alert-danger\">Your shopping cart is empty.</div>");
    }
    else
    {
        //Make the form and a list
        echo ("<form id=\"cart-form\">
                <div class=\"list-group\">");
        
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
            </form>
            <button type=\"button\" class=\"btn btn-s btn-default empty-cart\">Empty cart</button>
            <button type=\"button\" class=\"btn btn-s btn-default update-cart\">Update cart</button>
            <a class=\"btn btn-s btn-success cart-order\" href=\"index.php?page=order\">Place order</a>
            ");
    }
    
    $_SESSION["items"] = $items;
?>

<script type="text/javascript">registerCartButtons()</script>
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
                }
                break;
            case "empty": //The cart is emptied
                $items = array();
                break;
        }
        
        $_SESSION["items"] = $items;
    }
    
    //Generate view for the shopping cart.
    if (count($items) == 0)
    {
        echo("Your shopping cart is empty.");
    }
    else
    {
        echo ("<div class=\"list-group\">");
        
        $totalPrice = 0;
        
        foreach ($items as $ID => $amount)
        {
            $product = new Product($ID);
            
            if ($product->get('id') == $ID)
            {
                $productTotal = number_format($product->get('price') * $amount, 2);
                
                $totalPrice += $productTotal;
                
                echo("
                    <a href=\"index.php?page=product&productid=".$product->get('id')."\" class=\"list-group-item\">
                        <div class=\"cartItemTitle\">".$product->get('name')."</div>
                        <div class=\"cartAmount\"><input class=\"amount\" name=\"amount\" type=\"number\" value=\"".$amount."\"></div>
                        <div class=\"cartPrice\">&euro;".$productTotal."</div>
                        &nbsp;
                    </a>
                    ");
            }
        }
        
        echo("
            <a href=\"#\" class=\"list-group-item active\">
                <div class=\"cartItemTitle\">Total</div>
                <div class=\"cartPrice\">&euro;".number_format($totalPrice, 2)."</div>
                &nbsp;
            </a></div>
            
            <button type=\"button\" class=\"btn btn-s btn-default empty-cart\">Empty cart</button>
            ");
    }
?>

<script type="text/javascript">registerCartButtons()</script>
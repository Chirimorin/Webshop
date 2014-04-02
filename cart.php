<?php 
    session_start();
    
    include_once("classes/product.class.php");
    
    $items = array();
    
    if (isset($_SESSION["items"]))
    {
        $items = $_SESSION["items"];
    }
    
    if (isset($_GET["method"]))
    {
        $method = $_GET["method"];
        
        switch ($method)
        {
            case "add":
                if (isset($_GET["itemID"]) && isset($_GET["amount"]))
                {
                    $itemID = $_GET["itemID"];
                    $amount = $_GET["amount"];
                    
                    if ($amount < 0)
                    {
                        //$amount = 0; 
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
                
        }
        
        $_SESSION["items"] = $items;
    }
    
    if (count($items) == 0)
    {
        echo("Your shopping cart is empty.");
    }
    else
    {
        $totalPrice = 0;
        
        foreach ($items as $ID => $amount)
        {
            $product = new Product($ID);
            
            if ($product->get('id') == $ID)
            {
                $productPrice = number_format($product->get('price') * $amount, 2);
                
                $totalPrice += $productPrice;
                
                echo("
                    <a href=\"index.php?page=product&productid=".$product->get('id')."\" class=\"list-group-item\">
                        <div class=\"cartItemTitle\">".$product->get('name')."</div>
                        <div class=\"cartAmount\"><input class=\"amount\" name=\"amount\" type=\"number\" value=\"".$amount."\"></div>
                        <div class=\"cartPrice\">&euro;".$productPrice."</div>
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
            </a>
            ");
    }
?>

<a href="index.php">Home</a> > <a href="index.php?page=order">Order</a> > <a href="index.php?page=order&amp;step=address">Address info</a> > Review

<div class="page-header">
    <h1>Review your order</h1>
</div>

<?php
    if ($_POST['name'] != "" &&
        $_POST['street'] != "" &&
        $_POST['no'] != "" &&
        $_POST['zipcode'] != "" &&
        $_POST['country'] != "") //Failsafe: did someone edit the DOM? 
    {
        $address=array();
        $address['name']        = $_POST['name'];
        $address['street']      = $_POST['street'];
        $address['no']          = $_POST['no'];
        $address['zipcode']     = $_POST['zipcode'];
        $address['country']     = $_POST['country'];
        $address['addition']    = $_POST['addition'];
        
        
        $_SESSION['address'] = $address;
        
        echo("<h1><small>Products</small></h1>");
        
        $items = array();
        
        //Load current shopping cart if available
        if (isset($_SESSION["items"]))
        {
            $items = $_SESSION["items"];
        }
        
        ksort($items);
        
        //Generate view.
        if (count($items) == 0)
        {
            echo("<div class=\"alert alert-warning\">You currently have no items in your shopping cart.</div>");
        }
        else
        {
            //Make a list of items
            echo ("<div class=\"list-group\">");
            
            $totalPrice = 0;
            
            //Add each item
            foreach ($items as $ID => $amount)
            {
                $product = new Product($ID);
                
                if ($product->get('id') == $ID) //make sure the product exists. 
                {
                    $productTotal = $product->get('price') * $amount;
                    
                    $totalPrice += $productTotal;
                    
                    echo("
                        <a class=\"list-group-item\">
                            <div class=\"cartItemTitle\">".$product->get('name')."</div>
                            <div class=\"cartAmount\">".$amount."</div>
                            <div class=\"cartPrice\">&euro;".number_format($productTotal,2)."</div>
                            &nbsp;
                        </a>
                        ");
                }
            }
            
            //Add total
            echo("
                <a class=\"list-group-item active\">
                    <div class=\"cartItemTitle\">Total</div>
                    <div class=\"cartPrice\">&euro;".number_format($totalPrice, 2)."</div>
                    &nbsp;
                </a></div>
                ");
            
            
            //Add adress info
            echo("<h1><small>Shipping address</small></h1>");
            
            echo($address['name']."<br />");
            echo($address['street']." ".$address['no'].$address['addition']."<br />");
            echo($address['zipcode']."<br />");
            echo($address['country']."<br />");
            
            
            echo("<a class=\"btn btn-s btn-success cart-order\" href=\"index.php?page=order&amp;step=payment\">Payment info</a>");
            
            //Save total order amount and current items, so that the info on this page is correct for the payment and order pages. 
            $_SESSION['paidItems'] = $items;
            $_SESSION['orderAmount'] = $totalPrice;
        }
    }
    else //if required fields
    {
        echo("<div class=\"alert alert-warning\">You have not filled in all required fields.</div>");
    }
?>

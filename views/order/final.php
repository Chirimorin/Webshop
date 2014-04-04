<a href="index.php">Home</a> >  Order complete

<div class="page-header">
    <h1>Order complete</h1>
</div>

<?php
    
    $error = false;
    
    $items = array();
        
    //Load current shopping cart if available
    if (isset($_SESSION["paidItems"]))
    {
        $items = $_SESSION["paidItems"];
    }
    
    if (isset($_SESSION['paymentDone']) && count($items) > 0)
    {
        if ($_SESSION['paymentDone'] == true)
        {
            unset($_SESSION['paymentDone']);
            
            $address = $_SESSION['address'];
            
            include_once("database/db.class.php");
            $db = new DBClass();
            
            $stmt = $db->mysqli->prepare("INSERT INTO address (name, street, number, addition, zipcode, country, username) VALUES (?,?,?,?,?,?,?)");
            $stmt->bind_param('ssissss', $address['name'], $address['street'], $address['no'], $address['addition'], $address['zipcode'], $address['country'], $_SESSION['name']);
            if ($stmt->execute() == false)
            {
                $error = true;
            }
            $stmt->close();
            
            $addressID = $db->lastInsertID();
            
            $stmt = $db->mysqli->prepare("INSERT INTO `order` (user, addressid) VALUES (?,?)");
            $stmt->bind_param('si', $_SESSION['name'], $addressID);
            if ($stmt->execute() == false)
            {
                $error = true;
            }
            $stmt->close();
            
            $orderID = $db->lastInsertID();
            
            foreach ($items as $ID => $amount)
            {
                $stmt = $db->mysqli->prepare("INSERT INTO productorder (orderid, productid, amount) VALUES (?,?,?)");
                $stmt->bind_param('iii', $orderID, $ID, $amount);
                if ($stmt->execute() == false)
                {
                    $error = true;
                }
                $stmt->close();
            }
            
            unset($db);
        }
        else
        {
            $error = true;
        }
    }
    else
    {
        $error = true;
    }
    
    
    if ($error)
    {
        ?>
        <div class="alert alert-danger">
            <strong>There was an error processing your order. Please try again.</strong>
        </div>
        <?php
    }
    else
    {
        ?>
        <script type="text/javascript">$(document).ready(function(){ $("#shoppingList").load("cart.php?method=empty"); });</script>

        <div class="alert alert-success">
            <strong>Your order has been completed successfully!</strong><br />
            Below you can find a summary of your final order.
        </div>
        <?php
        
            echo("<h1><small>Products</small></h1>");
            
            ksort($items);
            
            //Make a list of items
            echo ("<div class=\"list-group\">");
            
            //Add each item
            foreach ($items as $ID => $amount)
            {
                $product = new Product($ID);
                
                if ($product->get('id') == $ID) //make sure the product exists. 
                {
                    $productTotal = $product->get('price') * $amount;
                    
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
                    <div class=\"cartPrice\">&euro;".number_format($_SESSION['orderAmount'], 2)."</div>
                    &nbsp;
                </a></div>
                ");
            
            
            //address info
            echo("<h1><small>Shipping address</small></h1>");
            
            echo($address['name']."<br />");
            echo($address['street']." ".$address['no'].$address['addition']."<br />");
            echo($address['zipcode']."<br />");
            echo($address['country']."<br />");
            
            //Order has been completed, remove the variables used for the order.
            unset($_SESSION['orderAmount'],
                    $_SESSION['paidItems']);
    }

?>
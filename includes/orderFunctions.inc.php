<?php

function showOrder($order){
	echo ("<tr><td>".$order['user']."</td><td>".$order['addressid']."</td><td>".$order['status']."</td><td><a href=\"index.php?page=cms&amp;cmsid=4&amp;order=".$order['id']."&amp;method=edit\">Edit Order</a>");
}

function editOrder($id){
	include_once("database/dbfunctions.inc.php");
	include_once("classes/product.class.php");
	$orders = get_order_by_id($id);
	$order = $orders[0];
	$addressid = $order['addressid'];
	$addresses = get_address_by_id($addressid);
	$address = $addresses[0];
    $items = get_items_by_orderid($order['id']);
        echo("<h1><small>Products</small></h1>");

        

        
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
            foreach ($items as $item)
            {
            	
                $product = new Product(intval($item['productid']));
                if ($product->get('id') == $item['productid']) //make sure the product exists. 
                {
                    $productTotal = $product->get('price') * $item['amount'];
                    
                    $totalPrice += $productTotal;
                    
                    echo("
                        <a class=\"list-group-item\">
                            <div class=\"cartItemTitle\">".$product->get('name')."</div>
                            <div class=\"cartAmount\">".$item['amount']."</div>
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
            echo($address['street']." ".$address['number'].$address['addition']."<br />");
            echo($address['zipcode']."<br />");
            echo($address['country']."<br />");
            
            echo("
            	<form role=\"form\" method=\"post\" action=\"index.php?page=cms&amp;cmsid=4\" name=\"editorder\">
            	<input type=\"hidden\" name=\"id\" value=\"" . $order['id'] . "\">
            	<div class=\"form-group\">
                <label for=\"order_edit_status\">Status</label>
                <select id=\"order_edit_status\" class=\"form-control\" name=\"status\" required>
                ");
				if($order['status']=="ordered"){
					echo ("
						<option value=\"ordered\" selected=\"selected\">ordered</option>
						<option value=\"shipped\">shipped</option>");
						
				}
				else{
		    		echo ("
						<option value=\"ordered\">ordered</option>
						<option value=\"shipped\"selected=\"selected\">shipped</option>");
						
		    	}
			    
			    echo("
			    </select>
			    </div>

            	
            	");
	    echo("
	    	<a class=\"btn btn-lg btn-default\" href=\"index.php?page=cms&amp;cmsid=4\">Back to all Orders</a>
	    	<button type=\"submit\" class=\"btn btn-lg btn-default\" name=\"editorder\" value=\"Edit Order\">Save changes</button>
	    	</form>
	    	");
        
}
}
?>
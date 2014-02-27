<?php 
    include_once('database/dbfunctions.inc.php');
    
    $categories = get_all_categories();
	
    foreach($categories as $category)
    {
        echo("<b>Category: ".$category->get('name')."</b><br />");
        $products = get_products_by_category($category->get('id'));
        foreach($products as $product)
        {
            echo("- Product: ".$product->get('name')."<br />");
        }
    }
	
	
?>
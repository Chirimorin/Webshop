<?php 
    function error($msg)
    {
        echo("<div class=\"alert alert-danger\"><strong>$msg</strong><br /></div>");
    }
    
    
    if (isset($_GET['catid']))
    {
        include_once('database/dbfunctions.inc.php');
        include_once('classes/category.class.php');
        
        $catid = intval($_GET['catid']);
        
        $category = new Category($catid);
        
        if (null === $category->get('id'))
        {
            error("Product category not found.");
        }
        else
        {
            echo("<b>Category: ".$category->get('name')."</b><br />");
            $products = get_products_by_category($category->get('id'));
            foreach($products as $product)
            {
                echo("- Product: ".$product->get('name')."<br />");
            }
        }
    }
    else //isset catid
    {
        error("No category selected.");
    }
?>

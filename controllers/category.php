<?php 
    function error($title, $msg)
    {
        echo("<script type=\"text/javascript\">document.title = '".$title." - ".$msg."';</script>");
        echo("<a href=\"index.php\">Home</a> > Categories <br /><br />");
        echo("<div class=\"alert alert-danger\"><strong>$msg</strong><br /></div>");
    }
    
    
    if (isset($_GET['catid']))
    {
        include_once('database/dbfunctions.inc.php');
        include_once('classes/category.class.php');
		include_once('includes/productFunctions.inc.php');
        
        $catid = intval($_GET['catid']);
        
        $category = new Category($catid);
        
        if (null === $category->get('id'))
        {
            error($title, "Product category not found.");
        }
        else
        {
            echo("<script type=\"text/javascript\">document.title = '".$title." - ".$category->get('name')."';</script>");
            echo("<a href=\"index.php\">Home</a> > ".$category->get('name')." <br /><br />");
            
            include('includes/filter.inc.php');
            
            $products = get_products_by_category($category->get('id'));
            
            $category->showCategoryBoxStart();
            if (count($products) > 0)
            {
                $i = 0;
                echo("<div class=\"product-row\">");
                foreach($products as $product)
                {
                    if ($i%3 == 0 && $i != 0)
                    {
                        echo("</div><div class=\"product-row\">");
                    }
                    showProductBox($product);
                    $i++;
                }
                echo("</div>");
            }
            else
            {
                echo("<div class=\"alert alert-warning\"><strong>No products have been found in this category.</strong><br /></div>");
            }
            $category->showCategoryBoxEnd();
        }
    }
    else //isset catid
    {
        error($title, "No category selected.");
    }
?>

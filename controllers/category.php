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
            
            $products = get_products_by_category($category->get('id'));
            
            $category->showCategoryBoxStart();
            if (count($products) > 0)
            {
                foreach($products as $product)
                {
                    $product->showProductBox();
                }
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

<?php 
    function error($title, $msg)
    {
        echo("<script type=\"text/javascript\">document.title = '".$title." - ".$msg."';</script>");
        echo("<a href=\"index.php\">Home</a> > Error <br /><br />");
        echo("<div class=\"alert alert-danger\"><strong>$msg</strong><br /></div>");
    }
    
    
    if (isset($_GET['productid']))
    {
        include_once('database/dbfunctions.inc.php');
        include_once('classes/category.class.php');
        include_once('classes/product.class.php');
        
        $productid = intval($_GET['productid']);
        
        $product = new Product($productid);
        
        if (null === $product->get('id'))
        {
            error($title, "Product not found.");
        }
        else
        {
            $category = new Category(intval($product->get('categoryid')));
            if (null === $category->get('id')) //Zou nooit moeten gebeuren, check voor de zekerheid. 
            {
                error($title, "Product ".$product->get('name')." does not belong in any category.");
            }
            else
            {
                echo("<script type=\"text/javascript\">document.title = '".$title." - ".$product->get('name')."';</script>");
                echo("<a href=\"index.php\">Home</a> > <a href=\"index.php?page=category&amp;catid=".$category->get('id')."\">".$category->get('name')."</a> > ".$product->get('name')." <br /><br />");
                
                $product->showProductDetail();
                //$products = get_products_by_category($category->get('id'));
                //
                //$category->showCategoryBoxStart();
                //if (count($products) > 0)
                //{
                //    $i = 0;
                //    echo("<div class=\"product-row\">");
                //    foreach($products as $product)
                //    {
                //        if ($i%3 == 0 && $i != 0)
                //        {
                //            echo("</div><div class=\"product-row\">");
                //        }
                //        $product->showProductBox();
                //        $i++;
                //    }
                //    echo("</div>");
                //}
                //else
                //{
                //    echo("<div class=\"alert alert-warning\"><strong>No products have been found in this category.</strong><br /></div>");
                //}
                //$category->showCategoryBoxEnd();
            }
        }
    }
    else //isset catid
    {
        error($title, "No item selected.");
    }
?>
<?php 
    function error($msg)
    {
        echo("<div class=\"alert alert-danger\"><strong>$msg</strong><br /></div>");
    }
    
    function allProducts($title)
    {
        echo("<script type=\"text/javascript\">document.title = '".$title." - Products';</script>");
        echo("<a href=\"index.php\">Home</a> > Products <br /><br />");
        
        include('includes/filter.inc.php');
        
        include_once('database/dbfunctions.inc.php');
		include_once('includes/productFunctions.inc.php');
        
        $categories = get_all_categories();
        
        foreach($categories as $category)
        {
            $products = get_products_by_category($category->get('id'));
            
            if (count($products) > 0)
            {
                $category->showCategoryBoxStart();
                foreach($products as $product)
                {
                    showProductBox($product);
                }
                $category->showCategoryBoxEnd();
            }
        }
    }
    
    
    if (isset($_GET['productid']))
    {
        include_once('database/dbfunctions.inc.php');
        include_once('classes/category.class.php');
        include_once('classes/product.class.php');
		include_once('includes/productFunctions.inc.php');
        
        $productid = intval($_GET['productid']);
        
        $product = new Product($productid);
        
        if (null === $product->get('id'))
        {
            error("Product not found.");
            allProducts($title);
        }
        else
        {
            $category = new Category(intval($product->get('categoryid')));
            if (null === $category->get('id')) //Zou nooit moeten gebeuren, check voor de zekerheid. 
            {
                error("Product ".$product->get('name')." does not belong in any category.");
                allProducts($title);
            }
            else
            {
                echo("<script type=\"text/javascript\">document.title = '".$title." - ".$product->get('name')."';</script>");
                echo("<a href=\"index.php\">Home</a> > <a href=\"index.php?page=category&amp;catid=".$category->get('id')."\">".$category->get('name')."</a> > ".$product->get('name')." <br /><br />");
                
                showProductDetail($product);
            }
        }
    }
    else //isset productid
    {
        allProducts($title);
    }
?>
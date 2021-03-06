Home <br /><br />
<div class="jumbotron">
    <h1>The Ingress Item Webshop</h1>
    <p>Find all your ingress related items here!</p>
</div>
<?php 
    include_once('database/dbfunctions.inc.php');
	include_once('includes/productFunctions.inc.php');
    include_once('includes/categoryFunctions.inc.php');
    
    $categories = get_all_categories();
	
    foreach($categories as $category)
    {
        $products = get_products_by_category($category->get('id'));
        
        if (count($products) > 0)
        {
            showCategoryBoxStart($category);
            $i = 0;
            foreach($products as $product)
            {
                if ($i < 3) //laad alleen de eerste 3 items
                {
                    showProductBox($product);
                    $i++;
                }
            }
            if (count($products) >= 3) //minstens 3 items gevonden
            {
                echo("<a class=\"btn btn-lg btn-default\" href=\"index.php?page=category&amp;catid=".$category->get('id')."\">View all ".$category->get('name')."</a>");
            }
            showCategoryBoxEnd();
        }
    }
?>
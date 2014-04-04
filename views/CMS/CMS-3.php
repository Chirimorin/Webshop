<?php
    function showAllProducts(){
    include_once("includes/productFunctions.inc.php");
    include_once("classes/product.class.php");
    echo "Products </br> <button type=\"button\" class=\"btn btn-lg btn-default\" onclick=\"window.location.href='index.php?page=cms&amp;cmsid=3&amp;product=new'\">Add Product</button></br>";
    $products = get_all_products();
    foreach ($products as $product) {
    	showProduct($product);
    }
}

function editAProduct(){
    include_once("includes/productFunctions.inc.php");
    include_once("classes/product.class.php");
    $id = intval($_GET['product']);

    $product = new Product($id);
    editProduct($product);
}





    
    if(isset($_POST['editproduct'])){
        edit_Product_Post_Data($_POST['id'], $_POST['name'], $_POST['description'], $_POST['longdiscription'], $_POST['image'], $_POST['categoryid'], $_POST['price'], $_POST['rarity']);
        showAllProducts();
    }
    elseif(isset($_POST['newproduct'])){
    	echo "hier kom ik nog";
    	add_Product_Post_Data($_POST['id'], $_POST['name'], $_POST['description'], $_POST['longdiscription'], $_POST['image'], $_POST['categoryid'], $_POST['price'], $_POST['rarity']);
    	showAllProducts();
    }
    elseif (isset($_GET['product'])){
    	if($_GET['product'] == "new"){
    		include_once("includes/productFunctions.inc.php");
			addNewProduct();
    	}
    	elseif(isset($_GET['method']) && $_GET['method'] == "edit"){
        	editAProduct();
        }
        elseif(isset($_GET['method']) && $_GET['method'] == "remove"){
        	include_once("includes/productFunctions.inc.php");
        	$id = intval($_GET['product']);
        	remove_product($id);
        	showAllProducts();
        }

    }
    else{
        showAllProducts();
    }
?>
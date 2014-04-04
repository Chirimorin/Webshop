<a href="index.php">Home</a> > <a href="index.php?page=cms">CMS</a> > Manage products <br /><br />

<?php include('includes/filter.inc.php'); ?>

<div class="page-header">
    <h1>Manage products</h1>
</div>

<?php

function showAllProducts(){
    include_once("includes/productFunctions.inc.php");
    include_once("classes/product.class.php");
    echo "<a class=\"btn btn-lg btn-default\" href=\"index.php?page=cms&amp;cmsid=3&amp;product=new\">Add Product</a><br /><br />";
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
        edit_Product_Post_Data($_POST['id'], $_POST['name'], $_POST['description'], $_POST['longdescription'], $_POST['image'], $_POST['categoryid'], $_POST['price'], $_POST['rarity']);
        showAllProducts();
    }
    elseif(isset($_POST['newproduct'])){
    	add_Product_Post_Data($_POST['name'], $_POST['description'], $_POST['longdescription'], $_POST['image'], $_POST['categoryid'], $_POST['price'], $_POST['rarity']);
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
<?php
    function showAllCategories(){
    include_once("includes/categoryFunctions.inc.php");
    include_once("classes/category.class.php");
    echo "Categories</br> <button type=\"button\" class=\"btn btn-lg btn-default\" onclick=\"window.location.href='index.php?page=cms&amp;cmsid=2&amp;category=new'\">Add Category</button></br>";
    $categories = get_all_categories();
    foreach ($categories as $category) {
        showCategory($category);
    }
}

function editACategory(){
    include_once("includes/categoryFunctions.inc.php");
    include_once("classes/category.class.php");
    $id = intval($_GET['category']);

    $category = new Category($id);
    editCategory($category);
}

    
    if(isset($_POST['editcategory'])){
        edit_Category_Post_Data($_POST['id'], $_POST['name'], $_POST['description']);
        showAllCategories();
    }
    elseif(isset($_POST['newcategory'])){
    	add_Category_Post_Data($_POST['name'], $_POST['description']);
    	showAllCategories();
    }
    elseif (isset($_GET['category'])){
    	if($_GET['category'] == "new"){
    		include_once("includes/categoryFunctions.inc.php");
			addNewCategory();
    	}
    	else{
        	editACategory();
        }

    }
    else{
        showAllCategories();
    }
?>
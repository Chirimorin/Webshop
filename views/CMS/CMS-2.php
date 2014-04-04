<a href="index.php">Home</a> > <a href="index.php?page=cms">CMS</a> > Manage categories

<div class="page-header">
    <h1>Manage categories</h1>
</div>

<?php
function showAllCategories(){
    include_once("includes/categoryFunctions.inc.php");
    include_once("classes/category.class.php");
    
    $categories = get_all_categories();
    
    echo "<div class=\"col-sm-12\"><table class=\"table table-bordered\"><thead><tr><th>Name</th><th>Description</th><th>Edit</th><th>Remove</th></tr></thead><tbody>";
    foreach ($categories as $category) {
        showCategory($category);
    }
    echo("</tbody></table></div><a class=\"btn btn-lg btn-default\" href=\"index.php?page=cms&amp;cmsid=2&amp;category=new\">Add Category</a>");
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
    	elseif(isset($_GET['method']) && $_GET['method'] == "edit"){
        	editACategory();
        }
        elseif(isset($_GET['method']) && $_GET['method'] == "remove"){
        	include_once("includes/categoryFunctions.inc.php");
        	$id = intval($_GET['category']);
        	remove_Category($id);
        	showAllCategories();
        }
        else{
            echo("<div class=\"alert alert-danger\">An error has occured, please try again.</div>");
        }

    }
    else{
        showAllCategories();
    }
?>
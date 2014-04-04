<?php
function showProductBox($product)
{
	if (is_a($product, "Product"))
	{
		echo("<div class=\"col-sm-4\">
				<div class=\"panel panel-info product-info\">
				<div class=\"panel-heading\">
				<h3 class=\"panel-title item-title ".$product->get('rarity')."\">".$product->get('name')."</h3>
				</div>
				<div class=\"panel-body\">
				<div class=\"product-container\">");
		if(file_exists("images/thumbs/".$product->get('image')))
		{
			echo("<img class=\"thumb\" src=\"images/thumbs/".$product->get('image')."\" alt=\"".$product->get('name')."\" />");
		}
		else
		{
			echo("<img class=\"thumb\" src=\"images/thumbs/NoImage.jpg\" alt=\"".$product->get('name')."\" />");
		}
		echo("<div class=\"description\">".$product->get('description')."<br /><br /><a href=\"index.php?page=product&amp;productid=".$product->get('id')."\">More Info</a></div>
				</div>
				<div class=\"price\">Price: &euro;".$product->get('price')."</div>
				<div class=\"cart\">
                    <input class=\"itemID\" name=\"itemID\" type=\"hidden\" value=\"".$product->get('id')."\"/>
                    <input class=\"amount\" name=\"amount\" type=\"number\" value=\"1\" />&nbsp;
                    <button type=\"button\" class=\"btn btn-xs btn-default add-to-cart\">Add to cart</button>
                </div>
				</div>
				</div>
				</div>");
	}
}

function showProductDetail($product)
{
	if (is_a($product, "Product"))
	{
		$longdescription = $product->get('longdescription');
		//$longdescription = nl2br($longdescription); //doesn't work, mysql doesn't give the line breaks? 
		
		echo("<div class=\"panel panel-info\">
				<div class=\"panel-heading\">
				<h3 class=\"panel-title item-title ".$product->get('rarity')."\">".$product->get('name')."</h3>
				</div>
				<div class=\"panel-body\">
				<div class=\"product-container\">");
		if(file_exists("images/".$product->get('image')))
		{
			echo("<img class=\"product-image\" src=\"images/".$product->get('image')."\" alt=\"".$product->get('name')."\" />");
		}
		else
		{
			echo("<img class=\"product-image\" src=\"images/NoImage.jpg\" alt=\"".$product->get('name')."\" />");
		}
		echo("<div class=\"description\">".$product->get('longdescription')."</div>
				</div>
				<div class=\"price\">Price: &euro;".$product->get('price')."</div>
				<div class=\"cart\">
                    <input class=\"itemID\" name=\"itemID\" type=\"hidden\" value=\"".$product->get('id')."\"/>
                    <input class=\"amount\" name=\"amount\" type=\"number\" value=\"1\" />&nbsp;
                    <button type=\"button\" class=\"btn btn-xs btn-default add-to-cart\">Add to cart</button>
                </div>
				</div>
				</div>");
	}
}

function showProduct($product)
{
	if (is_a($product, "Product"))
	{
		echo("<div class=\"col-sm-4\">
				<div class=\"panel panel-info product-info\">
				<div class=\"panel-heading\">
				<h3 class=\"panel-title item-title ".$product->get('rarity')."\">".$product->get('name')."</h3>
				</div>
				<div class=\"panel-body\">
				<div class=\"product-container\">");
		if(file_exists("images/thumbs/".$product->get('image')))
		{
			echo("<img class=\"thumb\" src=\"images/thumbs/".$product->get('image')."\" alt=\"".$product->get('name')."\" />");
		}
		else
		{
			echo("<img class=\"thumb\" src=\"images/thumbs/NoImage.jpg\" alt=\"".$product->get('name')."\" />");
		}
		echo("<div class=\"description\">".$product->get('description')."<br /><br /><a href=\"index.php?page=product&amp;productid=".$product->get('id')."\">More Info</a></div>
				</div>
				<div class=\"price\">Price: &euro;".$product->get('price')."</div>
				<div class=\"cart\">
                    <button type=\"button\" class=\"btn btn-xs btn-default\" onclick=\"window.location.href='index.php?page=cms&amp;cmsid=3&amp;product=".$product->get('id')."&amp;method=edit'\">Edit</button>
                    <button type=\"button\" class=\"btn btn-xs btn-default\" onclick=\"window.location.href='index.php?page=cms&amp;cmsid=3&amp;product=".$product->get('id')."&amp;method=remove'\">Remove</button>
                </div>
				</div>
				</div>
				</div>");
	}
}

function editProduct($product)
{
	include_once("classes/category.class.php");
	include_once("database/dbfunctions.inc.php");
	$categories = get_all_categories();
	$rarities = get_rarities();
    echo("
        <form role=\"form\" method=\"post\" action=\"index.php?page=cms&amp;cmsid=2\" name=\"editproduct\">
            <input type=\"hidden\" name=\"id\" value=\"" . $product->get('id') . "\">
            <div class=\"form-group\">
                <label for=\"product_edit_name\">Name</label>
                <input id=\"product_edit_name\" class=\"form-control\" name=\"name\" type=\"text\" value=\"" . $product->get('name') . "\" required>
            </div>
            <div class=\"form-group\">
                <label for=\"product_edit_description\">Description</label>
                <input id=\"product_edit_description\" value=\"" . $product->get('description') . "\" class=\"form-control\" type=\"text\" name=\"description\" required>
            </div>
			<div class=\"form-group\">
                <label for=\"product_edit_longdescription\">Long description</label>
                <textarea id=\"product_edit_longdescription\" class=\"form-control\" type=\"text\" name=\"longdescription\" required>".$product->get('longdescription')."</textarea>
            </div>
            <div class=\"form-group\">
                <label for=\"product_edit_price\">Price</label>
                <input id=\"product_edit_price\" value=\"" . $product->get('price') . "\" class=\"form-control\" type=\"number\" min=\"0\" step=\"0.01\" name=\"price\" required>
            </div>
            <div class=\"form-group\">
                <label for=\"product_edit_category\">Category</label>
                <select id=\"product_edit_category\"  class=\"form-control\" name=\"category\" required>
                ");
			foreach ($categories as $category) {

				if($category->get('id')==$product->get('categoryid')){
					echo ("<option value=\"".$category->get('name')."\" selected=\"selected\">".$category->get('name')."</option>");
				}
				else{
		    		echo ("<option value=\"".$category->get('name')."\">".$category->get('name')."</option>");
		    	}
		    }
		    echo("
                </select>
            </div>
            <div class=\"form-group\">
                <label for=\"product_edit_image\">Image Url</label>
                <input id=\"product_edit_image\" value=\"" . $product->get('image') . "\" class=\"form-control\" type=\"text\" name=\"description\" required>
            </div>
            <div class=\"form-group\">
                <label for=\"product_edit_rarity\">Rarity</label>
                <select id=\"product_edit_rarity\" class=\"form-control\" name=\"category\" required>
                ");
			foreach ($rarities as $rarity) {

				if($rarity['rarity']==$product->get('rarity')){
					echo ("<option value=\"".$rarity['rarity']."\" selected=\"selected\">".$rarity['rarity']."</option>");
				}
				else{
		    		echo ("<option value=\"".$rarity['rarity']."\">".$rarity['rarity']."</option>");
		    	}
		    }
		    echo("
		    </select>
		    </div>
            <button type=\"button\" class=\"btn btn-lg btn-default\" onclick=\"window.location.href='index.php?page=cms&amp;cmsid=3'\">Back to all Products</button>
            <button type=\"submit\" class=\"btn btn-lg btn-default\" name=\"editproduct\" value=\"Edit product\">Save changes</button>
        </form>
    ");
}

function addNewProduct()
{
     include_once("classes/category.class.php");
	include_once("database/dbfunctions.inc.php");
	$categories = get_all_categories();
	$rarities = get_rarities();
    echo("
        <form role=\"form\" method=\"post\" action=\"index.php?page=cms&amp;cmsid=2\" name=\"newproduct\">
            <div class=\"form-group\">
                <label for=\"product_new_name\">Name</label>
                <input id=\"product_new_name\" class=\"form-control\" name=\"name\" type=\"text\"  required>
            </div>
            <div class=\"form-group\">
                <label for=\"product_new_description\">Description</label>
                <input id=\"product_new_description\"  class=\"form-control\" type=\"text\" name=\"description\" required>
            </div>
			<div class=\"form-group\">
                <label for=\"product_new_longdescription\">Long description</label>
                <textarea id=\"product_new_longdescription\" class=\"form-control\" type=\"text\" name=\"longdescription\" required></textarea>
            </div>
            <div class=\"form-group\">
                <label for=\"product_new_price\">Price</label>
                <input id=\"product_new_price\"  class=\"form-control\" type=\"number\" min=\"0\" step=\"0.01\" name=\"price\" required>
            </div>
            <div class=\"form-group\">
                <label for=\"product_new_category\">Category</label>
                <select id=\"product_new_category\"  class=\"form-control\" name=\"category\" required>
                ");
			foreach ($categories as $category) {
		    		echo ("<option value=\"".$category->get('id')."\">".$category->get('name')."</option>");
		    }
		    echo("
                </select>
            </div>
            <div class=\"form-group\">
                <label for=\"product_new_image\">Image Url</label>
                <input id=\"product_new_image\"  class=\"form-control\" type=\"text\" name=\"description\" required>
            </div>
            <div class=\"form-group\">
                <label for=\"product_new_rarity\">Rarity</label>
                <select id=\"product_new_rarity\"  class=\"form-control\" name=\"category\" required>
                ");
			foreach ($rarities as $rarity) {
		    		echo ("<option value=\"".$rarity['rarity']."\">".$rarity['rarity']."</option>");
		    }
		    echo("
		    </select>
		    </div>
            <button type=\"button\" class=\"btn btn-lg btn-default\" onclick=\"window.location.href='index.php?page=cms&amp;cmsid=3'\">Back to all Products</button>
            <button type=\"submit\" class=\"btn btn-lg btn-default\" name=\"newproduct\" value=\"New product\">Save changes</button>
        </form>
    ");   
}
?>

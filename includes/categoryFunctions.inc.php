<?php
    function showCategoryBoxStart($category)
    {
        echo("<div class=\"panel panel-primary\">
                <div class=\"panel-heading\">
                <h3 class=\"panel-title\">".$category->get('name')."</h3>
                </div>
                <div class=\"panel-body\">");
    }
    
    function showCategoryBoxEnd()
    {
        echo("</div>
                </div>");
    }

    function showCategory($category)
    {
        echo ("<tr><td>".$category->get('name')."</td>
        <td>".$category->get('description')."</td>
        <td><a href=\"index.php?page=cms&amp;cmsid=2&amp;category=".$category->get('id')."\">Edit Category</a></td>
        <td><a href=\"index.php?page=cms&amp;cmsid=2&amp;category=".$category->get('id')."&amp;method=remove\">Remove Category</a></td>");
    }

    function editCategory($category)
    {
        echo("
            <form role=\"form\" method=\"post\" action=\"index.php?page=cms&amp;cmsid=2\" name=\"editcategory\">
                <input type=\"hidden\" name=\"id\" value=\"" . $category->get('id') . "\">
                <div class=\"form-group\">
                    <label for=\"category_edit_name\">Name</label>
                    <input id=\"category_edit_name\" class=\"form-control\" name=\"name\" type=\"text\" value=\"" . $category->get('name') . "\" required>
                </div>
                <div class=\"form-group\">
                    <label for=\"category_edit_description\">Description</label>
                    <input id=\"category_edit_description\" value=\"" . $category->get('description') . "\" class=\"form-control\" type=\"text\" name=\"description\" required>
                </div>
                <button type=\"button\" class=\"btn btn-lg btn-default\" onclick=\"window.location.href='index.php?page=cms&amp;cmsid=2'\">Back to all Categories</button>
                <button type=\"submit\" class=\"btn btn-lg btn-default\" name=\"editcategory\" value=\"Edit Category\">Save changes</button>
            </form>
        ");
    }

    function addNewCategory()
    {
         echo("
            <form role=\"form\" method=\"post\" action=\"index.php?page=cms&amp;cmsid=2\" name=\"newcategory\">
                <div class=\"form-group\">
                    <label for=\"category_new_name\">Name</label>
                    <input id=\"category_new_name\" class=\"form-control\" placeholder=\"Put here the category name\" name=\"name\" type=\"text\" required>
                </div>
                <div class=\"form-group\">
                    <label for=\"category_new_description\">Description</label>
                    <input id=\"category_new_description\" class=\"form-control\" type=\"text\" placeholder=\"Put here the category description\"name=\"description\" required>
                </div>
                <button type=\"button\" class=\"btn btn-lg btn-default\" onclick=\"window.location.href='index.php?page=cms&amp;cmsid=2'\">Back to all Categories</button>
                <button type=\"submit\" class=\"btn btn-lg btn-default\" name=\"newcategory\" value=\"New Category\">Add Category</button>
            </form>
        ");       
    }
?>

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
?>

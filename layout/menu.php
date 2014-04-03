<?php 
    include_once('database/dbfunctions.inc.php');
    include_once('classes/login.class.php');
    
	function checkPage($page)
	{
		if (isset($_GET['page']))
		{
			if ($page == $_GET['page'])
			{
				echo("active");
			}
		}
		else
		{
			if ($page == "home")
			{
				echo("active");
			}
		}
	}
    
    function checkCategory($catid)
    {
        if (isset($_GET['catid']))
        {
            if ($catid == $_GET['catid'])
            {
                echo("active");
            }
        }
    }
?>
<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php"><?php echo($title); ?></a>
    </div>
    <div class="navbar-collapse collapse">
      <ul class="nav navbar-nav">
        <li class="<?php checkPage("home"); ?>"><a href="index.php">Home</a></li>
        <li class="<?php checkPage("product"); ?>"><a href="index.php?page=product">Products</a></li>
        <li class="dropdown <?php checkPage("category"); ?>">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Categories <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <?php 
                $categories = get_all_categories();

                foreach($categories as $category)
                {
                    echo("<li class=\"");
                    checkCategory($category->get('id'));
                    echo("\"><a href=\"index.php?page=category&amp;catid=".$category->get('id')."\">".$category->get('name')."</a></li>");
                }
            ?>
          </ul>
        </li>
        <li class="<?php checkPage("about"); ?>"><a href="index.php?page=about">About</a></li>
        <li class="<?php checkPage("contact"); ?>"><a href="index.php?page=contact">Contact</a></li>
        <li class="<?php checkPage('login'); ?>"><a href="index.php?page=login"><?php echo(login::isUserLoggedIn() ? 'Logout' : 'Login'); ?></a></li>
        <li><a id="html5check" href="">Validate HTML5</a></li>
        <li><a id="shoppingCartButton" href="#">Shopping Cart <b class="caret"></b></a></li>
      </ul>
    </div><!--/.nav-collapse -->
  </div>
</div>

<div class="container theme-showcase fixed" role="main">

<div id="shoppingCart" class="col-sm-offset-4 fixed">
    <div class="panel panel-warning">
        <div class="panel-heading">
            <h3 class="panel-title">Shopping cart</h3>
        </div>
        <div class="panel-body" id="shoppingList">
            
        </div>
    </div>
</div>
    
    
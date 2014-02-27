<!-- Fixed navbar -->
<?php 
	function checkPage($page)
	{
		if (isset($_GET['page']))
		{
			if ($page == $_GET['page'])
			{
				echo("class=\"active\"");
			}
		}
		else
		{
			if ($page == "home")
			{
				echo("class=\"active\"");
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
          <a class="navbar-brand" href="index.php">Webshop</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li <?php checkPage("home"); ?>><a href="index.php">Home</a></li>
            <li <?php checkPage("about"); ?>><a href="index.php?page=about">About</a></li>
            <li <?php checkPage("contact"); ?>><a href="index.php?page=contact">Contact</a></li>
            <li <?php checkPage("voortgang"); ?>><a href="index.php?page=voortgang">Voortgang</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li class="divider"></li>
                <li class="dropdown-header">Nav header</li>
                <li><a href="#">Separated link</a></li>
                <li><a href="#">One more separated link</a></li>
              </ul>
            </li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>

    <div class="container theme-showcase" role="main">
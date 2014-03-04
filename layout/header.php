
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../../assets/ico/favicon.ico">

    <title>
        <?php
            $title = "Ingress Shop";
            echo($title." - ");
            if (isset($_GET['page']))
            {
                if (file_exists("controllers/".$_GET['page'].".php"))
                {
                    echo($_GET['page']);
                }
                else
                {
                    echo("Page not found");
                }
            }
            else
            {
                echo("Home");
            }
        ?>
    </title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap theme -->
    <link href="css/bootstrap-theme.min.css" rel="stylesheet">
    
    <link href="css/style.css" rel="stylesheet">
	
	<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>

    <!-- Custom styles for this template -->
    <link href="css/theme.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body role="document">

    
<?php
    if (isset($_GET['section']))
    {
        if (file_exists("views/webs2/".$_GET['section'].".php"))
		{
            include("views/webs2/".$_GET['section'].".php");
		}
        else
        {
            include("views/webs2/taakverdeling.php");
        }
    }
    else
    {
        include("views/webs2/taakverdeling.php");
    }
?>
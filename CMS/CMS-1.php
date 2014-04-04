<?php
    include_once("includes/userFunctions.inc.php");
    include_once("classes/user.class.php");
    if(isset($_POST['edituser'])){
        echo "post data ". $_POST['username'] . " , " . $_POST['accesslevel'];
        edit_User_Post_Data($_POST['username'], $_POST['accesslevel']);
        //echo $info;
    }
    elseif (isset($_GET['username'])){
        $username = $_GET['username'];
        $user = new User($username);
        editUser($user);
    }
    else{
        echo "Users</br>";
        $users = get_all_users();
        foreach ($users as $user) {
            showUser($user);
        }
    }
?>
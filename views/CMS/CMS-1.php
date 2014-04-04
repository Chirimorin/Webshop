<?php

function showAllUsers(){
    include_once("includes/userFunctions.inc.php");
    include_once("classes/user.class.php");
    echo "Users</br>";
    $users = get_all_users();
    foreach ($users as $user) {
        showUser($user);
    }
}

function editAUser(){
    include_once("includes/userFunctions.inc.php");
    include_once("classes/user.class.php");
    $username = $_GET['username'];
    $user = new User($username);
    editUser($user);
}
    
    if(isset($_POST['edituser'])){
        edit_User_Post_Data($_POST['username'], $_POST['accesslevel']);
        showAllUsers();
    }
    elseif (isset($_GET['username'])){
        editAUser();
    }
    else{
        showAllUsers();
    }
?>
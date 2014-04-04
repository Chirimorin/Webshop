<a href="index.php">Home</a> > Edit users

<div class="page-header">
    <h1>Edit users</h1>
</div>

<?php

function showAllUsers(){
    include_once("includes/userFunctions.inc.php");
    include_once("classes/user.class.php");
    
    $users = get_all_users();
    
    echo "<div class=\"col-sm-6\"><table class=\"table\"><thead><tr><th>Username</th><th>Access Level</th><th>Edit</th></tr></thead><tbody>";
    foreach ($users as $user) {
        showUser($user);
    }
    echo "</tbody></table></div>";
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
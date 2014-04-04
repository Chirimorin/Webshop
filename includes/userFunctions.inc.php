<?php
function showUser($user){
	echo $user->get('username') . ", " . $user->get('accesslevel') . " <a href=\"\">edit User</a></br>";
}

function editUser($user){

}
?>
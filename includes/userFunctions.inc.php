<?php
function showUser($user){
	echo $user->get('username') . ", " . $user->get('accesslevel') . " <a href=\"index.php?page=cms&amp;cmsid=1&amp;username=".$user->get('username')."\">edit User</a></br>";
}

function editUser($user){
	echo $user->get('username') . ", " . $user->get('accesslevel');
	echo("
	<form role=\"form\" method=\"post\" action=\"index.php?page=cms&amp;cmsid=1\" name=\"loginform\">
    <div class=\"form-group\">
    	<label for=\"user_edit_username\">Username</label>
    	<input id=\"user_edit_username\" class=\"form-control\" type=\"text\" value=\"" . $user->get('username') . "\" readonly>
    </div>
    <div class=\"form-group\">
    	<label for=\"user_edit_accesslevel\">Accesslevel</label>
    	<input id=\"user_edit_accesslevel\" value=\"" . $user->get('accesslevel') . "\"\" class=\"form-control\" type=\"number\" name=\"accesslevel\" min=\"1\" max=\"100\" required />
    </div>
    </form>
    ");
}
?>
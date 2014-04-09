<a href="index.php">Home</a> > <a href="index.php?page=cms">CMS</a> > Orders

<div class="page-header">
    <h1>Orders</h1>
</div>
<?php

function showAllorders(){
    include_once("includes/orderFunctions.inc.php");
    $orders = get_all_orders();
    echo "<div class=\"col-sm-6\"><table class=\"table table-bordered\"><thead><tr><th>User</th><th>Adressid</th><th>Status</th><th>Edit</th></tr></thead><tbody>";
    foreach ($orders as $order) {
    	showorder($order);
    }
    echo "</tbody></table></div>";
}

function editAorder(){
    include_once("includes/orderFunctions.inc.php");
    $id = intval($_GET['order']);
    editorder($id);
}

   
    if(isset($_POST['editorder'])){
        edit_order_Post_Data($_POST['id'], $_POST['status']);
        showAllorders();
    }

    elseif (isset($_GET['order'])){
		if(isset($_GET['method']) && $_GET['method'] == "edit"){
        	editAorder();
        }
    }
    else{
        showAllorders();
    }
?>

<?php
    
?>
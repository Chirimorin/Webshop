<a href="index.php">Home</a> >  Order complete

<div class="page-header">
    <h1>Order complete</h1>
</div>

<?php
    if (isset($_SESSION['paymentDone']))
    {
        if ($_SESSION['paymentDone'] == true)
        {
            unset($_SESSION['paymentDone']);
            
            //TODO add order to the database
            
            ?>
            <script type="text/javascript">$(document).ready(function(){ $("#shoppingList").load("cart.php?method=empty"); });</script>

            <div class="alert alert-success">
                <strong>Your order has been completed successfully!</strong>
            </div>
            <?php
        }
    }
    else
    {
        ?>
        <div class="alert alert-danger">
            <strong>There was an error processing your order. Please try again.</strong>
        </div>
        <?php
    }

?>
<a href="index.php">Home</a> > <a href="index.php?page=order">Order</a> > <a href="index.php?page=order&amp;step=address">Address info</a> > <a href="index.php?page=order&amp;step=address">Review</a> > Payment

<div class="page-header">
    <h1>Choose your payment method</h1>
</div>
<?php
    if (isset($_SESSION['orderAmount'], $_SESSION['paidItems']))
    {
        $_SESSION['paymentDone'] = true;
        echo("Total order amount: &euro;".number_format($_SESSION['orderAmount'],2));
        
        ?>
        <div class="alert alert-success">
            <strong>Limited time offer! No payments have to be made!</strong><br />
            Press the button below to proceed
        </div>

        <a class="btn btn-s btn-success cart-order" href="index.php?page=order&amp;step=final">Complete your order</a>
        <?php
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
<a href="index.php">Home</a> > <a href="index.php?page=order">Order</a> > Address info

<div class="page-header">
    <h1>Address info</h1>
</div>

<form class="form-horizontal" role="form" id="adress-form" action="index.php?page=order&amp;step=review" method="post">
    <div class="form-group">
        <label class="col-sm-2 control-label" for="name">Name</label>
        <div class="col-sm-3">
            <input type="text" name="name" placeholder="Name" class="form-control" required />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="address">Address</label>
        <div class="col-sm-6">
            <input type="text" name="street" placeholder="Street" class="form-control" required />
        </div>
        <div class="col-sm-2">
            <input type="number" name="no" placeholder="No" class="form-control" required />
        </div>
        <div class="col-sm-2">
            <input type="text" name="addition" placeholder="Addition" class="form-control" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="zipcode">Zipcode</label>
        <div class="col-sm-3">
            <input type="text" name="zipcode" placeholder="Zipcode" class="form-control" required />
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="country">Country</label>
        <div class="col-sm-3">
            <input type="text" name="country" placeholder="Country" class="form-control" required />
        </div>
    </div>
    
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default">Submit</button>
        </div>
    </div>
</form>

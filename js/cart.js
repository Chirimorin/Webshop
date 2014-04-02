//global vars
var cartOpen = false;

//functions
function openCart()
{
    cartOpen = true;
	$("#shoppingCart").slideDown();
}

function closeCart()
{
    cartOpen = false;
    $("#shoppingCart").slideUp();
}

function toggleCart()
{
    if (cartOpen)
    {
        closeCart();
    }
    else
    {
        openCart();
    }
}

//logic
$(document).ready(function(){ 
    $("#shoppingList").load("cart.php");
	console.log("Cart loaded")
});

$("#shoppingCartButton").click(function(){
	toggleCart();
    console.log("Navbar height: " + $(".navbar").height());
	return false;
});

$(".add-to-cart").click(function(){
    var itemID = $(this).parent().find($(".itemID")).val();
    var amount = $(this).parent().find($(".amount")).val();
    
    $("#shoppingList").load("cart.php?method=add&itemID="+itemID+"&amount="+amount);
    
    openCart();
});
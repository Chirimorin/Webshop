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
	console.log("Cart loaded")
});

$("#shoppingCartButton").click(function(){
	toggleCart();
    console.log("Navbar height: " + $(".navbar").height());
	return false;
});

$(".add-to-cart").click(function(){
    var itemName = $(this).parent().find($(".itemName")).val();
    var itemID = $(this).parent().find($(".itemID")).val();
    var price = $(this).parent().find($(".price")).val();
    var amount = $(this).parent().find($(".amount")).val();
    
    $("#shoppingList").prepend("<a href=\"index.php?page=product&productid="+itemID+"\" class=\"list-group-item\">\
                                <div class=\"cartItemTitle\">"+itemName+"</div>\
                                <div class=\"cartPrice\">&euro;"+price+"</div>\
                                &nbsp;\
                                </a>");
    
    console.log("Item: "+itemName+" ("+itemID+"), amount: "+amount+", price: "+price);
});
//functions


//logic
$(document).ready(function(){ 
	console.log("Cart loaded")
	
	
});

$("#shoppingCartButton").click(function(){
	console.log("opening cart");
	
	$("#shoppingCart").slideDown();
	console.log("left: " + $(this).css('left'));
	
	return false;
});
	
	
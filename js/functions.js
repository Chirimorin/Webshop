$(document).ready(function(){ 
	$(".fixed").css({"top": ($(".navbar").height())});
});

$(window).resize(function(e){
    $(".fixed").css({"top": ($(".navbar").height())});
});

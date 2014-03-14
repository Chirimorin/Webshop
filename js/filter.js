$("#searchbar").change(function(){
    var value = $(this).val().toLowerCase();
    $(".product-info").each(function(){
        var product = $(this).find(".item-title").html().toLowerCase();
        if (product.search(value) != -1)
        {
            $(this).parent().slideDown();
        }
        else
        {
            $(this).parent().slideUp();
        }
    });
});

$(window).scroll(function(e){
    if ($(this).scrollTop() > 65)
    {
        if ($(".searchbar").css('position') != 'fixed')
        {
            $(".searchbar").css({'position': 'fixed', 'top': '50px'});
        }
    }
    else 
    {
        $(".searchbar").css({'position': '', 'top': ''});
    }
});
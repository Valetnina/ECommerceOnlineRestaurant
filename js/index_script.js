$(document).ready(function () {

//alert(categoryID);
    $('#index-products').load('/category/' + 1 + '/' + 0);
    
    
    var isVeget = 0;
    if ($("input[type='checkbox']").prop('checked')) {
        isVeget = 1;
    }
    alert(isVeget);

    $("#cbVegetarian").click(function () {
        alert("isVeget was clicked");
        isVeget = 1;
            $('#index-products').load('/category/' + isVeget);
        
    });


    $("#navCategory").on("click", "button", function () {

        var categoryID = $(this).attr('id');
        //alert(categoryID + isVeget);
        
        if (isVeget == 1)
            $('#index-products').load('/category/' + categoryID + '/' + isVeget);
else{
    $('#index-products').load('/category/' + 1 + '/' + 0);
}
    });
});


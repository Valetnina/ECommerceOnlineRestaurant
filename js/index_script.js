$(document).ready(function () {

    //alert(categoryID);
    $('#index-products').load('/category/' + 1 + '/' + 0);

    $("#navCategory").on("click", "button", function () {

        var categoryID = $(this).attr('id');
        
        var isVeget = 0;
        if ($("input[type='checkbox']").prop('checked')){
            isVeget = 1;
        }
        //alert(categoryID + isVeget);

        $('#index-products').load('/category/' + categoryID + '/' + isVeget);
    });

});


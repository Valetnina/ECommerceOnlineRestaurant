 function changePage(pageNum){
             $('#index-products').load('/category/' + 1 + '/' + 0 + '/page/' + pageNum);
        }

var pageNum = 1;
$(document).ready(function () {
    $('#index-products').load('/category/' + 1 + '/' + 0 + '/page/1' );
    
    
    var isVeget = 0;
    if ($("input[type='checkbox']").prop('checked')) {
        isVeget = 1;
    }
    alert(isVeget);

    $("#cbVegetarian").click(function () {
        alert("isVeget was clicked");
        isVeget = 1;
            $('#index-products').load('/category/' + isVeget+ '/page/1' );
        
    });


    $("#navCategory").on("click", "button", function () {

        var categoryID = $(this).attr('id');
        //alert(categoryID + isVeget);
        
        if (isVeget == 1)
            $('#index-products').load('/category/' + categoryID + '/' + isVeget+ '/page/1' );
else{
    $('#index-products').load('/category/' + 1 + '/' + 0+ '/page/1' );
}
    });

});



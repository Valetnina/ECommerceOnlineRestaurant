function changeCategory(categoryID){
    alert(categoryID);
     $('#index-products').load('/category/' + categoryID);
}
$(document).ready(function () {

    //alert(categoryID);
    $('#index-products').load('/category/' + 1);
});


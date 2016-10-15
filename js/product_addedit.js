$(document).ready(function () {
    //alert('Hello');

    var currentID = 0;


    $('#bottom-side-addedit').load('/admin/product_addedit');

    $(".btEdit").click(function () {
        //alert("Edit button reaction");
        currentID = (this.id);
        $('#bottom-side-addedit').load('/admin/product_addedit/' + currentID);

    });
    
    $("#btCancelProduct").click(function () {

        alert("CancelProduct button reaction");
    });


});

$(document).ready(function () {
    //alert('Hello');
    var currentID = 0;

    $('#bottom-side-addedit').load('/admin/product_addedit/form');

    $(".btEdit").click(function () {
        
        currentID = (this.id);
        //alert(currentID);
        $('#bottom-side-addedit').load('/admin/product_addedit/form/' + currentID);

    });
    
    $("#btCancelProduct").click(function () {

        alert("CancelProduct button reaction");
    });


});

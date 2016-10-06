$(document).ready(function () {
    var categoryID = $('.categoryIdClass').text();
    alert(categoryID);
    $('#index-products').load('/category/' + 1);

    $("#navCategory").on("click", "button", function () {

       /* var array_categoryID = ($('#category_ID').val()).split('_');
        var categorID = array_categoryID[0];
alert(categoryID);*/



        /* var result = ($(this).text());
         * categoryString = result.toString().toLowerCase()
         .replace(/\s+/g, '-')           // Replace spaces with -
         .replace(/[^\u0100-\uFFFF\w\-]/g, '-') // Remove all non-word chars ( fix for UTF-8 chars )
         .replace(/\-\-+/g, '-')         // Replace multiple - with single -
         .replace(/^-+/, '')             // Trim - from start of text
         .replace(/-+$/, '');            // Trim - from end of text
         alert(categoryString);*/
        alert(categoryID);
        $('#index-products').load('/category/' + categoryID);
    });

});


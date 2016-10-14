$(document).ready(function () {
    //alert('Hello');

    var currentID = 0;

    //$('#tbProducts').load('/admin/product_addedit/');

    $('#bottom-side-addedit').load('/admin/product_addedit/');

    $("#btAddPutProduct").click(function () {

        alert("AddPutProduct button reaction");
        currentID = $("input[name=productID]").val();
        //alert(currentID);

        var lang = $("input[name=lang]").val();
        //alert(lang);

        var name = $("input[name=name]").val();
        //alert(name);

        var categoryName = $("#categoryName option:selected").val();
        //alert(categoryName);

        var price = $("input[name=price]").val();
        //alert(price);

        var nutritionalValue = $("input[name=nutritionalValue]").val();
        //alert(nutritionalValue);

        var isVegetarian = $("input[name=isVegetarian]").attr('checked');
        //alert(isVegetarian);

        var slugname = $("input[name=slugname]").val();
        alert(slugname);

        var description = $("textarea[name=description]").val();

        var picture = $('#uploadImage').propr("files")[0];
        //alert(picture);

        var form_data = new FormData();

        form_data.append('picture', picture);

        //alert(form_data[0]);



        //alert(description);
        //var picture = '?';
        
        if (currentID == 0) {
            // INSERT
            //alert("Insert start");
            $.ajax({
                url: "/admin/product_addedit/",
                data: JSON.stringify({
                    lang: lang,
                    name: name,
                    //categoryName: categoryName,
                    price: price,
                    nutritionalValue: nutritionalValue,
                    isVegetarian: isVegetarian ? "0" : "1",
                    slugname: slugname,
                    description: description
                            //picture: picture
                }),
                type: "POST",
                dataType: "json"
            }).done(function () {
                alert("Addedd successfully");
                //$('#tbProducts').load('/admin/product_addedit/');
            });
        } else {
            // UPDATE
           alert("Update start for ID = " + currentID);
            
            $.ajax({
                url: "/admin/product_addedit/" + currentID,
                data: JSON.stringify({
                    lang: lang,
                    name: name,
                    price: price,
                    nutritionalValue: nutritionalValue,
                    isVegetarian: isVegetarian ? "0" : "1",
                    slugname: slugname,
                    description: description
                }),
                type: "PUT",
                dataType: "json"
            }).done(function () {
                alert("Updated successfully");
                //$('#tbProducts').load('/admin/product_addedit/');
            });
        }
    });


    $("#btCancelProduct").click(function () {

        alert("CancelProduct button reaction");
    });


    $(".btEdit").click(function () {
        //alert("Edit button reaction");
        currentID = (this.id);
        $('#bottom-side-addedit').load('/admin/product_addedit/' + currentID);

    });


});

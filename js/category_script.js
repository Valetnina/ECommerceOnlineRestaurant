$(document).ready(function () {

    var currentID = 0;

    $("#categoryName").change(function () {
        currentID = ($('option:selected', $(this)).attr('id'));
        alert(currentID + " id from 'change' event");

        $.ajax({
            url: '/admin/category_addedit/' + currentID,
            type: 'GET',
            dataType: 'json'
        }).done(function (data) {
            //alert(data.name);
            $('input[name=name]').val(data.name);
            $('input[name=lang]').val(data.lang);
            $('input[name=slugname]').val(data.slugname);
        }).fail(function () {
            alert('Failed');
        });

        //$('#newCategory').load('/admin/category_addedit');

    });

    $('#buttonAddedit').click(function () {
        
        alert(currentID + " id from 'click' button event");

        var categoryName = $('input[name=name]').val();
        var lang = $('input[name=lang]').val();
        var slugname = $('input[name=slugname]').val();

        if (currentID == 0) {
            // INSERT
            alert("Insert begin");
            $.ajax({
                url: '/admin/category_addedit/',
                data: JSON.stringify({
                    ID: currentID,
                    name: categoryName,
                    lang: lang,
                    slugname: slugname
                }),
                type: 'POST',
                dataType: 'json'
            }).done(function () {
                alert("Addedd successfully");

            });
        } else {
            // UPDATE
            alert("PUT begin");
            //alert(currentID);
            $.ajax({
                url: '/admin/category_addedit/' + currentID,
                data: JSON.stringify({
                    name: categoryName,
                    lang: lang,
                    slugname: slugname
                }),
                type: 'PUT',
                dataType: 'json'
            }).done(function () {
                alert("Updated successfully");
            });
        }
        var categoryName = $("input[name=name]").val('');
        var lang = $("input[name=lang]").val('');
        var slugname = $("input[name=slugname]").val('');
    });


});



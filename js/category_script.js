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
            $('input[name=name_en]').val(data.name_en);
            $('input[name=name_fr]').val(data.name_fr);
        }).fail(function () {
            alert('Failed');
        });

        //$('#newCategory').load('/admin/category_addedit');

    });

    $('#buttonAddedit').click(function () {
        
        alert(currentID + " id from 'click' button event");

        var name_en = $('input[name=name_en]').val();
        var name_fr = $('input[name=name_fr]').val();

        if (currentID == 0) {
            // INSERT
            alert("Insert begin");
            $.ajax({
                url: '/admin/category_addedit/',
                data: JSON.stringify({
                    name_en: name_en,
                    name_fr: name_fr,
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
                    name_en: name_en,
                    name_fr: name_fr,
                }),
                type: 'PUT',
                dataType: 'json'
            }).done(function () {
                alert("Updated successfully");
            });
        }
        var name_en = $("input[name=name_en]").val('');
        var name_fr = $("input[name=name_fr]").val('');
    });


});



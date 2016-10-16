$(document).ready(function () {

    $("#btSave").on("click", "button", function () {

        orderID = $(this).attr('id');

        alert(orderID);

        var deliveryDate = $("input[name=deliveryDate]").val();
        var deliveryAmount = $("input[name=deliveryAmount]").val();
        alert(deliveryDate);
        $.ajax({
            url: "/admin/orders/" + orderID,
            data: JSON.stringify({
                deliveryDate: deliveryDate,
                deliveryAmount: deliveryAmount
            }),
            type: "PUT",
            dataType: "json"
        }).done(function () {
            alert("Addedd successfully");
        }).fail(function () {
            alert('Failed');
        });
    });
});


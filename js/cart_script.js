function removeItem(ID) {
    $.ajax({
        url: "/cartItems/" + ID,
        type: "DELETE",
        contentType: 'application/json',
        success: function (result) {
            console.log("cartItems update returned: " + result);
            if (!result) {
                alert("Error removing product from cart ");
            }

        },
        error: function () {
            console.log("delete from cartItems FAILED");
            alert("Error removing product from cart ");
        }
    });


}
//FIXME validation for delete and update    
$(document).ready(function () {
    $(".quanInput").bind('input', function () {
        var quantity = $(this).val();
        var itemID = $(this).attr('itemID');
        console.log("quantity changed: " + quantity + " of item " + itemID);
        if (quantity === "")
            return;

        var data = {quantity: quantity};
        $.ajax({
            url: "/cart/" + itemID,
            type: "PUT",
            data: JSON.stringify(data),
            contentType: 'application/json',
            success: function (result) {
                console.log("cartItems update returned: " + result);
                if (!result) {
                    alert("Error updaing quantity of the product");
                }

            },
            error: function () {
                console.log("cartItems update FAILED");
                alert("Error updating quantity of the product");
            }
        });

    });
    $("#removeItem").click(function () {
        var quantity = $(this).val();
        var itemID = $(this).attr('itemID');
        console.log("quantity changed: " + quantity + " of item " + itemID);
        if (quantity === "")
            return;

        var data = {quantity: quantity};
        $.ajax({
            url: "/cart/" + itemID,
            type: "PUT",
            data: JSON.stringify(data),
            contentType: 'application/json',
            success: function (result) {
                console.log("cartItems update returned: " + result);
                if (!result) {
                    alert("Error updaing quantity of the product");
                }

            },
            error: function () {
                console.log("cartItems update FAILED");
                alert("Error updating quantity of the product");
            }
        });

    });
});

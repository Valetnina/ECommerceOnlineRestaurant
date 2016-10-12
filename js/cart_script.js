


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
            getCartItems();
        },
        error: function () {
            console.log("delete from cartItems FAILED");
            alert("Error removing product from cart ");
        }
    });
}
//FIXME validation for delete and update    
$(document).ready(function () {
   // $('#cartItems').load('/cart');
    /*
geocoder.geocode( { 'address': address}, function(results, status) {
		if (status === google.maps.GeocoderStatus.OK) {
			var latlng = results[0].geometry.location;
			map.setCenter(latlng);
			searchStores(latlng.lat(), latlng.lng());
			
		} else {
			alert('Geocode was failed: ' + status);
		}
	});
        */
    $(".quanInput").bind('input', function () {
        getCartItems();
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
            contentType: 'application/json'
            
    }).done(function(){
        getCartItems();
        }).fail(function(){
                console.log("cartItems update FAILED");
                alert("Error updating quantity of the product");
            });

    });
     
});
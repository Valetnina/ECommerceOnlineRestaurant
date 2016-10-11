function searchAddress(address) {
    geocoder.geocode({'address': address}, function (results, status) {
        if (status === google.maps.GeocoderStatus.OK) {
            var latlng = results[0].geometry.location;
            searchStores(latlng.lat(), latlng.lng());

        } else {
            alert('Geocode failed: ' + status);
        }
    });
}

function searchStores(lat, lng) {
    //var parameter = { lat: lat, lng: lng };
    var nearestStore = 0;
    jQuery.ajax({
        url: '/nearestStore/' + lat + '/' + lng,
        type: "GET",
        dataType: 'json',
    }).done(function (data) {
        nearestStore = data['ID'];
        alert('Nearest store ' + nearestStore);
    }).fail(function () {
        alert('Could not find the nearest store');
    });
    return nearestStore;
}


var geocoder = ""
$(document).ready(function () {
    /*
     function jsonCallback(json){
     console.log(json);
     }
     $.ajax({
     url:  'https://maps.googleapis.com/maps/api/distancematrix/json?origins=Vancouver+BC|Seattle&destinations=San+Francisco|Victoria+BC&key=AIzaSyA8PKmcKFKvYs2Eni_HTVGNTCEeE5FAfh4',
     dataType: 'jsonp',
     // jasonpCallback: "logResults",
     //type: 'GET',
     // cache: false,
     });*/
    geocoder = new google.maps.Geocoder();
    $('#changeAddressForm').hide();
    $('#address').show();
    $('#changeAddressBtn').click(function () {
        $('#changeAddressForm').show();
        $('#address').hide();
    });
    $('#submitAddressChange').click(function () {

        var address = $('input[name=address]').val();
        var street = $('input[name=street]').val();
        var city = $('input[name=city]').val();
        var country = $('input[name=country]').val();
        var postalCode = $('input[name=postalCode]').val();

        //FIXME: Validate inputs
        //FIXME: get the nearest store
        var storeID = searchAddress(postalCode);
        $.ajax({
            url: "/order",
            data: JSON.stringify({
                address: address,
                street: street,
                city: city,
                country: country,
                postalCode: postalCode,
                storeID: storeID
            }),
            type: "POST",
            dataType: "json"
        }).done(function () {
            console.log("order was susuccessfully registered");
        });
    });

});




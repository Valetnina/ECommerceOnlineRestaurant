/*function ajaxCallBack(retString, firstName, lastName, email, address, street, city, country, postalCode, phone){
    alert("nearestStore is" + retString);
     $.ajax({
            url: "/order",
            data: JSON.stringify({
                firstName: firstName,
                lastName: lastName,
                email: email,
                address: address,
                street: street,
                city: city,
                country: country,
                postalCode: postalCode,
                phone: phone,
                storeID: retString
            }),
            type: "POST",
            dataType: "json"
        }).done(function () {
            console.log("order was susuccessfully registered");
        });
}
*/
var nearestStore = "";
function ajaxCallBack(retString){
    alert("nearestStore is" + retString);
     nearestStore = retString;
}
//var geocoder = "";
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

    $('#submitAddressChange').click(function () {
        $('#errorList').html("");
        var firstName = $('input[name=firstName]').val();
        var lastName = $('input[name=lastName]').val();
        var email = $('input[name=email]').val();
        var address = $('input[name=address]').val();
        var street = $('input[name=street]').val();
        var city = $('input[name=city]').val();
        var country = $('input[name=country]').val();
        var postalCode = $('input[name=postalCode]').val();
        var phone = $('input[name=phone]').val();
        var isValid = true;
        var ulList = "<ul>"
        if(firstName.length <1 || firstName.length >50){
            ulList += '<li>First Name must be between 1 and 50 characters long</li>';
            isValid = false;
        }
        if(lastName.length <1 || lastName.length >50){
            ulList += '<li>Last Name must be between 1 and 50 characters long</li>';
            isValid = false;
        }
          var regexEmail = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
          if(!regexEmail.test(email)) {
            ulList += '<li>This doesn\t look like a valid email<li>';
            isValid = false;
  
          }
         if(address.length <1 || address.length >50){
            ulList += '<li>Address must be between 1 and 50 characters long</li>';
            isValid = false;
        }
                 if(street.length <1 || street.length >50){
            ulList += '<li>Street must be between 1 and 50 characters long</li>';
            isValid = false;
        }
                 if(city.length <2 || city.length >100){
            ulList += '<li>City must be between 2 and 100 characters long</li>';
            isValid = false;
        }
         if(country.length <2 || country.length >50){
            ulList += '<li>Country must be between 1 and 50 characters long</li>';
            isValid = false;
        }
        var regexPostalCode = /^([A-Za-z][0-9]){3}$/;
          if(!regexPostalCode.test(postalCode)) {
            ulList += '<li>Postal Code must be in forma A0A0A0<li>';
            isValid = false;
  
          }
          var regexPhone = /^(\d{3}\s?){2}\d{4}$/;
          if(!regexPhone.test(phone)) {
            ulList += '<li><li>';
            isValid = false;
  
          }
          ulList += '</ul>';
          if(!isValid) {
              $('#errorList').html(ulList);
          } else {
               geocoder.geocode({'address': address}, function (results, status) {
        if (status === google.maps.GeocoderStatus.OK) {
            var latlng = results[0].geometry.location;
           // nearestStore = searchStores(latlng.lat(), latlng.lng());
            jQuery.ajax({
                url: '/nearestStore/' + latlng.lat() + '/' + latlng.lng(),
                type: "GET",
                dataType: 'json',
            }).done(function (data) {
                ajaxCallBack(data['ID']);
                $.ajax({
            url: "/order",
            data: JSON.stringify({
                firstName: firstName,
                lastName: lastName,
                email: email,
                address: address,
                street: street,
                city: city,
                country: country,
                postalCode: postalCode,
                phone: phone,
                storeID: nearestStore
            }),
            type: "POST",
            dataType: "json"
        }).done(function () {
            console.log("order was susuccessfully registered");
        });
            }).fail(function () {
                alert('Could not find the nearest store');
            });
        } else {
            alert('Geocode failed: ' + status);
        }
    });
          }
    
       // searchAddress(postalCode);
        //FIXME: Validate inputs
        //
        //
        //get the nearest store
       
       
    });

});




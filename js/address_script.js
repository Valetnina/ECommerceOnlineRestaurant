/*$(document).ready(function () {
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
                //var nearestStore = searchAddress(postalCode);

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
                storeID: 15043
            }),
            type: "POST",
            dataType: "json"
        }).done(function () {
                        $('#orderSubmitted').load('/ordersuccess');
            
            console.log("order was susuccessfully registered");
        });
    }
    });

});
*/
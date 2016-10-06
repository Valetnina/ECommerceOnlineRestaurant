$(document).ready(function () {
    var productID = $('#productID').text();
    $('#reviewList').load('/reviews/product/'+productID);
    
   // getStars($('#averageStars').text());
  
    var selectedRating = 0;
    $(".error").text("");
    $('#reviewForm').hide();
    $('#leaveReview').show();
    
    $('#leaveReview').click(function () {
        $('#reviewForm').show();
        $('#leaveReview').hide();
    });
    $('.reviewEmptyStar').click(function () {
        for(var i=1; i<= 5; i++){
        $('#star'+i).removeClass('glyphicon-star').addClass('glyphicon-star-empty');
        }
        var id = $(this).attr('id').slice(-1);
        selectedRating = id;
        for(var i=1; i<= selectedRating; i++){
        $('#star'+i).removeClass('glyphicon-star-empty').addClass('glyphicon-star');
        }
    });
    $("#postReview").click(function () {
        var review = $("textarea[name=reviewText]").val();
        var rating = selectedRating;
        //FIXME get the current date and time for mysql format
        var date =(new Date()).toISOString().substring(0, 19).replace('T', ' ')
        var productID = $('#productID').text();
        //FIXME ask for current logged user
        var customerID = 1;

        //FIXME: validate input for stars
        if (review.length < 1 || review.length > 500) {
            $(".error").text("You cannot send an empty message");
            return;
        } else {
            $(".error").text("");
        }

        $.ajax({
            url: "/reviews/product/" + productID,
            data: JSON.stringify({
                productID: productID,
                customerID: customerID,
                date: date,
                rating: rating,
                review: review,
            }),
            type: "POST",
            dataType: "json"
        }).done(function () {
            //Refresh fields  
             var selectedRating = 0;
             $("textarea[name=reviewText]").val("");
            // var reviewCount = (int)($('#reviewCount').html())+1;
            // $('#reviewCount').html(reviewCount);
            // $('#reviewCount').val("");
             $('#reviewForm').hide();
             $('#leaveReview').show();
              for(var i=1; i<= 5; i++){
             $('#star'+i).removeClass('glyphicon-star').addClass('glyphicon-star-empty');
        }
             $('#reviewList').load('/reviews/product/'+productID);
           
        });
        $("#pageButton").click(function () {
        alert($( this ).text());
        });
    });
    });


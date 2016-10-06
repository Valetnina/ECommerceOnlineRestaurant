 $(document).ajaxError(function () {
                alert("AJAX request failed");
            });

function getStars(average) {
    var ratingsResult = "";
  
    for (var i = 0; i < average; i++) {
        ratingsResult += "<span class='glyphicon glyphicon-star'></span>";
    }
    for (var i = 0; i < 5 - average; i++) {
        ratingsResult += "<span class='glyphicon glyphicon-star-empty'></span>";
    }
    ratingsResult += "&nbsp" + average;

    $('#averageStars').html(ratingsResult);
  }
function getReviewList(reviewList) {
    var ratingsResult = '<div class="row" style="margin: 25px 0 0 0"><div class="col-md-12">';
    for(var j=0; j< reviewList.length; j++){
        /*
    for (var i = 0; i < reviewList[i]; i++) {
        ratingsResult += "<span class='glyphicon glyphicon-star'></span>";
    }
    for (var i = 0; i < 5 - reviewList; i++) {
        ratingsResult += "<span class='glyphicon glyphicon-star-empty'></span>";
    }*/
    ratingsResult +=  reviewList['firstName'] + '<span class="pull-right">' + 
            reviewList['firstName'] + '{{"days ago"|trans}}</span><br><p>' + 
             reviewList['rating'] + '</p></div></div>';
}

    $('#reviewList').html(ratingsResult);
  }
  
$(document).ready(function () {
    var selectedRating = 0;
    $(".error").text("");
    $('#reviewForm').hide();
    $('#leaveReview').show();
    
    getStars($('#averageStars').text());

    $('#leaveReview').click(function () {
        $('#reviewForm').show();
        $('#leaveReview').hide();
    });
    $('.reviewEmptyStar').click(function () {
        var id = $(this).attr('id').slice(-1);
        selectedRating = id;
        for (var i; i < id; i++) {
            alert("hello");
            $('#star1').html(i);
            $('#star1').removeClass('glyphicon-star-empty').addClass('reviewEmptyStar');
        }
    });
    $("#postReview").click(function () {
        var review = $("textarea[name=reviewText]").val();
        var rating = selectedRating;
        //FIXME get the current date and time for mysql format
        var date = "2016-10-04 00:00:00";
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
            url: "/api.php/product/" + productID,
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
            $.ajax({
                url: "/api.php/productComment/" + productID,
                type: "GET",
                dataType: "json"
            }).done(function (data) {
               //Refresh fields
               $('#reviewCount').text(data['reviewCount']);
               getStars(data['ratingAverage']);
               alert(data['reviewList']);
               getReviewList(data['reviewList']); 
               
            });
             var selectedRating = 0;
             $("textarea[name=reviewText]").val("");
             $('#reviewForm').hide();
             $('#leaveReview').show();
        });
    });

});


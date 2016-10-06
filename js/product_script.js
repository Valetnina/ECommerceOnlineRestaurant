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
  function getReviewStars(selectedRating) {
    var ratingsResult = "";
    for (var i = 0; i < selectedRating; i++) {
        ratingsResult += "<span class='glyphicon glyphicon-star'></span>";
    }
    for (var i = 0; i < 5 - selectedRating; i++) {
        ratingsResult += "<span class='glyphicon glyphicon-star-empty'></span>";
    }
    ratingsResult += "&nbsp" + selectedRating;
  
    $('#selectedRating').html(ratingsResult);
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
    var productID = $('#productID').text();
    $('#reviewList').load('/reviews/product/'+productID);
    
    getStars($('#averageStars').text());
  
    var selectedRating = 0;
    $(".error").text("");
    $('#reviewForm').hide();
    $('#leaveReview').show();
    
    $('#leaveReview').click(function () {
        $('#reviewForm').show();
        $('#leaveReview').hide();
    });
    $('.reviewEmptyStar').click(function () {
        var id = $(this).attr('id').slice(-1);
        selectedRating = id;
        getReviewStars(selectedRating);
    });
    $("#postReview").click(function () {
        var review = $("textarea[name=reviewText]").val();
        var rating = selectedRating;
        //FIXME get the current date and time for mysql format
        var date =(new Date()).toISOString().substring(0, 19).replace('T', ' ')
        //var date = "2016-10-04 00:00:00";
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
            url: "/index.php/reviews/product/" + productID,
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
            alert("added succesfully");
           // $('body').load('/index.php/reviews/product/'+productID);
            /*
            $.ajax({
                url: "/index.php/product/" + productID,
                type: "GET",
                dataType: "json"
            }).done(function (data) {
                alert("refreshed");
               //Refresh fields
              // $('#reviewCount').text(data['reviewCount']);
              // getStars(data['ratingAverage']);
              // getReviewList(data['reviewList']); 
               
            });
            /*
             var selectedRating = 0;
             $("textarea[name=reviewText]").val("");
             getReviewStars(0);
             $('#reviewForm').hide();
             $('#leaveReview').show();
             */
        });

    
    });


        function checkEmail() {
            var email = $('input[name=email]').val();
            if (email != '') {
                $('#result').load('/emailexists/' + email);
<<<<<<< HEAD
                $.ajax({
        url: '/emailexists/' + email,
        type: "GET",
        contentType: 'application/json',
    }).done(function (data){
        if(data){
        $('#emailExists').css('visibility', 'visible');
    } else {
        $('#emailExists').css('visibility', 'hidden');

    }
    });

            } else {
               $('#emailExists').css('visibility', 'hidden');
=======
            } else {
                $('#result').html("");
>>>>>>> origin/master
            }
        }
        
        $(document).ready(function() {
<<<<<<< HEAD
            $('#emailExists').css('visibility', 'hidden');
=======
>>>>>>> origin/master
            $('input[name=email]').keyup(function() {
                checkEmail();
            });
            $('input[name=email]').bind('paste', function() {
                checkEmail();
            });
        });

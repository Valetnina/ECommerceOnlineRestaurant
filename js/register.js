        function checkEmail() {
            var email = $('input[name=email]').val();
            if (email != '') {
                $('#result').load('/emailexists/' + email);
            } else {
                $('#result').html("");
            }
        }
        
        $(document).ready(function() {
            $('input[name=email]').keyup(function() {
                checkEmail();
            });
            $('input[name=email]').bind('paste', function() {
                checkEmail();
            });
        });

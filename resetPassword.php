<?php

$app->get('/forgotPassword', function() use ($app, $log) {
    $app->render('forgot_password.html.twig');
});
$app->post('/forgotPassword', function() use ($app, $log) {
    //When someone claims that password forgotten , make sure there is no active user
    $_SESSION['user'] = array();
    $_SESSION['facebook_access_token'] = array();
    
    $email = $app->request->post('email');
    $user = DB::queryFirstRow("SELECT * FROM users WHERE email=%s", $email);
    if (!$user) {
        $log->debug(sprintf("User failed for email %s from IP %s", $email, $_SERVER['REMOTE_ADDR']));
        $app->render('forgot_password.html.twig', array('loginFailed' => TRUE));
    } else {
        //FIXME: reasearch f it's unique
        $token = bin2hex(openssl_random_pseudo_bytes(16));
        $to = $user['email'];
        //echo "your email is ::".$email;
        //Details for sending E-mail
        $from = "FastFood Online";
        $url = "http://fastfood-online.ipd8.info/";
        $body = "FastFood-online password recovery Script\r\n
		-----------------------------------------------
		Url : $url\r\n;
		Email Details : $to\r\n;
		Change Password : <a href=\"http://fastfood-online.ipd8.info/resetPassword/$token\">Click to Change Password<a>\r\n;
		Sincerely,
		FastFood-Online";
        $from = "sales@fastfood-online.ipd8.info";
        $subject = "Fastfood-online reset token";
        $headers1 = "From: $from\n";
        $headers1 .= "Content-type: text/html;charset=utf-8\r\n";
        $headers1 .= "X-Priority: 1\r\n";
        $headers1 .= "X-MSMail-Priority: High\r\n";
        $headers1 .= "X-Mailer: Just My Server\r\n";
        try{
        $sentmail = mail($to, $subject, $body, $headers1);
         if ($sentmail) {
        try {
            DB::startTransaction();
            //FIXME: update or insert
            //check if an use has already a reset token
            $result = DB::queryOneField('userID', "SELECT * FROM resettokens WHERE userID=%d", $user['ID']);
            if (!empty($result)) {
                DB::update('resettokens', array(
                    'resetToken' => $token), 'userID', $user['ID']);
            } else {
                DB::insert('resettokens', array(
                    'resettoken' => $token,
                    'userID' => $user['ID']
                ));
            }

            DB::update('users', array(
                'locked' => TRUE,), 'ID = %d', $user['ID']);

            DB::commit();
            $log->debug(sprintf("Reset token for user id %s", $userID));
            $app->render('email_success.html.twig');
        } catch (Exception $e) {
            DB::rollback();
            $log->debug(sprintf("Could not Reset token for user id %s. Error: %s", $user['ID'], $e));
            $app->render('forgot_password.html.twig', array('failedEmail' => TRUE));
        }
    } else {
        $log->error(sprintf("Could not send email for user id %s.", $user['ID'], $e));
        $app->render('forgot_password.html.twig', array('failedEmail' => TRUE));
    }
        } catch (Exception $ex){
            echo 'Errror connecting to tha mail server';
        }
    }
        //If the message is sent successfully, display sucess message otherwise display an error message.
    
});
$app->get('/resetPassword/:token', function($token) use ($app, $log) {
    $app->render('reset_password.html.twig', array('resetToken' => $token));
});
$app->post('/resetPassword', function() use ($app, $log) {
    $pass1 = $app->request->post('pass1');
    $pass2 = $app->request->post('pass2');
    $resetToken = $app->request->post('resetToken');

    // submission received - verify
    $errorList = array("en" => array(), "fr" => array());

    if (!preg_match('/[0-9;\'".,<>`~|!@#$%^&*()_+=-]/', $pass1) || (!preg_match('/[a-z]/', $pass1)) || (!preg_match('/[A-Z]/', $pass1)) || (strlen($pass1) < 8)) {
        array_push($errorList["en"], "Password must be at least 8 characters " .
                "long, contain at least one upper case, one lower case, " .
                " one digit or special character");
        array_push($errorList["fr"], "Mot de passe doit être d'au moins 8 caractères, contenir au moins une majuscule, une minuscule,un chiffre ou un caractère spécial");
    } else if ($pass1 != $pass2) {
        array_push($errorList["en"], "Passwords don't match");
        array_push($errorList["fr"], "Les mots de passe ne coincident pas");
    }
    //
    if ($errorList["en"] || $errorList["fr"]) {
        // STATE 3: submission failed        
        $app->render('reset_password.html.twig', array(
            'errorList' => $errorList[$_COOKIE['lang']]
        ));
    } else {
        // STATE 2: submission successful
        try {
            DB::startTransaction();
            $userID = DB::queryOneField('userID', "SELECT * FROM resetTokens WHERE resetToken=%s", $resetToken);
            if (empty($userID)) {
                $log->error(sprintf("Attempt to reset password for an invalid token from IP %s", $_SERVER['REMOTE_ADDR']));
                $app->render('reset_error.html.twig');
            } else {
                DB::delete('resetTokens', 'resetToken =%s', $resetToken);
                DB::update('users', array(
                    'locked' => FALSE, 'password' => password_hash($pass1, CRYPT_BLOWFISH)), 'ID = %d', $userID);
                DB::commit();
                $log->debug(sprintf("Reset token for user id %s", $userID));
                $app->render('password_success.html.twig');
            }
        } catch (Exception $e) {
            DB::rollback();
            $log->debug(sprintf("Could not Reset token for user id %s. Error: %s", $user['ID'], $e));
            $app->render('forgot_password.html.twig', array('failedEmail' => TRUE));
        }
    };
});

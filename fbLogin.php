<?php

require_once 'vendor/autoload.php';
session_start();

//facebook login
$fb = new Facebook\Facebook([
  'app_id' => '881440665321233',
  'app_secret' => '67f11e93f3dab0dd13e91f61d85e9f4a',
  'default_graph_version' => 'v2.5',
]);


$helper = $fb->getRedirectLoginHelper();
$permissions = ['email', 'user_likes']; // optional
$loginUrl = $helper->getLoginUrl('http://fastfood-online.ipd8.info/fblogin-callback.php', $permissions);

echo '<a href="' . $loginUrl . '">Log in with Facebook!</a>';

//The FacebookRedirectLoginHelper makes use of sessions to store a CSRF value. You 
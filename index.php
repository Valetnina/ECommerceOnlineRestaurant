<?php

require_once 'vendor/autoload.php';
session_start();

//require_once 'fbauth.php';

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
//Internationlization
use Symfony\Bridge\Twig\Extension\TranslationExtension;
use Symfony\Component\Translation\Loader\PhpFileLoader;
use Symfony\Component\Translation\MessageSelector;
use Symfony\Component\Translation\Translator;

// create a log channel
$log = new Logger('main');
$log->pushHandler(new StreamHandler('logs/everything.log', Logger::DEBUG));
$log->pushHandler(new StreamHandler('logs/errors.log', Logger::ERROR));

//Define Constants
define("ROWSPERPAGE", 5);
define("TAX", 0.15);
$totalPages = 0;
//DB::$dbName = 'cp4724_fastfood-online';
//DB::$user = 'cp4724_fastfood';
//DB::$password = '[^)EJ;Fw%402';
DB::$dbName = 'ecommerce';
DB::$user = 'root';
DB::$password = '';
//DB::$host = 'localhost:3333'; // sometimes needed on Mac OSX

DB::$encoding = 'utf8'; // defaults to latin1 if omitted
DB::$error_handler = 'sql_error_handler';
DB::$nonsql_error_handler = 'nonsql_error_handler';

function nonsql_error_handler($params) {
    global $app, $log;
    $log->error("Database error: " . $params['error']);
    http_response_code(500);
    header('content-type: application/json');
    echo json_encode("Internal server error");
    die;
}

function sql_error_handler($params) {
    global $app, $log;
    $log->error("SQL error: " . $params['error']);
    $log->error(" in query: " . $params['query']);
    http_response_code(500);
    //header('content-type: application/json');
    echo json_encode("Internal server error");
    die; // don't want to keep going if a query broke
}

$app = new \Slim\Slim(array(
    'view' => new \Slim\Views\Twig()
        ));

$view = $app->view();

$view->parserOptions = array(
    'debug' => true,
    'cache' => dirname(__FILE__) . '/cache'
);
$view->setTemplatesDirectory(dirname(__FILE__) . '/templates');


//sessions and Cookies
//$helper = $fb->getRedirectLoginHelper();
//$permissions = ['public_profile', 'email', 'user_location']; // optional
//
//$loginUrl = $helper->getLoginUrl('http://fastfood-online.ipd8.info/fblogin-callback.php', $permissions);
//$logoutUrl = $helper->getLoginUrl('http://fastfood-online.ipd8.info/fblogout-callback.php', $permissions);

if (!isset($_SESSION['user'])) {
    $_SESSION['user'] = array();
}
if (!isset($_SESSION['facebook_access_token'])) {
    $_SESSION['facebook_access_token'] = array();
}


if (!isset($_GET['lang'])) {
    if (isset($_COOKIE['lang'])) {
        $lang = $_COOKIE['lang'];
    } else {
        $lang = 'en';
    }
} else {
    $lang = (string) $_GET['lang'];
    if ($lang == 'en' || $lang == 'fr') {
        setcookie('lang', $lang, time() + 60 * 60 * 24 * 30);
    } else {
        setcookie('lang', "en", time() + 60 * 60 * 24 * 30);
    }
}
// First param is the "default language" to use.
$translator = new Translator($_COOKIE['lang'], new MessageSelector());
// Set a fallback language incase you don't have a translation in the default language
$translator->setFallbackLocales(['en']);
// Add a loader that will get the php files we are going to store our translations in
$translator->addLoader('php', new PhpFileLoader());
// Add language files here

$translator->addResource('php', './lang/fr_CA.php', 'fr'); // French
$translator->addResource('php', './lang/en_US.php', 'en'); // English
// Add the parserextensions TwigExtension and TranslationExtension to the view
$view->parserExtensions = array(
    new \Slim\Views\TwigExtension(),
    new TranslationExtension($translator)
);
$twig = $app->view()->getEnvironment();
//$view = new Twig_Environment($app);
//$twig->addGlobal('fbUser', $_SESSION['facebook_access_token']);
$twig->addGlobal('user', $_SESSION['user']);
//$twig->addGlobal('loginUrl', $loginUrl);
//////
//FIXME: VAlidate all parameters
\Slim\Route::setDefaultConditions(array(
    'ID' => '\d+',
    'slug' => '[A-Za-z0-9-]+'
));

//$app->response->headers->set('content-type', 'application/json');
//Handler for the home page
//
//
//FIXME the change of the COOKIe doesn't reflect on the same page, so for the root I pass the lang direclty. Ask teacher if it's OK
$app->get('/', function() use ($app, $lang, $log) {
    //if a fb user than register information in fbUsers table
    if ($_SESSION['facebook_access_token']) {
        //FIXME: ask if I should validate user data before registration
        try {
            //FIXME add update too to fbUser
            //DB::queryFirstRow('', )
            DB::insert('users', array(
                'fbID' => $_SESSION['facebook_access_token']['ID'],
            ));
        } catch (Exception $ex) {
            //FIXME: ask what should happen if a fb uSer could not be registered
            $log->debug("Failed to register fbUsere %d", $_SESSION['facebook_access_token']['ID']);
            $_SESSION['facebook_access_token'] = null;
            $app->render('fblogin_failed.html.twig');
        }
    }

    //print_r($_COOKIE);
    $categoryList = DB::query('SELECT * FROM productcategory WHERE lang=%s', $_COOKIE['lang']);
    //  echo "you are logged ing as:".$fbUser;

    $app->render('index.html.twig', array(
        'categoryList' => $categoryList));
});

//Ajax -> refresh products by filter
$app->get('/category/:categoryID/:isVeget', function($categoryID, $isVeget) use ($app) {
    if ($isVeget == 1) {
        $prodList = DB::query('SELECT products.ID, name, description, price, picture '
                        . 'FROM products, products_i18n '
                        . 'WHERE products.ID = products_i18n.productID AND '
                        . 'lang=%s AND '
                        . 'isVegetarian = %d AND '
                        . 'productCategoryID = %d', $_COOKIE['lang'], $isVeget, $categoryID);
    } else {
        $prodList = DB::query('SELECT products.ID, name, description, price, picture '
                        . 'FROM products, products_i18n '
                        . 'WHERE products.ID = products_i18n.productID AND '
                        . 'lang=%s AND '
                        . 'productCategoryID = %d', $_COOKIE['lang'], $categoryID);
    }


    foreach ($prodList as &$product) {
        $product['picture'] = base64_encode($product['picture']);
        $ID = $product['ID'];

       /* $reviewsList = DB::queryFirstRow('SELECT sum(rating) as sumRating, count(review) as totalReviews FROM ratingsreviews WHERE productID=%d ORDER BY productID', $ID);
        foreach ($reviewsList as $revProduct) {
            $totalReviews = $revProduct['totalReviews'];
            $stars = round($revProduct['sumRating'] / $totalReviews);
        }*/
    }




    //print_r($prodList);
    $app->render('index-products.html.twig', array('prodList' => $prodList));
});

require_once 'product.php';
require_once 'cart.php';
require_once 'login.php';
require_once 'register.php';
require_once 'resetPassword.php';
require_once 'admin.php';



/*
  function getAuthUserID(){
  global $app, $log;
  $username = $app->request->headers("PHP_AUTH_USER");
  $password = $app->request->headers("PHP_AUTH_PW");
  if($username && $password){
  $row = DB::queryFirstRow("SELECT * FROM users WHERE email=%s", $username);
  if($row && $row['password'] == $password){
  return $row['ID'];
  }
  }
  $log->debug("BASIC aut failed for user ".$username);
  $app->response->status(401);//Access denied authentification requiered
  $app->response->header('WWW-Authenticate', "Basic realm=TodoApp");
  return FALSE;
  }
  $app->get('/todoitems', function() {
  $userID = getAuthUserID();
  if(!$userID) return;
  $recordList = DB::query("SELECT * FROM todoitems WHERE userID=%d", $userID);
  echo json_encode($recordList, JSON_PRETTY_PRINT);
  });

  $app->get('/todoitems/:ID', function($ID) use ($app) {
  $record = DB::queryFirstRow("SELECT * FROM todoitems WHERE ID=%d", $ID);
  // 404 if record not found
  if (!$record) {
  $app->response->setStatus(404);
  echo json_encode("Record not found");
  return;
  }
  echo json_encode($record, JSON_PRETTY_PRINT);
  });

  $app->delete('/todoitems/:ID', function($ID) {
  DB::delete('todoitems', "ID=%d", $ID);
  echo 'true';
  });
  $app->post('/todoitems', function() use ($app, $log) {
  $body = $app->request->getBody();
  $record = json_decode($body, TRUE);
  if (!isTodoItemValid($record, $error)) {

  $log->debug("Failed POST . Invalid data. ".$error);

  $app->response->setStatus(400);
  echo json_encode($error);
  return;
  }
  DB::insert('todoitems', $record);
  echo DB::insertId();
  // POST / INSERT is special - returns 201
  $app->response->setStatus(201);
  });

  $app->put('/todoitems/:ID', function($ID) use ($app, $log) {
  $body = $app->request->getBody();
  $record = json_decode($body, TRUE);
  $record['ID'] = $ID; // prevent changing of ID
  if (!isTodoItemValid($record, $error)) {
  $app->response->setStatus(400);
  $log->debug("Failed PUT . Invalid data" . $error);
  echo json_encode($error);
  return;
  }
  DB::update('todoitems', $record, "ID=%d", $ID);
  echo json_encode(TRUE); // same as: echo 'true';
  });
 */

$app->run();

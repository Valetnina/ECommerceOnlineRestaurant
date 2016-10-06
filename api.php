<?php

require_once 'vendor/autoload.php';

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

//DB::$dbName = 'cp4724_fastfood';
//DB::$user = 'cp4724_fastfood-online';
//DB::$password = 'X]&}^5{TL$)t';
//DB::$host = 'www.ipd8.info'; // sometimes needed on Mac OSX
DB::$dbName = 'ecommerce';
DB::$user = 'root';
DB::$password = '';
DB::$host = 'localhost:3333'; // sometimes needed on Mac OSX


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
    header('content-type: application/json');
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



$lang = "en";
if(isset($_GET['lang'])){
   $lang = $_GET['lang'];
 }
 

// First param is the "default language" to use.
$translator = new Translator($lang, new MessageSelector());
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


////////

\Slim\Route::setDefaultConditions(array(
    'ID' => '\d+'
));



//$app->response->headers->set('content-type', 'application/json');



$app->get('/', function() use ($app) {
    $categoryList = DB::query('SELECT * FROM productcategory');

    $prodList = DB::query('SELECT * FROM products');

    foreach ($prodList as &$product) {
        $ID = $product['ID'];
        $reviewsAverage = DB::queryFirstRow('SELECT AVG(rating) as average FROM ratingsreviews WHERE productID=%d', $ID);
        $product['average'] = $reviewsAverage['average'];
        $product['picture'] = base64_encode($product['picture']);
    }
    
    

    $app->render('index.html.twig', array('prodList' => $prodList,
        'categoryList' => $categoryList));
    //$app->render('index.html.twig');
});

$app->get('/', function() use ($app) {
    $categoryList = DB::query('SELECT * FROM productcategory');

    $prodList = DB::query('SELECT * FROM products');

    foreach ($prodList as &$product) {
        $ID = $product['ID'];
        $reviewsAverage = DB::queryFirstRow('SELECT AVG(rating) as average FROM ratingsreviews WHERE productID=%d', $ID);
        $product['average'] = $reviewsAverage['average'];
        $product['picture'] = base64_encode($product['picture']);
    }
    
    

    $app->render('index.html.twig', array('prodList' => $prodList,
        'categoryList' => $categoryList));
    //$app->render('index.html.twig');
});


$app->get('/cart', function() use ($app) {
//$app->get('/lang', function($lang) use ($app) {
//$testList = DB::query('SELECT * FROM users');
//$app->render('index.html.twig', array('testList' => $testList));
$app->render('cart_view.html.twig');
});



$app->get('/product/:ID', function($ID) use ($app, $lang) {
    $lang = "en";
    $productRecord = DB::queryFirstRow("SELECT products.ID, price, picture, nutritionalValue, name, description FROM products, products_i18n WHERE  products_i18n.productID = products.ID AND lang='en' AND products.ID=2", $lang, $ID);
   
    $productRecord['picture'] = base64_encode( $productRecord['picture']);
    
    $rowsNum = 5;
    $pageNum = 1;
    $start = ((int)$pageNum - 1) * $rowsNum;
    

    $reviewList = DB::query('SELECT ratingsreviews.ID, productID, '
            . 'date, review, rating, firstName FROM ratingsreviews,'
            . ' users WHERE ratingsreviews.customerID = users.ID'
            . ' AND productID=%d ORDER BY ratingsreviews.ID DESC '
            . 'LIMIT %d, %d', $ID, $start, $rowsNum);
    $reviewCount = DB::count();
    $reviewCountUpdated = $reviewCount;

    $ratingSum = 0;
    foreach ($reviewList as &$value) {
        $now =  new DateTime('now');
        $value['daysCount'] = $now->diff(new DateTime($value['date']))->format("%a")-1;
        if($value['rating'] == 0){
            $reviewCountUpdated --;
            continue;
        }
        $ratingSum += $value['rating'];
    }
    $ratingAverage = round($ratingSum / $reviewCountUpdated);
    
    
    $app->render('product_view.html.twig', array(
        'product' => $productRecord,
        'reviewList' => $reviewList,
        'reviewCount' => $reviewCount,
        'ratingAverage' => $ratingAverage
    ));
});
//FIXME: ask if it's a good idea
$app->get('/productComment/:ID', function($ID) use ($app) {
//  $record = DB::queryFirstRow("SELECT * FROM todoitems WHERE ID=%d", $ID);
//  // 404 if record not found
//  if (!$record) {
//  $app->response->setStatus(404);
//  echo json_encode("Record not found");
//  return;
//  }
    $reviewList = DB::query('SELECT ID, productID, customerID, date, review, rating FROM ratingsreviews WHERE productID=%d ORDER BY ID DESC ', $ID);
    $reviewCount = DB::count();
    if(!$reviewList){
        echo "Hello";
    }else {
        echo "dsdas";
    }
     print_r($reviewList);
    $reviewCountUpdated = $reviewCount;

    $ratingSum = 0;
    foreach ($reviewList as $value) {
         if($value['rating'] == 0){
            $reviewCountUpdated --;
            continue;
        }
        $ratingSum += $value['rating'];
    }
    $ratingAverage = round($ratingSum / $reviewCountUpdated);
    print_r($reviewList);
  echo json_encode(array('reviewCount' => $reviewCount, 'ratingAverage' => $ratingAverage, 'reviewList' => $reviewList), JSON_PRETTY_PRINT);
  });
  
  
 $app->post('/product/:ID', function() use ($app, $log) {
  $body = $app->request->getBody();
  $record = json_decode($body, TRUE);
  //FIXME ADD validation
//  if (!isTodoItemValid($record, $error)) {
//
//  $log->debug("Failed POST . Invalid data. ".$error);
//
//  $app->response->setStatus(400);
//  echo json_encode($error);
//  return;
//  }
  DB::insert('ratingsreviews', $record);
  echo DB::insertId();
  // POST / INSERT is special - returns 201
  $app->response->setStatus(201);
  });

/*

  function isTodoItemValid($todo, &$error, $skipID='false') {

  if (!isset($todo['ID'])) {

  if(count($todo) != ($skipID ? 3 : 4)){
  $error = 'Invalid number of fields in data provided';
  return FALSE;
  }
  if(!$skipID){
  if(!isset($todo['ID']) || (!is_numeric($todo['ID']))){
  $error = 'ID is not provided or it is not numeric';
  return FALSE;
  }
  }
  if (!isset($todo['title']) || !isset($todo['dueDate']) || !isset($todo['isDone'])) {
  $error = 'The passed fields do not correspond to the expected list';

  return FALSE;
  }
  if (strlen($todo['title']) < 1 || strlen($todo['title']) > 100) {
  $error = 'Title is not valid';
  return FALSE;
  }
  if (!in_array($todo['isDone'], array('true', 'false'))) {
  $error = 'isDone is not true nor false';
  return FALSE;
  }
  $f = 'Y-m-d';
  $tempDate = explode('-', $todo['dueDate']);
  if (count($tempDate) != 3) {
  $error = 'dueDate is not in the correct format';
  return FALSE;
  } elseif (!checkdate($tempDate[1], $tempDate[2], $tempDate[0])
  || date($todo['dueDate'], $f) < date('2000-01-01', $f)
  || date($todo['dueDate'], $f) > date('2099-01-01', $f)) {
  $error = 'dueDate could not be parsed into a valid date between 2000-01-01 and 2099-01-01';
  return FALSE;
  }
  }
  return TRUE;
  }
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

  

  $app->delete('/todoitems/:ID', function($ID) {
  DB::delete('todoitems', "ID=%d", $ID);
  echo 'true';
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

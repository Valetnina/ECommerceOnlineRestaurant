<?php

require_once 'vendor/autoload.php';
session_start();

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
$totalPages = 1;
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
if (isset($_GET['lang'])) {
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



//////
//FIXME: VAlidate all parameters
\Slim\Route::setDefaultConditions(array(
    'ID' => '\d+',
    'slug' => '[A-Za-z0-9-]+'
));



//$app->response->headers->set('content-type', 'application/json');

$app->get('/', function() use ($app) {
    $lang = "fr";
    $categoryList = DB::query('SELECT * FROM productcategory WHERE lang=%s', $lang);
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

$app->get('/lang', function($lang) use ($app) {
    $productList = DB::query('SELECT * FROM products');


    $app->render('index.html.twig', array('productList' => $productList
    ));
});

$app->get('/category/:categoryID', function($categoryID) use ($app) {

    $prodList = DB::query('SELECT * FROM products WHERE productCategoryID = %d', $categoryID);

    if ($prodList) {
        foreach ($prodList as &$product) {
            $ID = $product['ID'];
            $reviewsAverage = DB::queryFirstRow('SELECT AVG(rating) as average FROM ratingsreviews WHERE productID=%d', $ID);
            $product['average'] = $reviewsAverage['average'];
            $product['picture'] = base64_encode($product['picture']);
        }
    } else {
        //log ("");
    }
    $app->render('index-products.html.twig', array('prodList' => $prodList));
});

$app->get('/reviews/product/:ID/page/:pageNum', function($ID, $pageNum) use ($app) {
    $start = ((int) $pageNum - 1) * ROWSPERPAGE;

    $reviewList = DB::query('SELECT ratingsreviews.ID, productID, '
                    . 'date, review, rating, firstName FROM ratingsreviews,'
                    . ' users WHERE ratingsreviews.customerID = users.ID'
                    . ' AND productID=%d ORDER BY ratingsreviews.ID DESC '
                    . 'LIMIT %d, %d', $ID, $start, ROWSPERPAGE);
    $reviewCount = DB::count();
    $reviewCountUpdated = $reviewCount;

    $ratingSum = 0;
    foreach ($reviewList as &$value) {
        $now = new DateTime('now');
        $value['daysCount'] = $now->diff(new DateTime($value['date']))->format("%a") - 1;
        if ($value['rating'] == 0) {
            $reviewCountUpdated --;
            continue;
        }
        $ratingSum += $value['rating'];
    }
    $ratingAverage = round($ratingSum / $reviewCountUpdated);

    $app->render('reviews.html.twig', array(
        'reviewList' => $reviewList,
        'reviewCount' => $reviewCount,
        'ratingAverage' => $ratingAverage,
    ));
});


$app->get('/product/:ID', function($ID) use ($app, $lang) {
    global $totalPages;
    $productRecord = DB::queryFirstRow("SELECT products.ID, price, picture,"
                    . " nutritionalValue, name, description FROM products, "
                    . "products_i18n WHERE  products_i18n.productID = products.ID AND lang=%s AND products.ID=%d", $lang, $ID);
    $productRecord['picture'] = base64_encode($productRecord['picture']);


    //FIXME: HOW TO UPDATE global variable from within callback function
    $reviewList = DB::query('SELECT ratingsreviews.ID, productID, '
                    . 'date, review, rating, firstName FROM ratingsreviews,'
                    . ' users WHERE ratingsreviews.customerID = users.ID'
                    . ' AND productID=%d', $ID);
    $reviewCount = DB::count();
    $totalPages = ceil($reviewCount / ROWSPERPAGE);

    echo "Helo zasdasdas" . $totalPages;
    $app->render('product_view.html.twig', array(
        'product' => $productRecord,
        'totalPages' => $totalPages
    ));
});

$app->get('/rating/:ID', function($ID) use ($app, $lang, &$totalPages) {
    //global $totalPages;
    $reviewList = DB::query('SELECT ratingsreviews.ID, productID, '
                    . 'date, review, rating, firstName FROM ratingsreviews,'
                    . ' users WHERE ratingsreviews.customerID = users.ID'
                    . ' AND productID=%d', $ID);
    $reviewCount = DB::count();
    $reviewCountUpdated = $reviewCount;
    $totalPages = ceil($reviewCount / ROWSPERPAGE);
    $ratingSum = 0;
    foreach ($reviewList as &$value) {
        if ($value['rating'] == 0) {
            $reviewCountUpdated --;
            continue;
        }
        $ratingSum += $value['rating'];
    }
    $ratingAverage = round($ratingSum / $reviewCountUpdated);

    $app->render('rating.html.twig', array(
        'reviewCount' => $reviewCount,
        'ratingAverage' => $ratingAverage,
    ));
});

$app->post('/reviews/product/:ID', function($ID) use ($app, $log) {
    $body = $app->request->getBody();
    $record = json_decode($body, TRUE);
    if (!isReviewPostValid($record, $error)) {

        $log->debug("Failed POST . Invalid data. " . $error);

        $app->response->setStatus(400);
        echo json_encode($error);
        return;
    }
    DB::insert('ratingsreviews', $record);
    echo DB::insertId();
    // POST / INSERT is special - returns 201
    $app->response->setStatus(201);
});

function isReviewPostValid($review, &$error) {

    if (count($review) != 5) {
        $error = 'Invalid number of fields in data provided';
        return FALSE;
    }
    if (!isset($review['productID']) || (!is_numeric($review['productID']))) {
        $error = 'Product ID is not provided or it is not numeric';
        return FALSE;
    }
    if (!isset($review['customerID']) || (!is_numeric($review['customerID']))) {
        $error = 'Customer ID is not provided or it is not numeric';
        return FALSE;
    }
    if (strlen($review['review']) < 1 || strlen($review['review']) > 500) {
        $error = 'Review text is not valid';
        return FALSE;
    }
    if (!in_array($review['rating'], array("1", "2", "3", "4", "5", "0"), true)) {
        $error = 'Rating number of stars is invalid';
        return FALSE;
    }
    $date = DateTime::createFromFormat('Y-m-d H:i:s', $review['date']);
    if (!$date) {
        $error = 'Date is not in the correct format';
        return FALSE;
    }
    return TRUE;
}
$app->map('/cart', function() use ($app, $lang) {
    // handle incoming post, if there is one
    // either add item to cart or change its quantity
    if ($app->request()->post()) {
        $productID = $app->request()->post('productID');
        $quantity = $app->request()->post('quantity');
        $item = DB::queryFirstRow("SELECT * FROM cartItems WHERE sessionID=%s AND productID=%d", session_id(), $productID);
        if ($item) { // add quantity to existing item
            DB::update('cartItems', array('quantity' => $item['quantity'] + $quantity), 'ID=%i', $item['ID']);
        } else { // create new item in the cart
            DB::insert('cartItems', array(
                'sessionID' => session_id(),
                'productID' => $productID,
                'quantity' => $quantity
            ));
        }
    }
    // display cart's content
    $cartItems = DB::query(
                    "SELECT cartItems.ID, name, price, quantity, picture "
                    . "FROM cartItems, products, products_i18n "
                    . "WHERE products.ID = products_i18n.productID AND products.ID = cartItems.productID AND sessionID=%s AND lang=%s", session_id(), $lang);
    $cartTotal = 0;
    foreach ($cartItems as &$item) {
        $item['picture'] = base64_encode($item['picture']);
        $item['total'] = ($item['quantity'] * $item['price']);
        $cartTotal += $item['total'];
    }
    $cartTax = TAX * $cartTotal;
    $cartTotalToPay = $cartTax + $cartTotal ;
    
    $app->render('cart_view.html.twig', array(
        'cartItems' => $cartItems,
        'cartTotal' => $cartTotal,
        'cartTax' => $cartTax,
        'cartTotalToPay' => $cartTotalToPay,
        ));
})->via('GET', 'POST');

// custom API call - the easy way out
$app->get('/updateCart/:ID/:quantity', function($ID, $quantity) {
    
});

// RESTful
$app->put('/cart/:ID', function($ID) use ($app) {
    $json = $app->request()->getBody();
    $data = json_decode($json, true);
    // only expect 
    if ((count($data) != 1) || (!isset($data['quantity']))) {
        $app->response()->status(400);
        echo json_encode("400: data in body invalid");
        return;
    }
    $quantity = $data['quantity'];
    if ($quantity < 0) {
        $app->response()->status(400);
        echo json_encode("400: quantity invalid");
        return;
    }
    DB::update('cartItems', array('quantity' => $quantity), "ID=%i AND sessionID=%s", $ID, session_id());
    echo json_encode(DB::affectedRows() == 1);
});


// FUTURE WORK
$app->delete('/cartItems/:ID', function($ID) use ($app) {
    
});



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

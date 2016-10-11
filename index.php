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

//facebook login
$fb = new Facebook\Facebook([
    'app_id' => '881440665321233',
    'app_secret' => '67f11e93f3dab0dd13e91f61d85e9f4a',
    'default_graph_version' => 'v2.5',
        ]);

//$lang = "en";
//
//if (isset($_GET['lang'])) {
//    $lang = $_GET['lang'];
//}

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
        //FIXME: if it's the first time, it throws an error,
        $lang = $_COOKIE['lang'];
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



//////
//FIXME: VAlidate all parameters
\Slim\Route::setDefaultConditions(array(
    'ID' => '\d+',
    'slug' => '[A-Za-z0-9-]+'
));



//$app->response->headers->set('content-type', 'application/json');

if (!isset($_SESSION['user'])) {
    $_SESSION['user'] = array();
}
$app->get('/emailexists/:email', function($email) use ($app, $log) {
    $user = DB::queryFirstRow("SELECT * FROM users WHERE email=%s", $email);
    if ($user) {
        echo "Email already registered";
    }
});

// State 1: first show
$app->get('/register', function() use ($app, $log) {
    $app->render('register.html.twig');
});
// State 2: submission
$app->post('/register', function() use ($app, $log) {
    $name = $app->request->post('name');
    $email = $app->request->post('email');
    $pass1 = $app->request->post('pass1');
    $pass2 = $app->request->post('pass2');
    $valueList = array('name' => $name, 'email' => $email);
    // submission received - verify
    $errorList = array();
    if (strlen($name) < 4) {
        array_push($errorList, "Name must be at least 4 characters long");
        unset($valueList['name']);
    }
    if (filter_var($email, FILTER_VALIDATE_EMAIL) === FALSE) {
        array_push($errorList, "Email does not look like a valid email");
        unset($valueList['email']);
    } else {
        $user = DB::queryFirstRow("SELECT ID FROM users WHERE email=%s", $email);
        if ($user) {
            array_push($errorList, "Email already registered");
            unset($valueList['email']);
        }
    }
    if (!preg_match('/[0-9;\'".,<>`~|!@#$%^&*()_+=-]/', $pass1) || (!preg_match('/[a-z]/', $pass1)) || (!preg_match('/[A-Z]/', $pass1)) || (strlen($pass1) < 8)) {
        array_push($errorList, "Password must be at least 8 characters " .
                "long, contain at least one upper case, one lower case, " .
                " one digit or special character");
    } else if ($pass1 != $pass2) {
        array_push($errorList, "Passwords don't match");
    }
    //
    if ($errorList) {
        // STATE 3: submission failed
        $app->render('register.html.twig', array(
            'errorList' => $errorList, 'v' => $valueList
        ));
    } else {
        // STATE 2: submission successful
        DB::insert('users', array(
            'name' => $name, 'email' => $email,
            'password' => password_hash($pass1, CRYPT_BLOWFISH)
                // 'password' => hash('sha256', $pass1)
        ));
        $id = DB::insertId();
        $log->debug(sprintf("User %s created", $id));
        $app->render('register_success.html.twig');
    }
});

// State 1: first show
$app->get('/login', function() use ($app, $log) {
    $app->render('login.html.twig');
});
// State 2: submission
$app->post('/login', function() use ($app, $log) {
    $email = $app->request->post('email');
    $pass = $app->request->post('pass');
    $user = DB::queryFirstRow("SELECT * FROM users WHERE email=%s", $email);
    if (!$user) {
        $log->debug(sprintf("User failed for email %s from IP %s", $email, $_SERVER['REMOTE_ADDR']));
        $app->render('login.html.twig', array('loginFailed' => TRUE));
    } else {
        // password MUST be compared in PHP because SQL is case-insenstive
        //if ($user['password'] == hash('sha256', $pass)) {
        if (password_verify($pass, $user['password'])) {
            // LOGIN successful
            unset($user['password']);
            $_SESSION['user'] = $user;
            $log->debug(sprintf("User %s logged in successfuly from IP %s", $user['ID'], $_SERVER['REMOTE_ADDR']));
            $app->render('login_success.html.twig');
        } else {
            $log->debug(sprintf("User failed for email %s from IP %s", $email, $_SERVER['REMOTE_ADDR']));
            $app->render('login.html.twig', array('loginFailed' => TRUE));
        }
    }
});

$app->get('/logout', function() use ($app, $log) {
    $_SESSION['user'] = array();
    $app->render('logout_success.html.twig');
});

//Handler for the home page
//FIXME the change of the COOKIe doesn't reflect on the same page, so for the root I pass the lang direclty. Ask teacher if it's OK
///////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////OLGA/////////////////////////////
///////////////////////////////////////////////////////////////////////////
$app->get('/', function() use ($app, $lang) {
    $categoryList = DB::query('SELECT * FROM productcategory WHERE lang=%s', $lang);

    $app->render('index.html.twig', array(
        'categoryList' => $categoryList));
});

//Ajax -> refresh products by filter
$app->get('/category/:categoryID', function($categoryID) use ($app) {
    $prodList = DB::query('SELECT products.ID as productID, name, description, price, picture FROM products, products_i18n WHERE lang=%s AND products.ID = products_i18n.productID', $_COOKIE['lang']);

    foreach ($prodList as &$product) {
        $ID = $product['productID'];
        $reviewsAverage = DB::queryFirstRow('SELECT AVG(rating) as average FROM ratingsreviews WHERE productID=%d', $ID);
        $product['average'] = round($reviewsAverage['average']);
        $product['picture'] = base64_encode($product['picture']);
    }
    $app->render('index-products.html.twig', array('prodList' => $prodList));
});




//$fileUpload = $_FILES['fileToUpload'];

///////////////////////////////////////////////////////////////////////////
//////////////////////////////////END  OLGA/////////////////////////////
///////////////////////////////////////////////////////////////////////////
// Handling the product_view page
// First show of the product with static content
$app->get('/product/:ID', function($ID) use ($app) {
    $productRecord = DB::queryFirstRow("SELECT products.ID, price, picture,"
                    . " nutritionalValue, name, description FROM products, "
                    . "products_i18n WHERE  products_i18n.productID = products.ID AND lang=%s AND products.ID=%d", $_COOKIE['lang'], $ID);
    $productRecord['picture'] = base64_encode($productRecord['picture']);


    //FIXME: HOW TO UPDATE global variable from within callback function
    /* $reviewList = DB::query('SELECT ratingsreviews.ID, productID, '
      . 'date, review, rating, firstName FROM ratingsreviews,'
      . ' users WHERE ratingsreviews.customerID = users.ID'
      . ' AND productID=%d', $ID);
      $reviewCount = DB::count();
      $totalPages = ceil($reviewCount / ROWSPERPAGE);
     */
    $app->render('product_view.html.twig', array(
        'product' => $productRecord,
            // 'totalPages' => $totalPages
    ));
});


//handle the ajax -> changing pages in reviews
$app->get('/reviews/product/:ID/page/:pageNum', function($ID, $pageNum) use ($app) {
    $start = ((int) $pageNum - 1) * ROWSPERPAGE;

    $reviewList = DB::query('SELECT ratingsreviews.ID, productID, '
                    . 'date, review, rating, firstName FROM ratingsreviews,'
                    . ' users WHERE ratingsreviews.customerID = users.ID'
                    . ' AND productID=%d ORDER BY ratingsreviews.ID DESC '
                    . 'LIMIT %d, %d', $ID, $start, ROWSPERPAGE);

    foreach ($reviewList as &$value) {
        $now = new DateTime('now');
        $value['daysCount'] = $now->diff(new DateTime($value['date']))->format("%a") - 1;
    }

    //\FIXME: Probably not a good idea => Get the total Number of available pages to prevent requesting a page that does not exist
    $reviewList = DB::query('SELECT ratingsreviews.ID, productID, '
                    . 'date, review, rating, firstName FROM ratingsreviews,'
                    . ' users WHERE ratingsreviews.customerID = users.ID'
                    . ' AND productID=%d', $ID);
    $reviewCount = DB::count();
    $totalPages = ceil($reviewCount / ROWSPERPAGE);
    $app->render('reviews.html.twig', array(
        'reviewList' => $reviewList,
        'page' => $pageNum,
        'totalPages' => $totalPages
    ));
});


//ajax=> refresh the average rating and number of comments for a products
$app->get('/rating/:ID', function($ID) use ($app) {
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
// Add a new review
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

//Handling of the cart page
//get and port /cart
$app->map('/cart', function() use ($app) {
    // handle incoming post, if there is one
    // either add item to cart or change its quantity
    if ($app->request()->post()) {
        $productID = $app->request()->post('productID');
        $quantity = $app->request()->post('quantity');

        $item = DB::queryFirstRow("SELECT * FROM cartItems WHERE sessionID=%s AND productID=%d", session_id(), $productID);
        if ($item) { // add quantity to existing item
            DB::update('cartItems', array('quantity' => $item['quantity'] + $quantity), 'ID=%i', $item['ID']);
        } else { // create new item in the cart
            echo session_id();

            DB::insert('cartItems', array(
                'sessionID' => session_id(),
                'productID' => $productID,
                'quantity' => $quantity
            ));
        }
    }

    //FIXME: SessionID
    // display cart's content
    $cartItems = DB::query(
                    "SELECT cartItems.ID, products.ID as productID, name, price, quantity, picture, nutritionalValue "
                    . "FROM cartItems, products, products_i18n "
                    . "WHERE products.ID = products_i18n.productID AND products.ID = cartItems.productID AND sessionID=%s AND lang=%s", session_id(), $_COOKIE['lang']);
    /*  $cartItems = DB::query(
      "SELECT cartItems.ID, name, price, quantity, picture "
      . "FROM cartItems, products, products_i18n "
      . "WHERE products.ID = products_i18n.productID AND products.ID = cartItems.productID AND sessionID=%s AND lang=%s", '7uuq04khqfo640go5ae6', $_COOKIE['lang']);
     */
    $cartTotal = 0;
    foreach ($cartItems as &$item) {
        $item['picture'] = base64_encode($item['picture']);
        $item['total'] = ($item['quantity'] * $item['price']);
        $cartTotal += $item['total'];
    }
    $cartTax = TAX * $cartTotal;
    $cartTotalToPay = $cartTax + $cartTotal;

    $app->render('cart_view.html.twig', array(
        'cartItems' => $cartItems,
        'cartTotal' => $cartTotal,
        'cartTax' => $cartTax,
        'cartTotalToPay' => $cartTotalToPay,
    ));
})->via('GET', 'POST');

$app->get('/cartUpdate', function() use ($app) {
    // display cart's content
    $cartItems = DB::query(
                    "SELECT cartItems.ID, products.ID as productID, name, price, quantity, picture, nutritionalValue "
                    . "FROM cartItems, products, products_i18n "
                    . "WHERE products.ID = products_i18n.productID AND products.ID = cartItems.productID AND sessionID=%s AND lang=%s", session_id(), $_COOKIE['lang']);
    $cartTotal = 0;
    foreach ($cartItems as &$item) {
        $item['picture'] = base64_encode($item['picture']);
        $item['total'] = ($item['quantity'] * $item['price']);
        $cartTotal += $item['total'];
    }
    $cartTax = TAX * $cartTotal;
    $cartTotalToPay = $cartTax + $cartTotal;
    print_r($cartItems);
    $app->render('cart_view.html.twig', array(
        'cartItems' => $cartItems,
        'cartTotal' => $cartTotal,
        'cartTax' => $cartTax,
        'cartTotalToPay' => $cartTotalToPay,
    ));
});


// RESTful update cart when quantity changed
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


// Delete an item from the cart
$app->delete('/cartItems/:ID', function($ID) use ($app) {
    // only expect
    if (isset($ID)) {
        DB::delete('cartItems', "productID=%i AND sessionID=%s", $ID, session_id());
        echo json_encode(DB::affectedRows() == 1);
    } else {
        echo FALSE;
    }
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

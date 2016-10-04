<?php

require_once 'vendor/autoload.php';

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

// create a log channel
$log = new Logger('main');
$log->pushHandler(new StreamHandler('logs/everything.log', Logger::DEBUG));
$log->pushHandler(new StreamHandler('logs/errors.log', Logger::ERROR));

DB::$dbName = 'cp_4724_fastfood-online';
DB::$user = 'cp_4724_fastfood-online';
DB::$password = '+fR-P!TXFqrT';
DB::$host = 'www.ipd8.info:3306'; // sometimes needed on Mac OSX
DB::$error_handler = 'sql_error_handler';
DB::$nonsql_error_handler = 'nonsql_error_handler';

// FIXME: add monolog

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


\Slim\Route::setDefaultConditions(array(
    'ID' => '\d+'
));

//$app->response->headers->set('content-type', 'application/json');

$app->get('/', function() use ($app) {
    $testList = DB::query('SELECT * FROM users');
    $app->render('index.html.twig', array('testList' => $testList));
   // $app->render('index.html.twig');
});



$app->get('/product', function() use ($app) {
    //$adList = DB::query('SELECT * FROM ad');
    //$app->render('index.html.twig', array('adList' => $adList));
    $app->render('product_view.html.twig');
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

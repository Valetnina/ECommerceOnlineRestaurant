<?php

// Handling the product_view page
// First show of the product with static content
$app->get('/product/:slug', function($slug) use ($app) {
    $productRecord = DB::queryFirstRow("SELECT products.ID, price, picture,"
                    . " nutritionalValue, name, description FROM products, "
                    . "products_i18n WHERE  products_i18n.productID = products.ID AND lang=%s AND products_i18n.slugname=%s", $_COOKIE['lang'], $slug);
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
                        . 'date, review, rating, customerFirstName FROM ratingsreviews'
                    . '  WHERE productID=%d ORDER BY ratingsreviews.ID DESC '
                    . 'LIMIT %d, %d', $ID, $start, ROWSPERPAGE);

    foreach ($reviewList as &$value) {
        $now = new DateTime('now');
        $value['daysCount'] = $now->diff(new DateTime($value['date']))->format("%a") - 1;
    }

    //\FIXME: Probably not a good idea => Get the total Number of available pages to prevent requesting a page that does not exist
    $result = DB::query('SELECT ratingsreviews.ID, productID, '
                    . 'date, review, rating, customerFirstName FROM ratingsreviews WHERE productID=%d', $ID);
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
                    . 'date, review, rating, customerFirstName FROM ratingsreviews WHERE productID=%d', $ID);
    $reviewCount = DB::count();
    $reviewCountUpdated = $reviewCount;
    $totalPages = ceil($reviewCount / ROWSPERPAGE);
    $ratingSum = 0;
    $ratingAverage = 0;
    foreach ($reviewList as &$value) {
        if ($value['rating'] == 0) {
            $reviewCountUpdated --;
            continue;
        }
        $ratingSum += $value['rating'];
    }
    if($reviewCountUpdated > 0 ){
    $ratingAverage = round($ratingSum / $reviewCountUpdated);
    } 
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

    if($_SESSION['user']){
       $record['customerID'] = $_SESSION['user']['ID'];
       $record['customerFirstName'] = $_SESSION['user']['firstName'];

    } elseif($_SESSION['facebook_access_token'] ){
       $record['customerID'] = $_SESSION['facebook_access_token']['userID'];
       $record['customerFirstName'] = $_SESSION['facebook_access_token']['firstName'];
         
    } else {
        echo json_encode("Unauthorized user");
        return;
    }
    
    DB::insert('ratingsreviews', $record); 

    echo DB::insertId();
    // POST / INSERT is special - returns 201
    $app->response->setStatus(201);
   
});

function isReviewPostValid($review, &$error) {

    if (count($review) != 4) {
        $error = 'Invalid number of fields in data provided';
        return FALSE;
    }
    if (!isset($review['productID']) || (!is_numeric($review['productID']))) {
        $error = 'Product ID is not provided or it is not numeric';
        return FALSE;
    }
    if (strlen($review['review']) < 1 || strlen($review['review']) > 500) {
        $error = 'Review text is not valid';
        return FALSE;
    }
    if (!in_array($review['rating'], array("1", "2", "3", "4", "5", "0", ""))) {
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


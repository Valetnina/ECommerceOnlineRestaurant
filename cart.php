<?php

//Handling of the cart page
//get and port /cart
$app->post('/cart', function() use ($app, $log) {
    //FIXME: ask if it's an overkill
    //Check if there is an attempt to see the  cart if not logged in
    if (!$_SESSION['user'] || !$_SESSION['facebook_access_token']) {
        $log->debug('Attempt to see the cart contents for un unauthorized user from the IP: ' . $_SERVER['REMOTE_ADDR']);
    }

    // handle incoming post, if there is one
    // either add item to cart or change its quantity
    $productID = $app->request()->post('productID');
    $quantity = $app->request()->post('quantity');

    $item = DB::queryFirstRow("SELECT * FROM cartitems WHERE sessionID=%s AND productID=%d", session_id(), $productID);
    if ($item) { // add quantity to existing item
        DB::update('cartitems', array('quantity' => $item['quantity'] + $quantity), 'ID=%i', $item['ID']);
    } else { // create new item in the cart
        DB::insert('cartitems', array(
            'sessionID' => session_id(),
            'productID' => $productID,
            'quantity' => $quantity
        ));
    }
    $app->render('cart_container.html.twig');
});
$app->get('/cartItems', function() use ($app) {
    $app->render('cart_container.html.twig', array(
    ));
});
$app->get('/cart', function() use ($app) {
    // display cart's content
    $cartItems = DB::query(
                    "SELECT cartitems.ID, products.ID as productID, name, price, quantity, picture, nutritionalValue "
                    . "FROM cartitems, products, products_i18n "
                    . "WHERE products.ID = products_i18n.productID AND products.ID = cartitems.productID AND sessionID=%s AND lang=%s", session_id(), $_COOKIE['lang']);
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
});



// RESTful update cart when quantity changed
$app->put('/cart/update/:ID', function($ID) use ($app) {
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
     if ($quantity == 0) {
        DB::delete('cartitems', 'cartitems.ID=%d AND cartitems.sessionID=%s',
                $ID, session_id());
    } else {
        DB::update('cartitems', array('quantity' => $quantity), "ID=%i AND sessionID=%s", $ID, session_id());
    }
    
    echo json_encode(DB::affectedRows() == 1);
});


// Delete an item from the cart
$app->delete('/cartItems/:ID', function($ID) use ($app) {
    // only expect 
    if (isset($ID)) {
        DB::delete('cartitems', "productID=%i AND sessionID=%s", $ID, session_id());
        echo json_encode(DB::affectedRows() == 1);
    } else {
        echo FALSE;
    }
});
$app->get('/deliveryAddress', function() use ($app) {
    // display cart's content
    
    if($_SESSION['facebook_access_token']){
        $shippingAddress = array(
        'firstName' => $_SESSION['facebook_access_token']['firstName'],
        'lastName' => $_SESSION['facebook_access_token']['lastName'],
        'email' => $_SESSION['facebook_access_token']['email'],
        'city' => $_SESSION['facebook_access_token']['location'],
    ); 
       $app->render('shippingaddress.html.twig', array(
        'v' => $shippingAddress,
    ));
    } 
     if($_SESSION['user']){
    $shippingAddress = DB::queryFirstRow("SELECT firstName, lastName, email, address, street, city, country, postalCode, phone FROM users WHERE ID = %s", $_SESSION['user']['ID']);
    $app->render('shippingaddress.html.twig', array(
        'v' => $shippingAddress,
    ));

    }
});
/*
$app->get('/differentAddress', function() use ($app) {

    $app->render('shippingaddress.html.twig', array(
        'differentAddress' => TRUE
    ));
});
*/
function isAddressValid($address) {
    /* TODO: validate the following:
     * 1. All fields ID, title, dueDate, isDone are present and none other
     * 2. ID is valid numercial value 1 or graeter
     * 3. title is 1-100 characters long
     * 4. dueDate is a valid date between 2000-01-01 and 2099-01-01
     * 5. isDone is either 'true' or 'false'
     * In case of failed validation requirement $log->debug() the reason.
     */
    
    if (count($address) != 10) {
            $error = 'Should receive 10 and only ten values';
            return FALSE;
    }
    if (!isset($address['firstName']) || !isset($address['lastName'])
            || !isset($address['email']) || !isset($address['address']) 
            || !isset($address['street']) || !isset($address['city']) 
            || !isset($address['country']) || !isset($address['postalCode'])
                    ||!isset($address['phone']) || !isset($address['storeID'])) {
        $error = 'The passed values do not correspond to the expected values';
        return FALSE;
    }
    if (strlen($firstName) < 2 || strlen($firstName) > 50) {
        $error = "FirstName must be at least 2 and at most 50 characters long";
        return FALSE;
    }
    if (strlen($lastName) < 2 || strlen($lastName) > 50) {
        $error = "LastName must be at least 2 and at most 50 characters long";
        return FALSE;
    }
if (filter_var($email, FILTER_VALIDATE_EMAIL) === FALSE) {
        $error = "Email does not look like a valid email";
        return FALSE;
    } 
   
    if (strlen($address) < 1 || strlen($address) > 50) {
        $error = "Address cannot be empty and cannot contain more than 50 characters";
        return FALSE;
    }
    if (strlen($street) < 1 || strlen($street) > 50) {
        $error ="Street cannot be empty and cannot contain more than 50 characters";
        return FALSE;
    }
    if (strlen($city) < 2 || $city > 100) {
        $error ="City between 2 and 100 characters";
        return FALSE;
    }
    if (strlen($country) < 2 || $country > 50) {
        $error ="Country between 2 and 50 characters";
        return FALSE;
    }
    if (!preg_match('/^([A-Za-z][0-9]){3}$/', $postalCode)) {
        $error ="Phone not valid";
        return FALSE;
    }
    if (!preg_match('/^(\d{3}\s?){2}\d{4}$/', $phone)) {
       $error ="Canadian Postal code not valid";
        return FALSE;
    }
    return TRUE;
}
$app->post('/order', function() use ($app) {
    $body = $app->request->getBody();
    $addressBody = json_decode($body, TRUE);
    /*
    if (!isAddressValid($addressBody)) {

        $log->debug("Failed POST . Invalid data. ");

        $app->response->setStatus(400);
        echo json_encode("Bad request - data validation failed");
        return;
    }*/
     //get the customerID
        if($_SESSION['user']) {
            $customerID = $_SESSION['user']['ID'];
        }
        if($_SESSION['facebook_access_token']){
            $customerID = $_SESSION['facebook_access_token']['userID'];
        }
        //Gathering the rest of the information
        $order = array(
        'orderDate' => DB::sqleval("NOW()"),
        'storeID' => $addressBody['storeID'],
        'customerID' => $customerID,
        'contactFirstName' => $addressBody['firstName'],
        'contactLastName' => $addressBody['lastName'],
        'deliveryAddress' => $addressBody['address'],
        'deliveryStreet' => $addressBody['street'],
        'deliveryCity' => $addressBody['city'],
        'deliveryCountry' => $addressBody['country'],
        'deliveryPostalCode' => $addressBody['postalCode'],
        'contactPhone' => $addressBody['phone'],
    );
        //GET cartItems
        $cartItems = DB::query("SELECT products.ID as productID, price, quantity FROM cartitems, products WHERE products.ID = cartitems.productID AND sessionID=%s", session_id());
        $cartTotal = 0;
        foreach ($cartItems as &$item) {
        $item['total'] = ($item['quantity'] * $item['price']);
        $order['orderAmount'] += $item['total'];
    }
        $order['TAX'] = TAX * $order['orderAmount'];
    
        ///Attempt insert order
      // DB::startTransaction();
        DB::insert('orders', $order);
        $orderID = DB::insertId();
        if($orderID) {
            foreach ($cartItems as &$item) {
            DB::insert('orderitems', array(
            'orderID' => $orderID,
            'productID' => $item['productID'],
            'quantity' => $item['quantity'],
            'orderItemsAmount' => $item['price'] * $item['quantity'],
            'tax' => ($item['price'] * $item['quantity']) * TAX
        ));
        }
        DB::delete('cartitems', 'sessionID=%s', session_id());
       // $insertedOrderItems += DB::count();
    }
    //FIXME; implement delete items from the cart
    //
    //
    //  DB::DBcommit();
     //DB::insert('todoitems', $record);
     
   // echo DB::insertId();
    // POST / INSERT is special - returns 201
    echo json_encode("Order placed succesfully");
    $app->response->setStatus(201);
   
});
$app->get('/ordersuccess', function() use ($app) {

    $app->render('order_submitted.html.twig');
});
$app->get('/locations', function() use ($app) {

    $app->render('locations.html.twig');
});
$app->get('/markers', function() use ($app) {
    $locationList == DB::query('SELECT * FROM locations');
    if (!$locationList) {
        $app->response->setStatus(404);
        echo json_encode("Records not found");
        return;
    }
    echo json_encode($locationList, JSON_PRETTY_PRINT);
});

$app->get('/store-ajax/:lat/:long', function($lat, $lng) use ($app, $log) {

    $storeList = DB::query("SELECT *,(6371 * acos(cos(radians(%s)) * cos(radians(latitude)) * cos(radians(longitude) - radians(%s)) + sin(radians(%s)) * sin(radians(latitude))) ) AS distance FROM `stores`
        ORDER BY distance LIMIT 30 ", $lng, $lat, $lng);
    $log->debug(DB::count());
    if (!$storeList) {
        $app->response->setStatus(404);
        echo json_encode("Records not found");
        return;
    }
    echo json_encode($storeList, JSON_PRETTY_PRINT);
});

$app->get('/nearestStore/:lat/:long', function($lat, $lng) use ($app, $log) {
    $store = DB::queryFirstRow("SELECT *,(6371 * acos(cos(radians(%s)) * cos(radians(latitude)) * cos(radians(longitude) - radians(%s)) + sin(radians(%s)) * sin(radians(latitude))) ) AS distance FROM `stores`
        ORDER BY distance ASC LIMIT 1 ", $lng, $lat, $lng);
    $log->debug(DB::count());
    if (!$store) {
        $app->response->setStatus(404);
        echo json_encode("Records not found");
        return;
    }
    echo json_encode($store, JSON_PRETTY_PRINT);
});

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
    $app->render('cart_view.html.twig');
});

$app->get('/cart', function() use ($app) {
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
$app->get('/deliveryAddress', function() use ($app) {
    // display cart's content
    if ($_SESSION['user']) {
        $shippingAddress = DB::queryFirstRow("SELECT address, street, city, country, postalCode, phone FROM users WHERE ID = %d", $_SESSION['user']['ID']);
    }
    $app->render('shippingaddress.html.twig', array(
        'shippingAddress' => $shippingAddress,
    ));
});
/*
$app->get('/differentAddress', function() use ($app) {

    $app->render('shippingaddress.html.twig', array(
        'differentAddress' => TRUE
    ));
});
*/
$app->post('/differentAddress', function() use ($app, $log) {
    $address = $app->request->post('address');
    $street = $app->request->post('street');
    $city = $app->request->post('city');
    $country = $app->request->post('country');
    $postalCode = $app->request->post('postalCode');

    $valueList = array(
        'address' => $address,
        'street' => $street,
        'city' => $city,
        'country' => $country,
        'postalCode' => $postalCode,
    );
    print_r($valueList);
    // submission received - verify
    $errorList = array("en" => array(), "fr" => array());
    if (strlen($address) < 1 || strlen($address) > 50) {
        array_push($errorList["en"], "Address cannot be empty and cannot contain more than 50 characters");
        array_push($errorList["fr"], "Adresse ne peut pas être vide et ne peut pas contenir plus de 50 caractères");

        unset($valueList['address']);
    }
    if (strlen($street) < 1 || strlen($street) > 50) {
        array_push($errorList["en"], "Street cannot be empty and cannot contain more than 50 characters");
        array_push($errorList["fr"], "Rue ne peut être vide et ne peut pas contenir plus de 50 caractères");
        unset($valueList['street']);
    }
    if (strlen($city) < 2 || $city > 100) {
        array_push($errorList["en"], "City between 2 and 100 characters");
        array_push($errorList["fr"], "La ville entre 2 et 100 caractères");
        unset($valueList['city']);
    }
    if (strlen($country) < 2 || $country > 50) {
        array_push($errorList["en"], "Country between 2 and 50 characters");
        array_push($errorList["fr"], "Le pays entre 2 et 50 caractères");
        unset($valueList['country']);
    }
    if (!preg_match('/^([A-Za-z][0-9]){3}$/', $postalCode)) {
        echo "PostalCode " . $postalCode;
        array_push($errorList["en"], "Phone not valid");
        array_push($errorList["fr"], "Le tel est pas valide");
        unset($valueList['postalCode']);
    }
    //
    if ($errorList["en"] || $errorList["fr"]) {
        // STATE 3: submission failed        
        $app->render('shippingaddress.html.twig', array(
            'errorList' => $errorList[$_COOKIE['lang']], 'v' => $valueList
        ));
    } else {
        // STATE 2: submission successful
        $app->render('shippingaddress.html.twig', array(
        'shippingAddress' => $shippingAddress,
    ));
    }
});
$app->post('/oder', function() use ($app) {
    $addressBody = $app->request->getBody();
    $record = json_decode($addressBody, TRUE);
    if (!isAddressValid($record, $error)) {

        $log->debug("Failed POST . Invalid data. ".$error);

        $app->response->setStatus(400);
        echo json_encode("Bad request - data validation failed");
        return;
    }
    
        //Gathering the rest of the information
        $order = array(
        'orderDate' => date('Y-m-d H:i:s'),
        'deliveryAddress' => $addressBody['address'],
        'deliveryStreet' => $addressBody['street'],
        'deliveryCity' => $addressBody['city'],
        'deliveryCountry' => $addressBody['country'],
        'postalCode' => $addressBody['postalCode'],
    );
            
        //FIXME: get the nearest store
        $order['storeID'] = "1";
        //get the customerID
        if($_SESSION['user']) {
            $order['customerID'] = $_SESSION['user']['ID'];
        }
        if($_SESSION['facebook_access_token']){
            $order['customerID'] = $_SESSION['facebook_access_token']['ID'];
        }
        //GET cartItems
        $cartItems = DB::query("SELECT products.ID as productID, price, quantity FROM cartItems, products WHERE products.ID = cartItems.productID AND sessionID=%s", session_id());
        $cartTotal = 0;
        foreach ($cartItems as &$item) {
        $item['total'] = ($item['quantity'] * $item['price']);
        $order['orderAmount'] += $item['total'];
    }
        $order['TAX'] = TAX * $order['orderAmount'];
    
        ///Attempt insert order
        try{
        DB::beginTransaction();
        DB::insert('orders', $order);
        $orderID = DB::insertId();
        $log->debug(sprintf("Inserted order No %s", $orderID));
        
        foreach ($cartItems as &$item) {
        DB::insert('orderItems', array(
            'orderID' => $orderID,
            'productID' => $item['productID'],
            'quantity' => $item['quantity'],
            'orderItemsAmount' => $item['price'] * $item['quantity'],
            'tax' => ($item['price'] * $item['quantity']) * TAX
        ));
        $insertedOrderItems += DB::count();
    }
        DB::commit();
        $log->debug(sprintf("Inserted  %d orderItems for order No %d", $insertedOrderItems, $orderID));

    } catch(Exception $ex){
        DB::rollback();
        $log->error(sprintf("Transaction failed %s", $ex));
    }
     DB::insert('todoitems', $record);
    echo DB::insertId();
    // POST / INSERT is special - returns 201
    $app->response->setStatus(201);
   
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

    $storeList = DB::query("SELECT *,(6371 * acos(cos(radians(%s)) * cos(radians(latitude)) * cos(radians(longitude) - radians(%s)) + sin(radians(%s)) * sin(radians(latitude))) ) AS distance FROM `locations`
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

    $storeList = DB::queryFirstRow("SELECT *,(6371 * acos(cos(radians(%s)) * cos(radians(latitude)) * cos(radians(longitude) - radians(%s)) + sin(radians(%s)) * sin(radians(latitude))) ) AS distance FROM `locations`
        ORDER BY distance LIMIT 1 ", $lng, $lat, $lng);
    $log->debug(DB::count());
    if (!$storeList) {
        $app->response->setStatus(404);
        echo json_encode("Records not found");
        return;
    }
    echo json_encode($storeList, JSON_PRETTY_PRINT);
});

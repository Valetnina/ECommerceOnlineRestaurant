<?php

$app->get('/admin/product_addedit', function() use ($app, $log) {

    $prodTable = DB::query('SELECT '
                    . 'products.ID, '
                    . 'products.price, '
                    . 'products.picture, '
                    . 'products.nutritionalValue, '
                    . 'products.isVegetarian, '
                    . 'products_i18n.name, '
                    . 'products_i18n.description, '
                    . 'products_i18n.slugname, '
                    . 'productcategory.name as categoryName '
                    . 'FROM products, products_i18n, productcategory '
                    . 'WHERE '
                    . 'products_i18n.lang = %s AND '
                    . 'products.productCategoryID = productcategory.ID AND '
                    . 'products_i18n.lang = productcategory.lang AND '
                    . 'products.ID = products_i18n.productID GROUP BY products.ID ORDER BY productcategory.ID', $_COOKIE['lang']);

    foreach ($prodTable as &$product) {
        print_r('test');
        $product['picture'] = base64_encode($product['picture']);
    }
    //print_r($prodTable);
    $app->render('product_addedit.html.twig', array('prodTable' => $prodTable));
});

function isProductValid($product, &$error, $skipID = FALSE) {

    if (count($product) != ($skipID ? 9 : 10)) {
        $error = 'Invalid number of fields in data provided';
        return FALSE;
    }
    if (!$skipID) {
        if ((!isset($product['ID']) || (!is_numeric($product['ID'])))) {
            $error = 'ID must be provided and must be a number';
            return FALSE;
        }
    }
    if (!isset($product['lang']) ||
            !isset($product['name']) ||
            !isset($product['categoryName']) ||
            !isset($product['price']) ||
            !isset($product['nutritionalValue']) ||
            !isset($product['isVegetarian']) ||
            !isset($product['slugname']) ||
            !isset($product['description']) ||
            !isset($product['picture'])) {
        $error = 'The passed fields do not correspond to the expected list';
        return FALSE;
    }
    if (strlen($product['lang']) != 'fr' || strlen($product['lang']) != 'en') {
        $error = 'Language could be only "fr" or "en"';
        return FALSE;
    }
    if (strlen($product['name']) < 2 || strlen($product['name']) > 100) {
        $error = 'Product name must have between 2 and 100 characters';
        return FALSE;
    }
    if (strlen($product['categoryName']) < 2 || strlen($product['categoryName']) > 100) {
        $error = 'Category name must have between 2 and 100 characters';
        return FALSE;
    }
    if ($product['price'] < 2 || $product['price'] > 100000000) {
        $error = 'Invalid price';
        return FALSE;
    }
    if (!in_array($product['isVegetarian'], array('0', '1'))) {
        $error = 'isVegetarian is not true nor false';
        return FALSE;
    }
    if ($product['slugname'] < 2 || $product['price'] > 100000000) {
        $error = 'Invalid price';
        return FALSE;
    }
    if (!preg_match('/^[a-z0-9](-?[a-z0-9]+)*$/', $product['slugname'])) {
        $error = 'Slug name must have only uppercase ...';
        return FALSE;
    }
    if (strlen($product['description']) < 20 || strlen($product['description']) > 500) {
        $error = 'Description must have between 20 and 100 characters';
        return FALSE;
    }

    return TRUE;
}

$app->post('/admin/product_addedit/', function() use ($app, $log) {
    $body = $app->request->getBody();
    $product = json_decode($body, TRUE);

    /* if (!isProductValid($product, $error, TRUE)) {
      $app->response->setStatus(400);
      $log->debug("POST / product verification failed: " . $error);
      echo json_encode($error);
      //echo json_encode("Bad request - data validation failed");
      return;
      } */
    DB::startTransaction();

    //$categoryName = $product['categoryName'];
    //$productCategoryID = DB::queryOneField('SELECT ID FROM productcategory WHERE name = %s', $categoryName);

    DB::insert('products', array(
        //'productCategoryID' => $productCategoryID,
        'price' => $product['price'],
        //'picture' => $product['picture'],
        'nutritionalValue' => $product['nutritionalValue'],
        'isVegetarian' => $product['isVegetarian']));

    $productID = DB::insertId();

    DB::insert('products_i18n', array(
        //'ID' => $productID,
        'lang' => $product['lang'],
        'name' => $product['name'],
        'description' => $product['description'],
        'slugname' => $product['slugname']));

    DB::commit();
    $app->response->setStatus(201);
});

$app->get('/admin/product_addedit/(:ID)', function($ID = "") use ($app) {

    if (!isset($ID)) {
        $app->render('product_addedit.html.twig');
    } else {
        $product_form = DB::queryFirstRow('SELECT '
                        . 'products.ID, '
                        . 'products.productCategoryID, '
                        . 'products.price, '
                        . 'products.picture, '
                        . 'products.nutritionalValue, '
                        . 'products.isVegetarian, '
                        . 'products_i18n.name, '
                        . 'products_i18n.lang, '
                        . 'products_i18n.description, '
                        . 'products_i18n.slugname, '
                        . 'productcategory.name as categoryName '
                        . 'FROM products, products_i18n, productcategory '
                        . 'WHERE '
                        . 'products_i18n.lang = %s AND '
                        . 'products.ID = %d AND '
                        . 'products.productCategoryID = productcategory.ID AND '
                        . 'products_i18n.lang = productcategory.lang AND '
                        . 'products.ID = products_i18n.productID '
                        . 'GROUP BY products.ID '
                        . 'ORDER BY productcategory.ID', $_COOKIE['lang'], $ID);

        $product_form['picture'] = base64_encode($product_form['picture']);

        $categoryList = DB::query('SELECT * FROM productcategory WHERE lang=%s', $_COOKIE['lang']);

        $app->render('product_form.html.twig', array('product_form' => $product_form, 'categoryList' => $categoryList));
    }
});

$app->put('/admin/product_addedit/:ID', function($ID) use ($app) {
    $body = $app->request->getBody();
    $product = json_decode($body, TRUE);

    //DB::startTransaction();

    $product['ID'] = $ID;

    DB::update('products', array(
        'price' => $product['price'],
        'nutritionalValue' => $product['nutritionalValue'],
        'isVegetarian' => $product['isVegetarian']), "ID=%d", $ID);

    /*DB::update('products_i18n', array(
        'lang' => $product['lang'],
        'name' => $product['name'],
        'description' => $product['description'],
        'slugname' => $product['slugname']), "productID = %d", $ID);*/
    
 //DB::commit();

   /* if (isProductValid($product, $error, TRUE)) {
        DB::commit();
    } else {
        $app->response->setStatus(400);
        //$log->debug("POST / product verification failed: " . $error);
        echo json_encode($error);
        DB::rollback();
    }*/
});

$app->post('/admin/category_addedit', function() use ($app, $log) {
    $categoryName = $app->request->post('categoryName');
    
    if (!$categoryName) {
        $log->debug("Field must be fill.");
        $app->render('category_addedit.html.twig', array('categoryFailed' => TRUE));
    } else {
       DB::insert('productcategory', $categoryName);
       
       $app->render('add_category_success.html.twig');
    }
});



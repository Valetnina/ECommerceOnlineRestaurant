<?php

////////////////////////////////////////////////////////////
/////////////////////Product Add/Edit//////////////////////
//////////////////////////////////////////////////////////
$app->get('/admin/products', function() use ($app, $log) {
    $app->render('products_container.html.twig');
});

$app->get('/admin/product_addedit', function() use ($app, $log) {
    $prodTable = DB::query('SELECT '
                    . 'en.productID, '
                    . 'concat(en.name_en," / ",fr.name_fr) as productname, '
                    . 'en.description_en, '
                    . 'fr.description_fr, '
                    . 'concat(en.pg_name," / ",fr.pg_name) as categoryname, '
                    . 'isVegetarian, '
                    . 'nutritionalValue, '
                    . 'picture, '
                    . 'price '
                    . 'FROM '
                    . '(SELECT '
                    . 'productID, '
                    . 'pi.name as name_en, '
                    . 'description as description_en, '
                    . 'pg.name as pg_name, '
                    . 'p.isVegetarian, '
                    . 'p.nutritionalValue, '
                    . 'p.picture, '
                    . 'p.price '
                    . 'FROM '
                    . 'products_i18n pi, products p, productcategory pg '
                    . 'WHERE '
                    . 'pi.lang = pg.lang AND '
                    . 'pi.lang = "en" AND '
                    . 'pg.ID = p.productCategoryID AND '
                    . 'p.ID = pi.productID AND '
                    . 'pg.lang = pi.lang) as en, '
                    . '(SELECT '
                    . 'pi.name as name_fr, '
                    . 'description as description_fr, '
                    . 'pg.name as pg_name, '
                    . 'pi.productID '
                    . 'FROM '
                    . 'products_i18n pi, products p, productcategory pg '
                    . 'WHERE '
                    . 'pi.lang = "fr" AND '
                    . 'pg.ID = p.productCategoryID AND '
                    . 'p.ID = pi.productID AND '
                    . 'pg.lang = pi.lang) as fr '
                    . 'WHERE '
                    . 'en.productID = fr.productID');

    foreach ($prodTable as &$product) {
// print_r('test');
      $product['picture'] = base64_encode($product['picture']);
    }

    $app->render('product_addedit.html.twig', array('prodTable' => $prodTable));
});

$app->get('/admin/product_addedit/form(/:ID)', function($ID = "") use ($app) {
        $categoryList = DB::query('SELECT en.ID as categoryID,'
                . 'concat(en.name," / ",fr.name) as categoryname '
                        . 'FROM '
                        . '(SELECT '
                        . 'ID, '
                        . 'name '
                        . 'FROM productcategory '
                        . 'WHERE '
                        . 'lang = "en") as en, '
                        . '(SELECT '
                        . 'ID, '
                        . 'name '
                        . 'FROM productcategory '
                        . 'WHERE '
                        . 'lang = "fr") as fr '
                        . 'WHERE '
                        . 'en.ID = fr.ID');
    if (empty($ID)) {
        $app->render('form_addedit.html.twig',array('categoryList' => $categoryList));
    } else {
        $prodForm = DB::queryFirstRow('SELECT '
                        . 'en.productID, '
                        . 'en.name_en, '
                        . 'fr.name_fr, '
                        . 'en.description_en, '
                        . 'fr.description_fr, '
                        . 'concat(en.pg_name," / ",fr.pg_name) as categoryname, '
                        . 'isVegetarian, '
                        . 'nutritionalValue, '
                        . 'picture, '
                        . 'price '
                        . 'FROM '
                        . '(SELECT '
                        . 'productID, '
                        . 'pi.name as name_en, '
                        . 'description as description_en, '
                        . 'pg.name as pg_name, '
                        . 'p.isVegetarian, '
                        . 'p.nutritionalValue, '
                        . 'p.picture, '
                        . 'p.price '
                        . 'FROM '
                        . 'products_i18n pi, products p, productcategory pg '
                        . 'WHERE '
                        . 'pi.productID = %d AND '
                        . 'pi.lang = "en" AND '
                        . 'pg.ID = p.productCategoryID AND '
                        . 'p.ID = pi.productID AND '
                        . 'pg.lang = pi.lang) as en, '
                        . '(SELECT '
                        . 'pi.name as name_fr, '
                        . 'description as description_fr, '
                        . 'pg.name as pg_name '
                        . 'FROM '
                        . 'products_i18n pi, products p, productcategory pg '
                        . 'WHERE '
                        . 'pi.productID = %d AND '
                        . 'pi.lang = "fr" AND '
                        . 'pg.ID = p.productCategoryID AND '
                        . 'p.ID = pi.productID AND '
                        . 'pg.lang = pi.lang) as fr', $ID, $ID);

        $prodForm['picture'] = base64_encode($prodForm['picture']);

        
        $app->render('form_addedit.html.twig', array('p' => $prodForm, 'categoryList' => $categoryList));
    }

//print_r($prodTable);
});

function uploadImage() {
    $target_dir = "uploads/";
    $max_file_size = 5 * 1024 * 1024; // 5000000

    if (!isset($_POST['submit'])) {
        $log->debug("Error: File upload expected.");
    }
    $fileUpload = $_FILES['fileToUpload'];

    $check = getimagesize($fileUpload["tmp_name"]);
    if (!$check) {
        $log->debug("Error: File upload was not an image file.");
    }
    switch ($check['mime']) {
        case 'image/png':
        case 'image/gif':
        case 'image/bmp':
        case 'image/jpeg':
            break;
        default:
            $log->debug("Error: Only accepting valie png,gif,bmp,jpg files.");
    }
    if ($fileUpload['size'] > $max_file_size) {
        $log->debug("Error: File to big, maximuma accepted is $max_file_size bytes");
    }

    if (strstr($fileUpload['name'], '..')) {
        $log->debug("Error: do not mess with the Zohan");
    }
    $target_file = $target_dir . $fileUpload['name'];

    if (move_uploaded_file($fileUpload["tmp_name"], $target_file)) {
        $log->debug("The file " . basename($fileUpload["name"]) . " has been uploaded.");
    } else {
        $log->debug("Sorry, there was an error uploading your file.");
    }

    $image = $fileUpload["tmp_name"];
    $image = file_get_contents($image);
    $image = base64_encode($image);
}

$app->post('/admin/products', function() use ($app, $log) {
    $ID = $app->request->post('productID');
    $name_en = $app->request->post('name_en');
    $name_fr = $app->request->post('name_fr');
    $price = $app->request->post('price');
    $nutritionalValue = $app->request->post('nutritionalValue');

    $isVegetarian = $app->request->post('isVegetarian');
    
    if (isset($isVegetarian)) {
        $isVegetarian = 1;
    } else {
        $isVegetarian = 0;
    }
    $productCategoryID = $app->request->post('categoryID');
    //Find the categoryId 
    $description_en = $app->request->post('description_en');
    $description_fr = $app->request->post('description_fr');
    $picture = $app->request->post('picture');

    //$picture = base64_decode($picture);

    $valueList = array(
        'name_en' => $name_en,
        'name_fr' => $name_fr,
        'price' => $price,
        'nutritionalValue' => $nutritionalValue,
        'isVegetarian' => $isVegetarian,
        'description_en' => $description_en,
        'description_fr' => $description_fr,
        'picture' => $picture
    );


    $errorList = array();

    if (strlen($name_en) < 2 || strlen($name_en) > 100) {
        array_push($errorList, "Product Name_EN must be at least 2 and at most 100 characters long");
        unset($valueList['name_en']);
    }
    if (strlen($name_fr) < 2 || strlen($name_fr) > 100) {
        array_push($errorList, "Product Name_FR must be at least 2 and at most 100 characters long");
        unset($valueList['name_en']);
    }
    if ($price <= 0 || $price > 100000000) {
        array_push($errorList, "Invalid price");
        unset($valueList['price']);
    }
    if (!in_array($isVegetarian, array('0', '1'))) {
        array_push($errorList, "isVegetarian is not true nor false");
        unset($valueList['isVegetarian']);
    }
    if (strlen($description_en) < 20 || strlen($description_en) > 500) {
        array_push($errorList, "Description_EN must have between 20 and 100 characters");
        unset($valueList['description_en']);
    }
    if (strlen($description_fr) < 20 || strlen($description_fr) > 500) {
        array_push($errorList, "Description_FR must have between 20 and 100 characters");
        unset($valueList['description_fr']);
    }
    if ($nutritionalValue <= 0 || $nutritionalValue > 1000) {
        array_push($errorList, "Invalid nutritional value");
        unset($valueList['nutritionalValue']);
    }
    if ($errorList) {
        $app->render('products_container.html.twig', array(
            'errorList' => $errorList, 'p' => $valueList
        ));
        return;
    } 
    if (!isset($ID) || empty($ID)) { // SUCCESSFUL SUBMISSION
        DB::$error_handler = FALSE;
        DB::$throw_exception_on_error = TRUE;
        print_r($valueList);
        try {
            DB::startTransaction();
        
            DB::insert('products', array(
                'productCategoryID' => $productCategoryID,
                'price' => $price,
                'nutritionalValue' => $nutritionalValue,
                'isVegetarian' => $isVegetarian,
                    //'picture' => $picture
            ));
            $productID = DB::insertId();
        
            DB::insert('products_i18n', array(
                'name' => $name_en,
                'description' => $description_en,
                'productID' => $productID,
                'lang' => 'en'
            ));

            DB::insert('products_i18n', array(
                'name' => $name_fr,
                'description' => $description_fr,
                'productID' => $productID,
                'lang' => 'fr'
            ));

            DB::commit();
            $log->debug("Product created with ID=" . $ID);
            $app->render('products_container.html.twig');
        } catch (MeekroDBException $e) {
            DB::rollback();
            sql_error_handler(array(
                'error' => $e->getMessage(),
                'query' => $e->getQuery()
            ));
        }
    } else {
        DB::$error_handler = FALSE;
        DB::$throw_exception_on_error = TRUE;

        try {
            DB::startTransaction();

            DB::update('products', array(
                'price' => $price,
                'nutritionalValue' => $nutritionalValue,
                'isVegetarian' => 1), 'ID = %d', $ID);

            DB::update('products_i18n', array(
                'name' => $name_en,
                'description' => $description_en), 'productID = %d AND lang = "en"', $ID);

            DB::update('products_i18n', array(
                'name' => $name_fr,
                'description' => $description_fr), 'productID = %d AND lang = "fr"', $ID);

            DB::commit();
            $log->debug("Product updated with ID=" . $ID);
            $app->render('products_container.html.twig');
        } catch (MeekroDBException $e) {
            DB::rollback();
            sql_error_handler(array(
                'error' => $e->getMessage(),
                'query' => $e->getQuery()
            ));
        }
    }
});

//$app->render('register.html.twig', array('registerSuccess' => TRUE));
//
//
////////////////////////////////////////////////////////////
/////////////////////Category//////////////////////////////
//////////////////////////////////////////////////////////
$app->get('/admin/category_addedit', function() use ($app) {
    $categoryList = DB::query('SELECT '
                    . 'concat(en.name," / ",fr.name) as categoryname, '
                    . 'en.ID '
                    . 'FROM '
                    . '(SELECT '
                    . 'ID, '
                    . 'name '
                    . 'FROM productcategory '
                    . 'WHERE '
                    . 'lang = "en") as en, '
                    . '(SELECT '
                    . 'ID, '
                    . 'name '
                    . 'FROM productcategory '
                    . 'WHERE '
                    . 'lang = "fr") as fr '
                    . 'WHERE '
                    . 'en.ID = fr.ID');
    $app->render('category_addedit.html.twig', array(
        'categoryList' => $categoryList));
});


$app->get('/admin/category_addedit/:ID', function($ID) use ($app) {
    $record = DB::queryFirstRow('SELECT '
                    . 'en.name as name_en, '
                    . 'fr.name as name_fr, '
                    . 'FROM '
                    . '(SELECT '
                    . 'ID, '
                    . 'name '
                    . 'FROM productcategory '
                    . 'WHERE '
                    . 'ID = %d, '
                    . 'lang = "en") as en, '
                    . '(SELECT '
                    . 'ID, '
                    . 'name '
                    . 'FROM productcategory '
                    . 'WHERE '
                    . 'ID = %d, '
                    . 'lang = "fr") as fr '
                    . 'WHERE '
                    . 'en.ID = fr.ID', $ID, $ID);

    if (!$record) {
        $app->response->setStatus(404);
        echo json_encode("Record not found");
        return;
    }
    echo json_encode($record, JSON_PRETTY_PRINT);
});

$app->post('/admin/category_addedit/', function() use ($app, $log) {

    $body = $app->request->getBody();
    $record = json_decode($body, TRUE);

    DB::insert('productcategory', $record);
    
});

$app->put('/admin/category_addedit/:ID', function($ID) use ($app) {

    $body = $app->request->getBody();
    $record = json_decode($body, TRUE);
   
    DB::update('productcategory', $record, "ID=%d", $ID);

});

////////////////////////////////////////////////////////////
/////////////////////View Orders//////////////////////////////
//////////////////////////////////////////////////////////

$app->get('/admin/view_orders', function() use ($app, $log) {
    
  $orderList = DB::query('SELECT orders.ID, orderDate, orderAmount, deliveryDate,  deliveryAmount FROM orders, deliveries  WHERE  orders.ID = orderID');  
    
  $app->render('viewOrders.html.twig', array('orderList' => $orderList));  
});


<?php

////////////////////////////////////////////////////////////
/////////////////////Product Add/Edit//////////////////////
//////////////////////////////////////////////////////////

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

$app->get('/admin/product_addedit/(:ID)', function($ID = "") use ($app) {

    if ($id === '') {
    $app->render('form_addedit.html.twig');}
//    } else {
//        $prodForm = DB::query('SELECT '
//                        . 'en.productID, '
//                        . 'en.name_en, '
//                        . 'fr.name_fr, '
//                        . 'en.description_en, '
//                        . 'fr.description_fr, '
//                        . 'concat(en.pg_name," / ",fr.pg_name) as categoryname, '
//                        . 'isVegetarian, '
//                        . 'nutritionalValue, '
//                        . 'picture, '
//                        . 'price '
//                        . 'FROM '
//                        . '(SELECT '
//                        . 'productID, '
//                        . 'pi.name as name_en, '
//                        . 'description as description_en, '
//                        . 'pg.name as pg_name, '
//                        . 'p.isVegetarian, '
//                        . 'p.nutritionalValue, '
//                        . 'p.picture, '
//                        . 'p.price '
//                        . 'FROM '
//                        . 'products_i18n pi, products p, productcategory pg '
//                        . 'WHERE '
//                        . 'pi.productID = %d AND '
//                        . 'pi.lang = "en" AND '
//                        . 'pg.ID = p.productCategoryID AND '
//                        . 'p.ID = pi.productID AND '
//                        . 'pg.lang = pi.lang) as en, '
//                        . '(SELECT '
//                        . 'pi.name as name_fr, '
//                        . 'description as description_fr, '
//                        . 'pg.name as pg_name '
//                        . 'FROM '
//                        . 'products_i18n pi, products p, productcategory pg '
//                        . 'WHERE '
//                        . 'pi.productID = %d AND '
//                        . 'pi.lang = "fr" AND '
//                        . 'pg.ID = p.productCategoryID AND '
//                        . 'p.ID = pi.productID AND '
//                        . 'pg.lang = pi.lang) as fr', $ID, $ID);
//
//        //     $prodForm['picture'] = base64_encode($prodForm['picture']);
//        
//        $categoryList = DB::query('SELECT '
//                    . 'concat(en.name," / ",fr.name) as categoryname '
//                    . 'FROM '
//                    . '(SELECT '
//                    . 'ID, '
//                    . 'name '
//                    . 'FROM productcategory '
//                    . 'WHERE '
//                    . 'lang = "en") as en, '
//                    . '(SELECT '
//                    . 'ID, '
//                    . 'name '
//                    . 'FROM productcategory '
//                    . 'WHERE '
//                    . 'lang = "fr") as fr '
//                    . 'WHERE '
//                    . 'en.ID = fr.ID');
//
//    $app->render('form_addedit.html.twig', array('prodForm' => $prodForm, 'categoryList' => $categoryList));
//    }

    //print_r($prodTable);
    
});



$app->post('/admin/product_addedit/', function() use ($app, $log) {
    $body = $app->request->getBody();
    $product = json_decode($body, TRUE);

    try {
        DB::startTransaction();

        $categoryName = $product['categoryName'];
        $productCategoryID = DB::queryOneField('SELECT ID FROM productcategory WHERE name = %s', $categoryName);

        DB::insert('products', array(
            'productCategoryID' => $productCategoryID,
            'price' => $product['price'],
            //'picture' => $product['picture'],
            'nutritionalValue' => $product['nutritionalValue'],
            'isVegetarian' => $product['isVegetarian']));

        $productID = DB::insertId();

        DB::insert('products_i18n', array(
            'productID' => $productID,
            'lang' => $product['lang'],
            'name' => $product['name'],
            'description' => $product['description'],
            'slugname' => $product['slugname']));

        DB::commit();
    } catch (Exception $ex) {
        DB::rollback();
        $log->debug("Insert failed " . $ex);
    }
});



$app->put('/admin/product_addedit/:ID', function($ID) use ($app) {
    $body = $app->request->getBody();
    $product = json_decode($body, TRUE);

    try {

        DB::startTransaction();

        $product['ID'] = $ID;

        DB::update('products', array(
            'price' => $product['price'],
            'nutritionalValue' => $product['nutritionalValue'],
            'isVegetarian' => $product['isVegetarian']), "ID=%d", $ID);

        DB::update('products_i18n', array(
            'lang' => $product['lang'],
            'name' => $product['name'],
            'description' => $product['description'],
            'slugname' => $product['slugname']), "productID = %d", $ID);

        DB::commit();
    } catch (Exception $ex) {
        DB::rollback();
        $log->debug("Update failed " . $ex);
    }
});


////////////////////////////////////////////////////////////
/////////////////////Category//////////////////////////////
//////////////////////////////////////////////////////////
$app->get('/admin/category_addedit', function() use ($app) {
    $categoryList = DB::query('SELECT * FROM productcategory WHERE lang = %s', $_COOKIE['lang']);

    $app->render('category_addedit.html.twig', array(
        'categoryList' => $categoryList));
});


$app->get('/admin/category_addedit/:ID', function($ID) use ($app) {
    $category = DB::queryFirstRow('SELECT * FROM productcategory WHERE lang = %s AND ID = %d', $_COOKIE['lang'], $ID);

    if (!$category) {
        $app->response->setStatus(404);
        echo json_encode("Record not found");
        return;
    }

    //print_r($category);
    echo json_encode($category, JSON_PRETTY_PRINT);
});

$app->post('/admin/category_addedit/', function() use ($app, $log) {

    //$lastID = DB::queryFirstField('SELECT MAX(ID) FROM productcategory');

    $body = $app->request->getBody();
    $record = json_decode($body, TRUE);
    //$record['ID'] = $lastID;

    DB::insert('productcategory', $record);
    if ($record['lang'] == 'en') {
        $record['lang'] = 'fr';
        $record['name'] = 'N/A';
        $record['slugname'] = '';
        DB::insert('productcategory', $record);
    } else {
        $record['lang'] = 'en';
        $record['name'] = 'N/A';
        $record['slugname'] = '';
    }
    //echo DB::insertId();
});

$app->put('/admin/category_addedit/:ID', function($ID) use ($app) {

    $body = $app->request->getBody();
    $record = json_decode($body, TRUE);
    //$record['ID'] = $ID;
    $lang = $record['lang'];
    //print_r($record);
    DB::update('productcategory', $record, "lang=%s AND ID=%d", $lang, $ID);
    //echo json_encode(TRUE); // same as: echo 'true';
});

////////////////////////////////////////////////////////////
/////////////////////END Category//////////////////////////////
//////////////////////////////////////////////////////////


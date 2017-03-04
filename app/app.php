<?php
    date_default_timezone_set('America/Los_Angeles');
    require_once __DIR__.'/../vendor/autoload.php';
    require_once __DIR__.'/../src/Store.php';
    require_once __DIR__.'/../src/Brand.php';

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */


    $server = 'mysql:host=localhost:8889;dbname=shoes';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    use Symfony\Component\Debug\Debug;
    Debug::enable();

    $app = new Silex\Application();

    $app['debug'] = true;

    $app->register(new Silex\Provider\TwigServiceProvider(), array('twig.path' => __DIR__.'/../views'));

    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();

    //Root
    $app->get('/', function() use($app) {

        return $app['twig']->render('index.html.twig');

    });

    //Create store
    $app->post('/stores/create', function() use ($app) {

        $new_store = new Store($_POST['store_name']);
        $new_store->save();

        return $app->redirect('/stores');

    });

    // Read stores // View brands that it carries
    $app->get('/stores', function() use ($app){


        return $app['twig']->render('stores.html.twig', array('stores'=>Store::getAll()));

    });

    // Read store (singular)
    $app->get('/stores/{id}', function($id) use ($app){

        $store = Store::find($id);
        $assigned_stores = $store->findBrands();
        return $app['twig']->render('store.html.twig', array('store'=>$store, 'assigned_brands'=>$assigned_stores ));

    });

    // Update store
    $app->patch('/stores/{id}', function($id) use ($app){

        $store = Store::find($id);
        $store->update($_POST['new_store_name']);
        return $app['twig']->render('store_name_update.html.twig', array('store'=>$store));

    });

    // Delete stores
    $app->delete('/stores/delete_all', function() use ($app){

        Store::deleteAll();
        return $app->redirect('/stores');

    });

    // Delete store (singular)
    $app->delete('/stores/{id}', function($id) use ($app){

        $store = Store::find($id);
        $store_name = $store->getName();
        $store->delete();
        return $app['twig']->render('store_deletion.html.twig', array('store_name'=>$store_name, 'brand'=>Brand::getAll()) );

    });

    // Create brand
    $app->post('/brands/create', function () use ($app){

        $new_brand = new Brand($_POST['brand_name']);
        $new_brand->save();
        return $app->redirect('/brands');

    });

    // Read brands
    $app->get('/brands', function () use ($app) {

        return $app['twig']->render('brands.html.twig', array('brands'=>Brand::getAll()));

    });

    // Read brand (singular)
    $app->get('/brands/{id}', function($id) use ($app) {


        $brand = Brand::find($id);
        $assigned_stores = $brand->findStores();
        return $app['twig']->render('brand.html.twig', array('brand'=>$brand, 'assigned_stores' =>$assigned_stores, 'stores'=>Store::getAll()));

    });

    // Match brand to a new store
    $app->post('/brands/match', function() use ($app) {

        $store = new Store($_POST['new_store_name']);
        $store->save();
        $brand = Brand::find($_POST['brand_id']);
        $brand->assignStore($store->getId());
        return $app['twig']->render('brand_assign_store.html.twig', array('store'=>$store, 'brand'=>$brand) );

    });

    // Match a store to a brand
    $app->post('/stores/match', function() use ($app) {

        $brand = new Brand($_POST['new_brand_name']);
        $brand->save();
        $store = Store::find($_POST['store_id']);
        $store->assignBrand($brand->getId());
        return $app['twig']->render('store_assign_brand.html.twig', array('brand'=>$brand, 'store'=>$store));

    });

    return $app;

?>

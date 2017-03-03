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
        return $app['twig']->render('store.html.twig', array('store'=>$store, 'assigned_brands'=>$store->findBrands() ));

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
    $app->delete('/stores/delete_singular', function() use ($app){

        return $app->redirect('/stores/{id}');

    });

    //Create brand
    $app->post('/brands/create', function () use ($app){

        return $app->redirect('/brands');

    });

    // Read brands
    $app->get('/brands', function () use ($app) {

        return $app->render('brands.html.twig');

    });

    // Read brand (singular)
    $app->get('/brands/{id}', function($id) use ($app) {

        return $app->render('brand.html.twig');

    });

    // Match brand to a store
    $app->post('/brands/match', function() use ($app) {

        return $app->redirect('/brands/{id}');

    });

    return $app;

?>

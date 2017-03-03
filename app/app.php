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
    $app->post('/stores', function() use ($app) {
        return $app->redirect('/stores');
    });
    // Read stores
    $app->get('/stores', function() use ($app){
        
    });
    // Read store (singular)
    // Update store
    // Delete stores
    // Delete store (singular)
    //Create brand
    // Read brands
    // Read brand (singular)
    // Update brand
    // Delete brands
    // Delete brand (singular)


    return $app;

?>

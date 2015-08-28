<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Brand.php";
    require_once __DIR__."/../src/Store.php";

    $app = new Silex\Application();
    $app['debug'] = true;

    $server = 'mysql:host=localhost;dbname=shoes';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../views'
    ));

    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();

//landing page
    //renders homepage
    $app->get("/", function() use ($app)
    {
        return $app['twig']->render('home.html.twig');
    });

//all stores page
    //directs to all_stores page
    $app->get('all_stores', function() use ($app)
    {
        return $app['twig']->render('all_stores.html.twig', array('stores' => Store::getAll()));
    });

    //allows user to add stores to page
    $app->post('/add_stores', function() use ($app)
    {
        $store_name = $_POST['store_name'];
        $store = new Store($store_name);
        $store->save();
        return $app['twig']->render('all_stores.html.twig', array('stores' => Store::getAll()));
    });

//all brands page
    //directs to a list of all brands
    $app->get('all_brands', function() use ($app)
    {
        return $app['twig']->render('all_brands.html.twig', array('brands' => Brand::getAll()));
    });

    return $app;
?>

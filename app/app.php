<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once __DIR__."/../src/Course.php";
    require_once __DIR__."/../src/Curriculum.php";
    require_once __DIR__."/../src/Student.php";
    require_once __DIR__."/../vendor/autoload.php";

    $app = new Silex\Application();

    $server = 'mysql:host=localhost:8889;dbname=university';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
      'twig.path' => __DIR__.'/../views'
    ));

    $app->get("/", function() use($app){
    return $app['twig']->render('home.html.twig');
    });

    return $app;


?>

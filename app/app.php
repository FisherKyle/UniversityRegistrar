<?php
  /**
  * @backupGlobals disabled
  * @backupStaticAttributes disabled
  */

  require_once __DIR__."/../src/curriculum.php";
  require_once __DIR__."/../src/Course.php";
  require_once __DIR__."/../src/Student.php";

  $app = new Silex\Application();

  $server = 'mysql:host=localhost:8889;dbname=university';
  $username = 'root';
  $password = 'root';
  $DB = new PDO($server, $username, $password);

  $app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../views'
  ));

  $app->("/", function() use($app){
    return $app['twig']->render('home.index.html');
  });


?>

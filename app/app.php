<?php
  /**
  * @backupGlobals disabled
  * @backupStaticAttributes disabled
  */

  require_once __DIR__."/../src/courses_students.php";
  require_once __DIR__."/../src/courses.php";
  require_once __DIR__."/../src/students.php";

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


<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/courses.php";
    require_once "src/students.php";

    $server = 'mysql:host=localhost:8889;dbname=university_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class Client_test extends PHPUnit_Framework_TestCase
    {
        function tearDown()
        {
            Students::deleteAll();
            Courses::deleteAll();
        }

// ----Tests---- //

        function save_Test()
        {

        }

        function getAll_Test()
        {

        }

        function deleteAll_Test()
        {

        }

        function deleteOne_Test()
        {

        }

    }
?>

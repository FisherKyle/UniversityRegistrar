<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Course.php";
    require_once "src/Student.php";

    $server = 'mysql:host=localhost:8889;dbname=university_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class CourseTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Student::deleteAll();
            Course::deleteAll();
        }

// ----Tests---- //

        function test_getName()
        {
            //Arrange
            $name = "Intro to Owls";
            $class = "OWL_101";
            $test_course = new Course($name, $class);
            //Act
            $result = $test_course->getName();
            //Assert
            $this->assertEquals($name, $result);
        }

        function test_getClass()
        {
        //Arrange
        $name = "Intro to Owls";
        $class = "OWL_101";
        $test_course = new Course($name, $class);
        //Act
        $result = $test_course->getClass();
        //Assert
        $this->assertEquals($class, $result);
        }

        function test_getId()
        {
            //Arrange
            $id = 2;
            $name = "Intro to Owls";
            $class = "OWL_101";
            $new_class = new Course($name, $class, $id);
            $expected_output = 2;
            //Act
            $result = $new_class->getId();
            //arrange
            $this->assertEquals($expected_output, $result);
        }

        function test_save()
        {
            //Arrange
            $name = "Intro to Owls";
            $class = "OWL_101";
            $new_course = new Course($name, $class);
            $new_course->save();
            //Act
            $result = Course::getAll();
            //Assert
            $this->assertEquals($new_course, $result[0]);
        }

        function test_getAll()
        {
            //Arrange
            $name1 = "Intro to Owls";
            $name2 = "Intro to Jerky";
            $class1 = "OWL_101";
            $class2 = "JRK_101";
            $new_course1 = new Course($name1, $class1);
            $new_course1->save();
            $new_course2 = new Course($name2, $class2);
            $new_course2->save();
            $expected_output = [$new_course1, $new_course2];
            //Act
            $result = Course::getAll();
            //Assert
            $this->assertEquals($expected_output, $result);
        }

        function test_deleteAll()
        {
            //Arrange
            $name1 = "Intro to Owls";
            $name2 = "Intro to Jerky";
            $class1 = "OWL_101";
            $class2 = "JRK_101";
            $new_course1 = new Course($name1, $class1);
            $new_course1->save();
            $new_course2 = new Course($name2, $class2);
            $new_course2->save();
            $expected_output = [];
            //Act
            Course::deleteAll();
            $result = Course::getAll();
            //Assert
            $this->assertEquals($expected_output, $result);
        }

        function test_deleteOne()
        {
            //Arrange
            $name1 = "Intro to Owls";
            $name2 = "Intro to Jerky";
            $class1 = "OWL_101";
            $class2 = "JRK_101";
            $new_course1 = new Course($name1, $class1);
            $new_course1->save();
            $new_course2 = new Course($name2, $class2);
            $new_course2->save();
            $expected_output = [$new_course1];
            //Act
            $new_course2->deleteOne();
            $result = Course::getAll();
            //Assert
            $this->assertEquals($expected_output, $result);
        }

        function test_update()

        {
            //arrange
            $name = "Advanced Owlature";
            $class = "OWL_301";
            $new_course = new Course($name, $class);
            $new_course->save();
            $updated_name = "Intro to Owls";
            $updated_course = "Owl_101";

            //act
            $new_course->update($updated_name, $updated_course);
            $curriculum = Course::getAll();
            $result = $curriculum[0]->getName();
            $expected_output = $updated_name;
            //assert
            $this->assertEquals($expected_output, $result);
        }


    }
?>

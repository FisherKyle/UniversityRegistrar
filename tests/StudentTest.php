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

    class StudentTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            // Students::deleteAll();
            Student::deleteAll();
        }

// ----Tests---- //

        function test_getName()
        {
            //Arrange
            $name = "Brittanica Williams";
            $enrollment = "2015-11-04";
            $test_student = new Student($name, $enrollment);
            //Act
            $result = $test_student->getName();
            //Assert
            $this->assertEquals($name, $result);
        }

        function test_getClass()
        {
            //Arrange
            $name = "Brittanica Williams";
            $enrollment = "2015-11-04";
            $test_student = new Student($name, $enrollment);
            //Act
            $result = $test_student->getClass();
            //Assert
            $this->assertEquals($enrollment, $result);
            }

            function test_getId()
        {
            //Arrange
            $id = 2;
            $name = "Brittanica Williams";
            $enrollment = "2015-11-04";
            $new_enrollment = new Student($name, $enrollment, $id);
            $expected_output = 2;
            //Act
            $result = $new_enrollment->getId();
            //arrange
            $this->assertEquals($expected_output, $result);
        }

        function test_save()
        {
            //Arrange
            $name = "Brittanica Williams";
            $enrollment = "2015-11-04";
            $new_student = new Student($name, $enrollment);
            $new_student->save();
            //Act
            $result = Student::getAll();
            //Assert
            $this->assertEquals($new_student, $result[0]);
        }

        function test_getAll()
        {
            //Arrange
            $name1 = "Brittanica Williams";
            $name2 = "Oscar Oxford";
            $enrollment1 = "2015-11-04";
            $enrollment2 = "1992-04-24";
            $new_student1 = new Student($name1, $enrollment1);
            $new_student1->save();
            $new_student2 = new Student($name2, $enrollment2);
            $new_student2->save();
            $expected_output = [$new_student1, $new_student2];
            //Act
            $result = Student::getAll();
            //Assert
            $this->assertEquals($expected_output, $result);
        }

        function test_deleteAll()
        {
            //Arrange
            $name1 = "Brittanica Williams";
            $name2 = "Oscar Oxford";
            $enrollment1 = "2015-11-04";
            $enrollment2 = "1992-04-24";
            $new_student1 = new Student($name1, $enrollment1);
            $new_student1->save();
            $new_student2 = new Student($name2, $enrollment2);
            $new_student2->save();
            $expected_output = [];
            //Act
            Student::deleteAll();
            $result = Student::getAll();
            //Assert
            $this->assertEquals($expected_output, $result);
        }

        function test_deleteOne()
        {
            //Arrange
            $name1 = "Brittanica Williams";
            $name2 = "Oscar Oxford";
            $enrollment1 = "2015-11-04";
            $enrollment2 = "1992-04-24";
            $new_student1 = new Student($name1, $enrollment1);
            $new_student1->save();
            $new_student2 = new Student($name2, $enrollment2);
            $new_student2->save();
            $expected_output = [$new_student1];
            //Act
            $new_student2->deleteOne();
            $result = Student::getAll();
            //Assert
            $this->assertEquals($expected_output, $result);
        }

        function test_update()

        {
            //arrange
            $name = "Advanced Owlature";
            $enrollment = "OWL_301";
            $new_student = new Student($name, $enrollment);
            $new_student->save();
            $updated_name = "Brittanica Williams";
            $updated_student = "Owl_101";

            //act
            $new_student->update($updated_name, $updated_student);
            $curriculum = Student::getAll();
            $result = $curriculum[0]->getName();
            $expected_output = $updated_name;
            //assert
            $this->assertEquals($expected_output, $result);
        }

    }
?>

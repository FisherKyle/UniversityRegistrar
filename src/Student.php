<?php
    class Student
    {
        private $name;
        private $enrollment;
        private $id;

        function __construct($name, $enrollment, $id = null)
            {
                $this->name = $name;
                $this->enrollment = $enrollment;
                $this->id = $id;
            }

// ---- GET * SET ---- //

        function getName()
        {
            return $this->name;
        }

        function getEnrollment()
        {
            return $this->enrollment;
        }

        function getId()
        {
            return $this->id;
        }

        function setName($new_name)
        {
            $this->name = (string) $new_name;
        }

        function setEnrollment($new_enrollment)
        {
            $this->enrollment = (string) $new_enrollment;
        }

        static function getAll()
        {
            $returned_students = $GLOBALS['DB']->query("SELECT * FROM students;");
            $students = array();
            foreach ($returned_students as $student)
            {
                $name = $student['name'];
                $enrollment = $student['enrollment'];
                $id = $student['C_Id'];
                $new_student = new Student($name, $enrollment, $id);
            array_push($students, $new_student);
            }
            return $students;
        }

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO students (name, enrollment) VALUES ('{$this->getName()}', '{$this->getEnrollment()}')");
            $this->id = (int) $GLOBALS['DB']->lastInsertId();
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM students;");
        }

        function deleteOne()
        {
            $GLOBALS['DB']->exec("DELETE FROM students WHERE C_Id = {$this->getId()};");
        }

        function update($new_name, $new_enrollment)
        {
            $GLOBALS['DB']->exec("UPDATE students SET name = '{$new_name}' WHERE C_Id = {$this->getId()};");
            $this->setName($new_name);
            $GLOBALS['DB']->exec("UPDATE students SET enrollment = '{$new_enrollment}' WHERE C_Id = {$this->getId()};");
            $this->setEnrollment($new_enrollment);
        }

        static function find()
        {

        }

        function getStudent()
        {

        }



    }
?>

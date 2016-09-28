<?php
    class Course
    {
        private $name;
        private $class;
        private $id;

        function __construct($name, $class, $id = null)
            {
                $this->name = $name;
                $this->class = $class;
                $this->id = $id;
            }

// ---- GET * SET ---- //

        function getName()
        {
            return $this->name;
        }

        function getClass()
        {
            return $this->class;
        }

        function getId()
        {
            return $this->id;
        }

        function setName($new_name)
        {
            $this->name = (string) $new_name;
        }

        function setClass($new_class)
        {
            $this->class = (string) $new_class;
        }

        static function getAll()
        {
            $returned_courses = $GLOBALS['DB']->query("SELECT * FROM courses;");
            $courses = array();
            foreach ($returned_courses as $course)
            {
                $name = $course['name'];
                $class = $course['class'];
                $id = $course['C_Id'];
                $new_course = new Course($name, $class, $id);
            array_push($courses, $new_course);
            }
            return $courses;
        }

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO courses (name, class) VALUES ('{$this->getName()}', '{$this->getClass()}')");
            $this->id = (int) $GLOBALS['DB']->lastInsertId();
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM courses;");
        }

        function deleteOne()
        {
            $GLOBALS['DB']->exec("DELETE FROM courses WHERE C_Id = {$this->getId()};");
        }

        function update($new_name, $new_class)
        {
            $GLOBALS['DB']->exec("UPDATE courses SET name = '{$new_name}' WHERE C_Id = {$this->getId()};");
            $this->setName($new_name);
            $GLOBALS['DB']->exec("UPDATE courses SET class = '{$new_class}' WHERE C_Id = {$this->getId()};");
            $this->setClass($new_class);
        }

        static function find()
        {

        }

        function getStudent()
        {

        }



    }
?>

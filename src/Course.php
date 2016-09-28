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

        function save()
        {

        }

        static function getAll()
        {

        }

        static function deleteAll()
        {

        }

        function deleteOne()
        {

        }

        function update()
        {

        }

        static function find()
        {

        }

        function getStudent()
        {

        }



    }
?>

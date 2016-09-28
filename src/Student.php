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

        function getCourse()
        {

        }

    }
?>

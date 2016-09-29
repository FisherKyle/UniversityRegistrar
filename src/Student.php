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

        function addCourse($new_course)
        {
            $GLOBAL['DB']->exec("INSERT INTO curriculum (fk_courses, fk_students) VALUES ({$new_course->getId()}, {$this->getId()});");
        }

        function getCourse()
        {
            $returned_courses = $GLOBALS['DB']->query("SELECT courses.* FROM students
                JOIN curriculum ON (curriculum.S_Id = students.S_Id)
                JOIN courses ON (courses.C_Id = curriculum.C_Id)
                WHERE students.S_Id = {$this->getId()};");
            $courses = array();
            foreach($returned_courses as $course)
            {
                $name = $course['name'];
                $class = $course['class'];
                $id = $course['C_Id'];
                $new_course = new Course($name, $class, $id);
                array_push($courses, $new_course);
            }
            return $courses;
        }


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
                $id = $student['S_Id'];
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
            $GLOBALS['DB']->exec("DELETE FROM students WHERE S_Id = {$this->getId()};");
        }

        function update($new_name, $new_enrollment)
        {
            $GLOBALS['DB']->exec("UPDATE students SET name = '{$new_name}' WHERE S_Id = {$this->getId()};");
            $this->setName($new_name);
            $GLOBALS['DB']->exec("UPDATE students SET enrollment = '{$new_enrollment}' WHERE S_Id = {$this->getId()};");
            $this->setEnrollment($new_enrollment);
        }

        static function find($search_id)
        {
            $found_student = null;
            $students = Student::getAll();
            foreach($students as $student){
                $S_Id = $student->getId();
                if($S_id == $search_id){
                    $found_student = $student;
                }
            }
            return $found_student;
        }




    }
?>

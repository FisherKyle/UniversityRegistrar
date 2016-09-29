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

        function deleteStudentFromCourse($student)
        {
            $GLOBALS['DB']->exec("DELETE FROM curriculum WHERE fk_courses = {$this->getId()} AND fk_students = {$student->getId()};");
        }

        function update($new_name, $new_class)
        {
            $GLOBALS['DB']->exec("UPDATE courses SET name = '{$new_name}' WHERE C_Id = {$this->getId()};");
            $this->setName($new_name);
            $GLOBALS['DB']->exec("UPDATE courses SET class = '{$new_class}' WHERE C_Id = {$this->getId()};");
            $this->setClass($new_class);
        }

        function addStudent($new_student)
        {
            $GLOBALS['DB']->exec("INSERT INTO curriculum (fk_courses, fk_students) VALUES ({$this->getId()}, {$new_student->getId()});");
        }

        function getStudents()
        {
            $returned_students = $GLOBALS['DB']->query("SELECT students.* FROM courses
                JOIN curriculum ON (curriculum.fk_courses = courses.C_Id)
                JOIN students ON (students.S_Id = curriculum.fk_students)
                WHERE courses.C_Id = {$this->getId()};");
            $students = array();
            foreach($returned_students as $student)
            {
                $name = $student['name'];
                $enrollment = $student['enrollment'];
                $id = $student['S_Id'];
                $new_student = new Student($name, $enrollment, $id);
                array_push($students, $new_student);
            }
            return $students;
        }

        static function find($search_id)
        {
            $found_course = null;
            $courses = Course::getAll();
            foreach($courses as $course){
                $C_Id = $course->getId();
                if($C_Id == $search_id){
                    $found_course = $course;
                }
            }
            return $found_course;
        }

    }
?>

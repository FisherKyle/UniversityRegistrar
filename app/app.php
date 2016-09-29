<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once __DIR__."/../src/Course.php";
    require_once __DIR__."/../src/Student.php";
    require_once __DIR__."/../vendor/autoload.php";

    $app = new Silex\Application();

    $server = 'mysql:host=localhost:8889;dbname=university';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../views'
    ));

    $app->get("/", function() use($app){
        return $app['twig']->render('home.html.twig', array('courses'=>Course::getAll(), 'students'=>Student::getAll()));
    });

    $app->get("/courses_page", function() use($app){
        return $app['twig']->render('courses_page.html.twig');
    });

    $app->get("/students_page", function() use($app){
        return $app['twig']->render('students_page.html.twig');
    });

    $app->post("/add_course", function() use($app){
        $name=$_POST['course_name'];
        $class=$_POST['course_reference'];
        $new_course=new Course($name, $class);
        $new_course->save();
        return $app['twig']->render('home.html.twig', array('courses'=>Course::getAll(), 'students'=>Student::getAll()));
    });

    $app->post("/add_student", function() use($app){
        $name=$_POST['student_name'];
        $enrollment=$_POST['student_enrollment'];
        $new_student=new Student($name, $enrollment);
        $new_student->save();
        return $app['twig']->render('home.html.twig', array('courses'=>Course::getAll(), 'students'=>Student::getAll()));
    });

    $app->get("/courses/{id}", function($id) use($app){
        $current_course=Course::find($id);
        return $app['twig']->render('courses_page.html.twig', array('course'=>$current_course, 'students'=>Student::getAll()));
    });

    $app->get("/students/{id}", function($id) use($app){
        $current_student=Student::find($id);
        return $app['twig']->render('students_page.html.twig', array('student'=>$current_student, 'courses'=>Course::getAll()));
    });

    $app->post("/courses/{id}/add_student", function($id) use($app){
        $current_course=Course::find($id);
        $students = Student::getAll();
        $new_studentId = $_POST['student_select'];
        $new_student = null;
        foreach($students as $student)
        {
          if($student->getId() == $new_studentId)
          {
            $new_student = $student;
          }
        }
        $current_course->addStudent($new_student);
        return $app['twig']->render('courses_page.html.twig', array('course'=>$current_course, 'students'=>Student::getAll()));
    });

    $app->delete("/courses/{id}/remove_student/{id2}", function($id, $id2) use($app){
        $current_course=Course::find($id);
        $target_student=Student::find($id2);
        $students=Student::getAll();
        $current_course->deleteStudentFromCourse($target_student);
        return $app['twig']->render('courses_page.html.twig', array('course'=>$current_course, 'students'=>Student::getAll()));
    });

    return $app;


?>

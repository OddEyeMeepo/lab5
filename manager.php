<?php
    include ("./interfaces/IReadWritable.php");
    include ("./classes/CourseManager.php");
    include ("./classes/Course.php");
    include ("./classes/LocalReadWriter.php");

    $courseManager = new CourseManager("Raymond",new LocalReadWriter());
    $list = get_list();

    if(isset($_POST["course_name"])==true){
        global $list;
        $sanitized = trim($_POST["course_name"]);
        $hasAlready = false;
        for($x=0;$x<count($list);$x++){
            if($list[$x]['courseName']==$sanitized){
                $hasAlready=true;
            }
        }

        if(!$hasAlready){
            //add course
            $course = new Course($_POST["course_name"],false);
            $courseManager->addCourse($course);
        }
        header("Location: index.php");
    }

    function get_list(){
        global $courseManager;
        return $courseManager->getCourses();
    }
    function deleteCourse($id){
        global $courseManager;
        $courseManager->deleteCourse($id);
        header("Location: index.php");
    }
    function updateCompletion($id, $bool){
        global $courseManager;
        $courseManager->completeCourse($id,$bool);
    }

    function updateCourseName($oldName, $newName){
        global $courseManager;
        $courseManager->updateCourseName($oldName,$newName);
    }
    
    
    //handle delete
    foreach ($_POST as $key => $value) {
        for($x=0;$x<count($list);$x++){
            $key_cleaned = str_replace("_"," ", $key);            
            
            if($list[$x]['courseName']==$key_cleaned){
                deleteCourse($key_cleaned);
                header("Location: index.php");
            }
        }
    }
    //handle updateComplete and updateCourseName
    for($x=0;$x<count($list);$x++){
        if(isset($_POST['courseName]'])==true)
        {
            if($list[$x]['courseName']==$_POST['courseName'] && isset($_POST["completed"])==true){
                updateCompletion($_POST['courseName'],$_POST["completed"]);
                
            }
            if($list[$x]['courseName']==$_POST['courseName'] && isset($_POST["newCourseName"])==true){
                updateCourseName($_POST['courseName'],$_POST["newCourseName"]);
            }
        }
    }

    
    const FILE_TYPE = "image/jpeg";
    const FILE_TYPE2 = "image/jpg";
    const FILE_TYPE3 = "image/png";

    if(isset($_FILES["fileToUpload"])==true){
        if($_FILES["fileToUpload"]["type"] == FILE_TYPE || FILE_TYPE2 || FILE_TYPE3)
        {
            move_uploaded_file($_FILES["fileToUpload"]["tmp_name"],"images/banner.jpg");
            header("Location: index.php");
        }
        else {
            echo "Invalid image to upload";
            exit;
        }
    }

?>

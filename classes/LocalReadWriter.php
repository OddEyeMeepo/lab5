<?php 

class LocalReadWriter implements IReadWritable{

    public function getCourses(){
        $course_list = [];
        if( file_exists("courses.json"))
        {
            $courses = file_get_contents("courses.json");
            $course_list = json_decode($courses,true); 

        }
        return $course_list;
    }

    public function addCourse($course){

        //write to file
        $list = $this->getCourses();
        $list[] = $course;
        $json = json_encode($list,JSON_PRETTY_PRINT);
        file_put_contents("courses.json",$json);
        $course_name = $course->get_name();
        return $course_name. " has been added";
    }

    public function deleteCourse($id){
        $list = $this->getCourses();
        for($x=0;$x<count($list);$x++){
            if ($list[$x]['courseName']==trim($id)){
                unset($list[$x]);
                $list = array_values($list);
            }
        }
        file_put_contents("courses.json",json_encode($list, JSON_PRETTY_PRINT));
    }

    public function completeCourse($id , $bool ){
        $list = $this->getCourses();
        for($x=0;$x<count($list);$x++){
            if ($list[$x]['courseName']==trim($id)){
                $list[$x]['completed'] = filter_var($bool, FILTER_VALIDATE_BOOLEAN);
                $list = array_values($list);
            }
        }
        file_put_contents("courses.json",json_encode($list, JSON_PRETTY_PRINT));
    }

    public function updateCourseName($id, $str){
        $list = $this->getCourses();
        for($x=0;$x<count($list);$x++){
            if ($list[$x]['courseName']==trim($id)){
                var_dump($str);
                $list[$x]['courseName']=$str;
                $list = array_values($list);
            }
        }
        file_put_contents("courses.json",json_encode($list, JSON_PRETTY_PRINT));
    }
}
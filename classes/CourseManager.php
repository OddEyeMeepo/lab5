<?php

class CourseManager {
    private string $username;
    private $persister;
    public array $courses = [];

    public function __construct($username, $persister){
        $this->username = $username;
        $this->persister = $persister;
    }

    public function getCourses(){
        return $this->persister->getCourses();
    }

    public function addCourse($course){
        $this->persister->addCourse($course);
    }

    public function deleteCourse($id){
        $this->persister->deleteCourse($id);
    }

    public function completeCourse($id, $bool){
        $this->persister->completeCourse($id, $bool);
    }
    public function updateCourseName($oldName,$newName){
        $this->persister->updateCourseName($oldName,$newName);
    }
}
?>

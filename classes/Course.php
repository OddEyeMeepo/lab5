<?php
class Course {
    public string $courseName;
    public bool $completed;
    
    public function __construct(string $name, bool $completed){
        $this->set_name($name);
        $this->set_completed($completed);
    }
    public function set_name (String $name){
        $this->courseName =  $name;
    }
    public function get_name (){
        return $this->courseName;
    }
    public function set_completed(bool $comp){
        $this->completed = $comp;
    }
    public function get_completed(){
        return $this->completed;
    }
}
?>
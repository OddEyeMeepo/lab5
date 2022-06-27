<?php 

interface IReadWritable{
    public function getCourses();
    public function addCourse(Course $course);
    public function deleteCourse(string $id);
    public function completeCourse(string $id, bool $bool);
}
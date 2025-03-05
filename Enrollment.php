<?php
class Enrollment {
    private $student;
    private $course;
    private $db;

    public function __construct($student, $course, $db) {
        $this->student = $student;
        $this->course = $course;
        $this->db = $db;
    }

    public function enroll() {
        $query = "INSERT INTO enrollments (studentID, courseID) VALUES (?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ii", $this->student->getStudentID(), $this->course->getCourseInfo()['courseID']);
        return $stmt->execute();
    }

    public function drop() {
        $query = "DELETE FROM enrollments WHERE studentID = ? AND courseID = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ii", $this->student->getStudentID(), $this->course->getCourseInfo()['courseID']);
        return $stmt->execute();
    }
}
?>

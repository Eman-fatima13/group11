<?php
class Grade {
    private $student;
    private $course;
    private $assignmentMarks;
    private $quizMarks;
    private $examMarks;
    private $db;

    public function __construct($student, $course, $assignmentMarks, $quizMarks, $examMarks, $db) {
        $this->student = $student;
        $this->course = $course;
        $this->assignmentMarks = $assignmentMarks;
        $this->quizMarks = $quizMarks;
        $this->examMarks = $examMarks;
        $this->db = $db;
    }

    public function inputGrade() {
        $query = "INSERT INTO grades (studentID, courseID, assignmentMarks, quizMarks, examMarks) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("iiddd", $this->student->getStudentID(), $this->course->getCourseInfo()['courseID'], $this->assignmentMarks, $this->quizMarks, $this->examMarks);
        return $stmt->execute();
    }

    public function calculateFinalGrade() {
        return ($this->assignmentMarks * 0.3) + ($this->quizMarks * 0.2) + ($this->examMarks * 0.5);
    }

    public function viewGradeReport($studentID, $courseID) {
        $query = "SELECT assignmentMarks, quizMarks, examMarks FROM grades WHERE studentID = ? AND courseID = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ii", $studentID, $courseID);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
}
?>

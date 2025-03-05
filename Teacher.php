<?php
class Teacher {
    private $teacherID;
    private $name;
    private $email;
    private $subject;
    private $db;

    public function __construct($teacherID, $name, $email, $subject, $db) {
        $this->teacherID = $teacherID;
        $this->name = $name;
        $this->email = $email;
        $this->subject = $subject;
        $this->db = $db;
    }

    public function markAttendance($studentID, $date, $status) {
        $query = "INSERT INTO attendance (studentID, teacherID, date, status) VALUES (?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("iiss", $studentID, $this->teacherID, $date, $status);
        return $stmt->execute();
    }

    public function inputGrades($studentID, $courseID, $assignmentMarks, $quizMarks, $examMarks) {
        $query = "INSERT INTO grades (studentID, courseID, assignmentMarks, quizMarks, examMarks) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("iiddd", $studentID, $courseID, $assignmentMarks, $quizMarks, $examMarks);
        return $stmt->execute();
    }

    public function viewStudentProgress($studentID) {
        $query = "SELECT * FROM grades WHERE studentID = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $studentID);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function sendNotification($studentID, $message) {
        $query = "INSERT INTO notifications (senderID, receiverID, message) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("iis", $this->teacherID, $studentID, $message);
        return $stmt->execute();
    }
}
?>

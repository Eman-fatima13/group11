<?php
class Attendance {
    private $student;
    private $date;
    private $status;
    private $db;

    public function __construct($student, $date, $status, $db) {
        $this->student = $student;
        $this->date = $date;
        $this->status = $status;
        $this->db = $db;
    }

    public function markAttendance() {
        $query = "INSERT INTO attendance (studentID, date, status) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("iss", $this->student->getStudentID(), $this->date, $this->status);
        return $stmt->execute();
    }

    public function getAttendanceReport($studentID) {
        $query = "SELECT date, status FROM attendance WHERE studentID = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $studentID);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
?>

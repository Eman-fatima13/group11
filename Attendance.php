<?php
include 'config.php';

class Attendance {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    // Mark attendance for a student
    public function markAttendance($studentID, $date, $status) {
        $query = "INSERT INTO attendance (studentID, date, status) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("iss", $studentID, $date, $status);
        return $stmt->execute();
    }

    // Get attendance report for a student
    public function getAttendanceReport($studentID) {
        $query = "SELECT date, status FROM attendance WHERE studentID = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $studentID);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}

// Example usage
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $attendance = new Attendance($conn);

    $studentID = $_POST['studentID'];
    $date = date("Y-m-d");
    $status = $_POST['status'];

    if ($attendance->markAttendance($studentID, $date, $status)) {
        echo "Attendance marked successfully!";
    } else {
        echo "Error marking attendance.";
    }
}
?>
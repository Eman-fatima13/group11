<?php
include 'config.php';
class Administrator {
    private $adminID;
    private $name;
    private $email;
    private $role;
    private $db;

    public function __construct($adminID, $name, $email, $role, $db) {
        $this->adminID = $adminID;
        $this->name = $name;
        $this->email = $email;
        $this->role = $role;
        $this->db = $db;
    }

    public function registerStudent($studentID, $name, $email, $phone) {
        $query = "INSERT INTO students (studentID, name, email, phone) VALUES (?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("isss", $studentID, $name, $email, $phone);
        return $stmt->execute();
    }

    public function manageAccounts($userID, $newEmail) {
        $query = "UPDATE users SET email = ? WHERE userID = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("si", $newEmail, $userID);
        return $stmt->execute();
    }

    public function generateReports() {
        $query = "SELECT * FROM attendance";
        $result = $this->db->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function assignCourses($teacherID, $courseID) {
        $query = "INSERT INTO course_assignments (teacherID, courseID) VALUES (?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ii", $teacherID, $courseID);
        return $stmt->execute();
    }
}
?>

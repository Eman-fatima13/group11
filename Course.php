<?php
class Course {
    private $courseID;
    private $courseName;
    private $teacher;
    private $db;

    public function __construct($courseID, $courseName, $teacher, $db) {
        $this->courseID = $courseID;
        $this->courseName = $courseName;
        $this->teacher = $teacher;
        $this->db = $db;
    }

    public function assignTeacher($teacherID) {
        $query = "UPDATE courses SET teacherID = ? WHERE courseID = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ii", $teacherID, $this->courseID);
        return $stmt->execute();
    }

    public function updateCourseInfo($newName) {
        $query = "UPDATE courses SET courseName = ? WHERE courseID = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("si", $newName, $this->courseID);
        return $stmt->execute();
    }

    public function getCourseInfo() {
        return [
            'courseID' => $this->courseID,
            'courseName' => $this->courseName,
            'teacher' => $this->teacher
        ];
    }
}
?>

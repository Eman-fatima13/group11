<?php
include 'config.php'; // Database connection

if (isset($_GET['studentID'])) {
    $studentID = (int)$_GET['studentID'];

    $query = "SELECT courses.courseName, grades.assignmentMarks, grades.quizMarks, grades.examMarks 
              FROM grades 
              JOIN courses ON grades.courseID = courses.courseID 
              WHERE grades.studentID = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $studentID);
    $stmt->execute();
    $result = $stmt->get_result();

    $grades = [];
    while ($row = $result->fetch_assoc()) {
        $grades[] = $row;
    }

    echo json_encode($grades);
} else {
    echo json_encode([]);
}

$conn->close();
?>

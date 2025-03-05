<?php
include 'config.php'; // Database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $studentID = $_POST['studentID'];
    $courseID = $_POST['courseID'];
    $assignmentMarks = $_POST['assignmentMarks'];
    $quizMarks = $_POST['quizMarks'];
    $examMarks = $_POST['examMarks'];

    $query = "INSERT INTO grades (studentID, courseID, assignmentMarks, quizMarks, examMarks) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("iiddd", $studentID, $courseID, $assignmentMarks, $quizMarks, $examMarks);

    if ($stmt->execute()) {
        echo "Grades submitted successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }
} else {
    echo "Invalid request.";
}

$conn->close();
?>
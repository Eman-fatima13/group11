<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $courseID = $_POST['course'];
    $assignmentMarks = $_POST['assignmentMarks'] ?? [];
    $quizMarks = $_POST['quizMarks'] ?? [];
    $examMarks = $_POST['examMarks'] ?? [];

    foreach ($assignmentMarks as $studentID => $assignmentMark) {
        $quizMark = $quizMarks[$studentID] ?? 0;
        $examMark = $examMarks[$studentID] ?? 0;

        // Insert grades into the database
        $query = "INSERT INTO grades (studentID, courseID, assignmentMarks, quizMarks, examMarks) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("iiddd", $studentID, $courseID, $assignmentMark, $quizMark, $examMark);

        if ($stmt->execute()) {
            echo "Grades submitted for Student ID: $studentID.<br>";
        } else {
            echo "Error submitting grades for Student ID: $studentID.<br>";
        }
    }
} else {
    echo "Invalid request.";
}

$conn->close();
?>
<?php
include 'config.php';

if (isset($_GET['courseID'])) {
    $courseID = (int)$_GET['courseID'];

    // Fetch students for the selected course
    $query = "SELECT studentID, name FROM students WHERE courseID = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $courseID);
    $stmt->execute();
    $result = $stmt->get_result();

    $students = [];
    while ($row = $result->fetch_assoc()) {
        $students[] = $row;
    }

    echo json_encode($students);
} else {
    echo json_encode([]);
}

$conn->close();
?>
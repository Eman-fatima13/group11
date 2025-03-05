<?php
include 'config.php'; // Database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $studentID = $_POST['studentID'];
    $courseID = $_POST['courseID'];

    $query = "INSERT INTO enrollments (studentID, courseID) VALUES (?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $studentID, $courseID);

    if ($stmt->execute()) {
        echo "Enrollment successful.";
    } else {
        echo "Error: " . $stmt->error;
    }
} else {
    echo "Invalid request.";
}

$conn->close();
?>
<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $attendance = $_POST['attendance'];
    $date = date("Y-m-d"); // Automatically add the current date

    foreach ($attendance as $studentID => $status) {
        // Insert attendance record into the database
        $query = "INSERT INTO attendance (studentID, date, status) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("iss", $studentID, $date, $status);

        if ($stmt->execute()) {
            echo "Attendance marked for Student ID: $studentID.<br>";
        } else {
            echo "Error marking attendance for Student ID: $studentID.<br>";
        }
    }
} else {
    echo "Invalid request.";
}

$conn->close();
?>
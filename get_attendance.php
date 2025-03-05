<?php
include 'config.php'; // Database connection

if (isset($_GET['studentID'])) {
    $studentID = (int)$_GET['studentID'];

    $query = "SELECT date, status FROM attendance WHERE studentID = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $studentID);
    $stmt->execute();
    $result = $stmt->get_result();

    $attendance = [];
    while ($row = $result->fetch_assoc()) {
        $attendance[] = $row;
    }

    echo json_encode($attendance);
} else {
    echo json_encode([]);
}

$conn->close();
?>
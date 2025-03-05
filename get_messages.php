<?php
session_start();
include 'config.php'; // Database connection

if (isset($_SESSION['userID'])) {
    $receiverID = $_SESSION['userID']; // Use session-based receiver ID

    $query = "SELECT sender, messageText, timestamp FROM communication WHERE receiver = ? ORDER BY timestamp DESC";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $receiverID);
    $stmt->execute();
    $result = $stmt->get_result();

    $messages = [];
    while ($row = $result->fetch_assoc()) {
        $messages[] = $row;
    }

    echo json_encode($messages);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Not logged in.']);
}

$conn->close();
?>
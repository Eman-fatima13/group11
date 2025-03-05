<?php
session_start();
include 'config.php'; // Database connection

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['userID'])) {
    $data = json_decode(file_get_contents('php://input'), true);

    $senderID = $_SESSION['userID']; // Use session-based sender ID
    $receiverID = $data['receiverID'];
    $messageText = $data['messageText'];
    $timestamp = date("Y-m-d H:i:s");

    $query = "INSERT INTO communication (sender, receiver, messageText, timestamp) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssss", $senderID, $receiverID, $messageText, $timestamp);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => $stmt->error]);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request or not logged in.']);
}

$conn->close();
?>
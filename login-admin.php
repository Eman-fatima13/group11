<?php
session_start();
include 'config.php'; // Database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validate credentials (replace with your actual validation logic)
    $query = "SELECT adminID FROM administrators WHERE username = ? AND password = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['userID'] = $row['adminID']; // Store admin ID in session
        $_SESSION['role'] = 'admin'; // Store role in session
        header("Location: dashboard-admin.html"); // Redirect to admin dashboard
    } else {
        echo "Invalid credentials.";
    }
} else {
    echo "Invalid request.";
}

$conn->close();
?>
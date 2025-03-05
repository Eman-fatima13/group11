<?php
// Include database connection
include 'config.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['register'])) {
    // Retrieve form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];

    // Validate form data
    if (empty($name) || empty($email) || empty($subject)) {
        die("All fields are required.");
    }

    // Prepare SQL query
    $query = "INSERT INTO teachers (name, email, subject) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);

    if ($stmt === false) {
        die("Error in preparing statement: " . $conn->error);
    }

    // Bind parameters and execute query
    $stmt->bind_param("sss", $name, $email, $subject);

    if ($stmt->execute()) {
        echo "Teacher registered successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request.";
}
?>

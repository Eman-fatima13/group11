<?php
// Include the database connection file
include 'config.php';

// Check if form is submitted and "register" button is clicked
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['register'])) {
    // Retrieve form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $fscMarks = $_POST['fsc-marks'];
    $gender = $_POST['gender'];
    $department = $_POST['department'];
    $course = $_POST['courses'];
    $feeSubmission = isset($_POST['fee-submission']) ? 1 : 0; // Checkbox value

    // Validate data (ensure no empty fields)
    if (empty($name) || empty($email) || empty($contact) || empty($fscMarks) || empty($gender) || empty($department) || empty($course)) {
        die("All fields are required.");
    }

    // Prepare SQL query
    $query = "INSERT INTO students (name, email, contact, fsc_marks, gender, department, course, fee_submission) 
              VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    
    if ($stmt === false) {
        die("Error in preparing statement: " . $conn->error);
    }

    // Bind parameters (sssdsssi: string, string, string, decimal, string, string, string, int)
    $stmt->bind_param("sssdsssi", $name, $email, $contact, $fscMarks, $gender, $department, $course, $feeSubmission);

    // Execute query
    if ($stmt->execute()) {
        echo "Student registered successfully!";
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

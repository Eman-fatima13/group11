<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Input Grades</title>
  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background: #ecf0f1;
      display: flex;
      flex-direction: column;
      align-items: center;
      height: 100vh;
      padding-left: 50px;
    }
    header {
      background: #0A1828;
      color: white;
      padding: 15px;
      text-align: center;
      font-size: 20px;
      width: 100%;
    }
    .container {
      background: white;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
      width: 1000px;
      margin-top: 20px;
    }
    h2 {
      text-align: left;
      color: #0A1828;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }
    th, td {
      border: 1px solid #ccc;
      padding: 10px;
      text-align: left;
    }
    th {
      background: #0A1828;
      color: white;
    }
    tr:nth-child(even) {
      background: #d1ecf1;
    }
    tr:nth-child(odd) {
      background: white;
    }
    .submit-btn {
      width: 100%;
      background: #0A1828;
      color: #BFA181;
      border: none;
      padding: 12px;
      border-radius: 5px;
      cursor: pointer;
      font-size: 18px;
      margin-top: 20px;
    }
    .submit-btn:hover {
      background: #0056b3;
    }
    img {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      position: absolute;
      left: 20px;
      margin-top: 20px;
    }
  </style>
</head>
<body>
  <header style="color:#BFA181">
    <img src="https://i.pinimg.com/474x/57/eb/db/57ebdba0a0b36b5bc013bd84c69c0a2c.jpg" alt="School Logo" />
    Input Grades
  </header>
  <div class="container">
    <h2>Input Grades</h2>
    <form action="submit_grades.php" method="POST">
      <label for="course">Select Course:</label>
      <select id="course" name="course" required>
        <option value="1">Fundamental Programming</option>
        <option value="2">Data Structures</option>
        <option value="3">Object-Oriented Programming</option>
      </select>
      <table>
        <tr>
          <th>#</th>
          <th>Student Name</th>
          <th>Assignment Marks</th>
          <th>Quiz Marks</th>
          <th>Exam Marks</th>
        </tr>
        <?php
        include 'config.php';

        // Fetch all students for the selected course
        if (isset($_POST['course'])) {
            $courseID = $_POST['course'];
            $query = "SELECT students.studentID, students.name 
                      FROM students 
                      WHERE students.course = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("i", $courseID);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "
                    <tr>
                      <td>{$row['studentID']}</td>
                      <td>{$row['name']}</td>
                      <td><input type='number' name='assignmentMarks[{$row['studentID']}]' step='0.01' required></td>
                      <td><input type='number' name='quizMarks[{$row['studentID']}]' step='0.01' required></td>
                      <td><input type='number' name='examMarks[{$row['studentID']}]' step='0.01' required></td>
                    </tr>
                    ";
                }
            } else {
                echo "<tr><td colspan='5'>No students registered for this course.</td></tr>";
            }
        }
        $conn->close();
        ?>
      </table>
      <button type="submit" name="submit-btn" class="submit-btn">Submit Grades</button>
    </form>
  </div>
</body>
</html>
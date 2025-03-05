<?php
include 'config.php'; // Database connection

// Fetch students from the database
$sql = "SELECT id, name FROM students";
$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mark Attendance</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <header>Mark Student Attendance</header>
  <div class="container">
    <h2>Student Attendance</h2>
    <form action="submit_attendance.php" method="POST">
      <table>
        <tr>
          <th>#</th>
          <th>Student Name</th>
          <th>Attendance</th>
        </tr>
        <?php 
        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['name']}</td>
                    <td class='radio-group'>
                      <label><input type='radio' name='attendance[{$row['id']}]' value='1'> Present</label>
                      <label><input type='radio' name='attendance[{$row['id']}]' value='0'> Absent</label>
                    </td>
                  </tr>";
          }
        } else {
          echo "<tr><td colspan='3'>No students found.</td></tr>";
        }
        ?>
      </table>
      <button type="submit" class="submit-btn">Submit Attendance</button>
    </form>
  </div>
</body>
</html>
<?php $conn->close(); ?>

<?php
include 'config.php'; // Database connection

$query = "SELECT studentID, studentName FROM students";
$result = $conn->query($query);
?>

<form method="POST" action="submit_attendance.php">
    <table border="1">
        <tr>
            <th>Student Name</th>
            <th>Status</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $row['studentName']; ?></td>
                <td>
                    <input type="hidden" name="attendance[<?php echo $row['studentID']; ?>]" value="0">
                    <input type="checkbox" name="attendance[<?php echo $row['studentID']; ?>]" value="1"> Present
                </td>
            </tr>
        <?php } ?>
    </table>
    <button type="submit" name="submit-btn">Submit Attendance</button>
</form>
<?php
include 'config.php'; // Database connection

$query = "SELECT studentID, name FROM students";
$result = $conn->query($query);
?>

<form method="POST" action="submit_attendance.php">
    <table border="1">
        <tr>
            <th>Student Name</th>
            <th>Status</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $row['studentName']; ?></td>
                <td>
                    <input type="hidden" name="attendance[<?php echo $row['studentID']; ?>]" value="0">
                    <input type="checkbox" name="attendance[<?php echo $row['studentID']; ?>]" value="1"> Present
                </td>
            </tr>
        <?php } ?>
    </table>
    <button type="submit" name="submit-btn">Submit Attendance</button>
</form>

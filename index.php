<?php
include 'db.php';

// Fetch students
$sql_students = "SELECT * FROM students";
$result_students = $conn->query($sql_students);

// Fetch classes
$sql_classes = "SELECT * FROM classes";
$result_classes = $conn->query($sql_classes);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Attendance System</title>
    <!-- Add any CSS links or styles here -->
</head>
<body>
    <h2>Mark Attendance</h2>
    <form action="submit_attendance.php" method="post">
        <label for="student">Select Student:</label>
        <select name="student" id="student">
            <?php
            while ($row_students = $result_students->fetch_assoc()) {
                echo "<option value='" . $row_students['id'] . "'>" . $row_students['name'] . "</option>";
            }
            ?>
        </select>
        <br><br>
        <label for="class">Select Class:</label>
        <select name="class" id="class">
            <?php
            while ($row_classes = $result_classes->fetch_assoc()) {
                echo "<option value='" . $row_classes['id'] . "'>" . $row_classes['name'] . "</option>";
            }
            ?>
        </select>
        <br><br>
        <label for="status">Attendance Status:</label>
        <input type="radio" name="status" value="Present" checked> Present
        <input type="radio" name="status" value="Absent"> Absent
        <br><br>
        <input type="submit" value="Submit">
    </form>
</body>
</html>

<?php
// Close connection
$conn->close();
?>

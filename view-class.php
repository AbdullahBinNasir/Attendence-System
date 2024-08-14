<?php
include 'db.php';

// Assuming $class_id is already defined or fetched from input
// $sql = "SELECT id FROM classes";
// $result = $conn->query($sql);

// if ($result->num_rows > 0) {
//     // Fetching and displaying each class_id
//     while ($row = $result->fetch_assoc()) {
//         echo "Class ID: " . $row['id'] . "<br>";
//     }
// } else {
//     echo "No classes found.";
// }

$sqlss = "SELECT id FROM classes"; // Assuming 'id' is the primary key column name in the 'classes' table

$result = $conn->query($sqlss);

if ($result->num_rows > 0) {
    // Fetching the first row (assuming you expect only one result or want the first one)
    $row = $result->fetch_assoc();
    $class_id = $row['id']; // Storing class_id in the variable $class_id
    
   
} else {
    echo "No classes found.";
}


// Query to fetch attendance records for a specific class
$sql = "SELECT a.attendance_date, a.status, s.name AS student_name
        FROM attendance a
        JOIN students s ON a.student_id = s.id
        WHERE a.class_id = $class_id";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h2>Attendance Records for Class</h2>";
    echo "<table border='1'>
            <tr>
                <th>Attendance Date</th>
                <th>Student</th>
                <th>Status</th>
            </tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row['attendance_date'] . "</td>
                <td>" . $row['student_name'] . "</td>
                <td>" . $row['status'] . "</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "No attendance records found for this class.";
}

// Close connection
$conn->close();
?>
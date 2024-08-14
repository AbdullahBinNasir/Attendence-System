<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_id = $_POST['student'];
    $class_id = $_POST['class'];
    $status = $_POST['status'];
    
    // Insert into attendance table
    $sql_insert = "INSERT INTO attendance (student_id, class_id, attendance_date, status) 
                   VALUES ('$student_id', '$class_id', CURDATE(), '$status')";
    
    if ($conn->query($sql_insert) === TRUE) {
        echo "Attendance marked successfully";
    } else {
        echo "Error: " . $sql_insert . "<br>" . $conn->error;
    }
}

// Close connection
$conn->close();
?>

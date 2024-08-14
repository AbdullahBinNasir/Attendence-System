<!-- HTML Form -->
<form method="post">
    <label for="chosen_date">Choose Date:</label>
    <input type="date" id="chosen_date" name="chosen_date" required>
    <label for="student_id">Student ID:</label>
    <input type="text" id="student_id" name="student_id" required>
    <button type="submit">Fetch Attendance</button>
</form>

<?php
include 'db.php'; // Include your database connection script

// Check if form is submitted and handle the input
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize the input
    $chosen_date = trim($_POST['chosen_date']);
    $student_id = trim($_POST['student_id']);

    // Check if inputs are not empty
    if (!empty($chosen_date) && !empty($student_id)) {
        // Ensure student_id is an integer
        if (filter_var($student_id, FILTER_VALIDATE_INT) !== false) {
            // Prepare the SQL statement
            $stmt = $conn->prepare("SELECT a.attendance_date, a.status, c.name AS class_name
                                    FROM attendance a
                                    JOIN classes c ON a.class_id = c.id
                                    WHERE a.student_id = ? AND a.attendance_date = ?");
            $stmt->bind_param("is", $student_id, $chosen_date);

            // Execute the statement
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                echo "<h2>Attendance Records for Student ID: $student_id on $chosen_date</h2>";
                echo "<table border='1'>
                        <tr>
                            <th>Attendance Date</th>
                            <th>Class</th>
                            <th>Status</th>
                        </tr>";
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . htmlspecialchars($row['attendance_date']) . "</td>
                            <td>" . htmlspecialchars($row['class_name']) . "</td>
                            <td>" . htmlspecialchars($row['status']) . "</td>
                          </tr>";
                }
                echo "</table>";
            } else {
                echo "No attendance records found for Student ID: $student_id on $chosen_date.";
            }
            $stmt->close();
        } else {
            echo "Invalid Student ID.";
        }
    } else {
        echo "Both date and student ID are required.";
    }

    $conn->close(); // Close the database connection
}
?>

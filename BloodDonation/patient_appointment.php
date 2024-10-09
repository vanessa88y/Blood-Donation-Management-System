<?php
// Include the database connection file
include 'connection.php';
include 'patientnavbar.php';

// Start the session
session_start();


// Retrieve user's ID from session
$user_id = $_SESSION['id'];

// Fixed location
$appointment_location = 'Nyaduodo Dispensary';

// Handle form submission for scheduling or rescheduling appointments
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['schedule'])) {
        // Schedule a new appointment
        $appointment_date = $_POST['appointment_date'];
        
        $sql_schedule = "INSERT INTO appointments (user_id, role, appointment_date, location) 
                         VALUES ('$user_id', 'patient', '$appointment_date', '$appointment_location')";
        if ($con->query($sql_schedule) === TRUE) {
            echo "<p class='message'>Appointment scheduled successfully.</p>";
        } else {
            echo "<p class='error'>Error scheduling appointment: " . $con->error . "</p>";
        }
    } elseif (isset($_POST['reschedule'])) {
        // Reschedule an existing appointment
        $appointment_id = $_POST['appointment_id'];
        $new_appointment_date = $_POST['new_appointment_date'];
        
        $sql_reschedule = "UPDATE appointments SET appointment_date = '$new_appointment_date', status = 'Rescheduled' 
                           WHERE appointment_id = '$appointment_id' AND user_id = '$user_id'";
        if ($con->query($sql_reschedule) === TRUE) {
            echo "<p class='message'>Appointment rescheduled successfully.</p>";
        } else {
            echo "<p class='error'>Error rescheduling appointment: " . $con->error . "</p>";
        }
    } elseif (isset($_POST['cancel'])) {
        // Cancel an existing appointment
        $appointment_id = $_POST['appointment_id'];
        
        $sql_cancel = "UPDATE appointments SET status = 'Canceled' 
                       WHERE appointment_id = '$appointment_id' AND user_id = '$user_id'";
        if ($con->query($sql_cancel) === TRUE) {
            echo "<p class='message'>Appointment canceled successfully.</p>";
        } else {
            echo "<p class='error'>Error canceling appointment: " . $con->error . "</p>";
        }
    }
}

// Query to retrieve the patient's appointments
$sql_appointments = "SELECT * FROM appointments WHERE user_id = '$user_id' AND role = 'patient' ORDER BY appointment_date DESC";
$result_appointments = $con->query($sql_appointments);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Appointments</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        nav ul {
            background-color: brown;
            color: white;
            list-style-type: none;
            margin: 0;
            padding: 0;
            overflow: hidden;
        }
        nav ul li {
            float: right;
        }
        nav ul li a {
            display: block;
            color: black;
            text-align: center;
            padding: 10px 16px;
            text-decoration: none;
        }
        nav ul li a:hover {
            background-color: grey;
        }
        .container {
            margin: 50px;
        }
        h2 {
            text-align: center;
            color: #333;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="datetime-local"],
        button {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            opacity: 0.8;
        }
        .appointments-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .appointments-table th, .appointments-table td {
            padding: 15px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }
        .appointments-table th {
            background-color: #4CAF50;
            color: white;
        }
        .appointments-table tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .appointments-table tr:hover {
            background-color: #f5f5f5;
        }
        .message, .error {
            text-align: center;
            margin-top: 20px;
            font-weight: bold;
        }
        .message {
            color: #4CAF50;
        }
        .error {
            color: #f44336;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Schedule a New Appointment</h2>
        <form method="post" action="">
            <div class="form-group">
                <label for="appointment_date">Select Date and Time:</label>
                <input type="datetime-local" id="appointment_date" name="appointment_date" required>
                <label for="appointment_location">Location:</label>
    <input type="text" id="appointment_location" name="appointment_location" value="Nyaduodo Dispensary" readonly>
            </div>
            <button type="submit" name="schedule">Schedule Appointment</button>
        </form>

        <h2>Your Appointments</h2>
        <table class="appointments-table">
        <thead>
                <tr>
                    <th>Appointment Date</th>
                    <th>Status</th>
                    <th>Location</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result_appointments->num_rows > 0) {
                    while ($row = $result_appointments->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['appointment_date'] . "</td>";
                        echo "<td>" . $row['status'] . "</td>";
                        echo "<td>" . $row['location'] . "</td>"; // Display location
                        echo "<td>";
                        if ($row['status'] != 'Canceled') {
                            echo "<form method='post' action='' style='display:inline;'>";
                            echo "<input type='hidden' name='appointment_id' value='" . $row['appointment_id'] . "'>";
                            echo "<input type='datetime-local' name='new_appointment_date' required>";
                            echo "<button type='submit' name='reschedule'>Reschedule</button>";
                            echo "</form>";
                            echo "<form method='post' action='' style='display:inline;'>";
                            echo "<input type='hidden' name='appointment_id' value='" . $row['appointment_id'] . "'>";
                            echo "<button type='submit' name='cancel'>Cancel</button>";
                        } else {
                            echo "Canceled";
                        }
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No appointments found.</td></tr>"; // Adjust colspan for new column
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php
// Close the database connection
$con->close();
?>

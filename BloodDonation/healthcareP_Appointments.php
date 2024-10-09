<?php
include 'healthcareP_navbar.php';
session_start(); // Start session if not already started

// Check if user is logged in
if (!isset($_SESSION['id'])) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit();
}

// Include the database connection file
include 'connection.php';

// Fetch all appointments for donors and patients
$sqlAppointments = "SELECT appointments.appointment_id, users.name, users.phone, appointments.role, appointments.appointment_date, appointments.status 
                    FROM appointments 
                    INNER JOIN users ON appointments.user_id = users.id
                    ORDER BY appointments.appointment_date DESC";
$resultAppointments = $con->query($sqlAppointments);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Schedule</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        h1 {
            text-align: center;
            margin-top: 20px;
            color: #333;
        }

        nav {
            background-color: brown;
            color: #fff;
            overflow: hidden;
        }

        nav ul {
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
            background-color: white;
        }

        .container {
            margin: 20px;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .appointments-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .appointments-table th, .appointments-table td {
            padding: 15px;
            text-align: left;
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

        .status-canceled {
            color: red;
        }

        .status-confirmed {
            color: green;
        }

        .status-pending {
            color: orange;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Appointment Schedule</h1>
        <table class="appointments-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Role</th>
                    <th>Appointment Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($resultAppointments->num_rows > 0) {
                    while ($row = $resultAppointments->fetch_assoc()) {
                        // Determine the role and style
                        $role = ucfirst($row['role']); // Capitalize the role
                        $statusClass = '';
                        if ($row['status'] == 'Canceled') {
                            $statusClass = 'status-canceled';
                        } elseif ($row['status'] == 'Confirmed') {
                            $statusClass = 'status-confirmed';
                        } elseif ($row['status'] == 'Pending') {
                            $statusClass = 'status-pending';
                        }

                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['phone']) . "</td>";
                        echo "<td>" . htmlspecialchars($role) . "</td>";
                        echo "<td>" . htmlspecialchars($row['appointment_date']) . "</td>";
                        echo "<td class='" . htmlspecialchars($statusClass) . "'>" . htmlspecialchars($row['status']) . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No appointments found</td></tr>";
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

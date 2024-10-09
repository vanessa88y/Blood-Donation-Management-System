<?php
// Include the database connection file
include 'connection.php';
include 'adminnavbar.php';

// Handle form submission for accepting or denying blood requests
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['accept'])) {
        $request_id = $_POST['request_id'];

        // Update the request status to "Accepted"
        $update_sql = "UPDATE requests SET status = 'Accepted' WHERE request_id = $request_id";
        if ($con->query($update_sql) === TRUE) {
            echo "<p class='message'>Request accepted successfully.</p>";
        } else {
            echo "<p class='error'>Error accepting request: " . $con->error . "</p>";
        }
    } elseif (isset($_POST['deny'])) {
        $request_id = $_POST['request_id'];

        // Update the request status to "Denied"
        $update_sql = "UPDATE requests SET status = 'Denied' WHERE request_id = $request_id";
        if ($con->query($update_sql) === TRUE) {
            echo "<p class='message'>Request denied successfully.</p>";
        } else {
            echo "<p class='error'>Error denying request: " . $con->error . "</p>";
            echo "<p class='error'>SQL Query: $update_sql</p>";
        }
    }
}

// Query to retrieve blood request records
$requests_sql = "SELECT requests.request_id, requests.blood_group, requests.units, requests.status, users.name AS user_name 
                 FROM requests 
                 JOIN users ON requests.id = users.id 
                 ORDER BY requests.request_id DESC";

$requests_result = $con->query($requests_sql);

// Query to retrieve blood inventory
$inventory_sql = "SELECT blood_group, SUM(units) AS total_units 
                  FROM bloodinventory 
                  GROUP BY blood_group
                  ORDER BY FIELD(blood_group, 'A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-')";

$inventory_result = $con->query($inventory_sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blood Requests and Inventory</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        nav {
            background-color: #8B0000; /* Dark Red */
            color: white;
            padding: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        nav ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            display: flex;
        }

        nav ul li {
            margin-right: 20px;
        }

        nav ul li a {
            display: block;
            color: white;
            text-align: center;
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }

        nav ul li a:hover {
            background-color: #B22222; /* Firebrick */
        }

        .container {
            display: flex;
            justify-content: space-around;
            margin: 50px auto;
            max-width: 1200px;
            padding: 20px;
        }

        .section {
            flex: 1;
            margin: 20px;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .section:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 15px;
            text-align: center;
            border-bottom: 1px solid #ddd;
            background-color: #fff;
        }

        th {
            background-color: #4CAF50; /* Green */
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .action-buttons form {
            display: inline;
        }

        .action-buttons button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            cursor: pointer;
            margin: 5px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .action-buttons button.deny {
            background-color: #f44336;
        }

        .action-buttons button:hover {
            background-color: #388E3C; /* Darker Green */
        }

        .action-buttons button.deny:hover {
            background-color: #d32f2f; /* Darker Red */
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

        @media (max-width: 768px) {
            .container {
                flex-direction: column;
                align-items: center;
            }

            .section {
                width: 90%;
                margin-bottom: 30px;
            }

            nav ul {
                flex-direction: column;
                align-items: center;
            }

            nav ul li {
                margin-bottom: 10px;
            }
        }
    </style>
</head>
<body>

    <h2>Blood Requests</h2>
    <div class="container">
        <div class="section">
            <table>
                <thead>
                    <tr>
                        <th>Patient Name</th>
                        <th>Blood Group</th>
                        <th>Units</th>
                        <th>Status</th>
                        <th>Accept</th>
                        <th>Deny</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($requests_result->num_rows > 0) {
                        while ($row = $requests_result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["user_name"] . "</td>";
                            echo "<td>" . $row["blood_group"] . "</td>";
                            echo "<td>" . $row["units"] . "</td>";
                            echo "<td>" . ucfirst($row["status"]) . "</td>";
                            echo "<td class='action-buttons'>";
                            echo "<form method='post' action='".$_SERVER['PHP_SELF']."'>";
                            echo "<input type='hidden' name='request_id' value='" . $row['request_id'] . "'>";
                            echo "<button type='submit' name='accept'>Accept</button>";
                            echo "</form>";
                            echo "</td>";
                            echo "<td class='action-buttons'>";
                            echo "<form method='post' action='".$_SERVER['PHP_SELF']."'>";
                            echo "<input type='hidden' name='request_id' value='" . $row['request_id'] . "'>";
                            echo "<button class='deny' type='submit' name='deny'>Deny</button>";
                            echo "</form>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6'>No blood requests found.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <div class="section">
            <h2>Available Blood Inventory</h2>
            <table>
                <thead>
                    <tr>
                        <th>Blood Group</th>
                        <th>Total Units</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($inventory_result->num_rows > 0) {
                        while ($row = $inventory_result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["blood_group"] . "</td>";
                            echo "<td>" . $row["total_units"] . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='2'>No blood inventory available.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>

<?php
// Close the database connection
$con->close();
?>

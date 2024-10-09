<?php
// Include the database connection file
include 'connection.php';
include 'adminnavbar.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the accept button is clicked
    if (isset($_POST['accept'])) {
        $donation_id = $_POST['donation_id'];

        // Start transaction for atomicity
        $con->begin_transaction();

        // Update the donation status to "Accepted" in the donations table
        $update_donation_sql = "UPDATE donations SET status = 'Accepted' WHERE donation_id = $donation_id";
        if ($con->query($update_donation_sql) === TRUE) {
            // Get the details of the accepted donation
            $donation_details_sql = "SELECT blood_group, units, weight FROM donations WHERE donation_id = $donation_id";
            $result = $con->query($donation_details_sql);
            if ($result) {
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $blood_group = $row['blood_group'];
                    $units = $row['units'];
                    $weight = $row['weight'];
                    $age=$row['age'];

                    // Update or insert into bloodinventory
                    $update_inventory_sql = "INSERT INTO bloodinventory (blood_group, units, expiry_date)
                                             VALUES ('$blood_group', $units, DATE_ADD(CURDATE(), INTERVAL 42 DAY))
                                             ON DUPLICATE KEY UPDATE units = units + $units";

                    if ($con->query($update_inventory_sql) === TRUE) {
                        // Commit transaction
                        $con->commit();
                        echo "Donation accepted successfully and BloodInventory updated.";
                    } else {
                        // Rollback transaction on failure
                        $con->rollback();
                        echo "Error updating BloodInventory: " . $con->error;
                    }
                } else {
                    echo "Error: Donation details not found.";
                }
            } else {
                echo "Error executing query: " . $con->error;
            }
        } else {
            // Error accepting donation
            echo "Error accepting donation: " . $con->error;
        }
    }
    // Check if the deny button is clicked
    elseif (isset($_POST['deny'])) {
        $donation_id = $_POST['donation_id'];

        // Get the details of the denied donation
        $donation_details_sql = "SELECT blood_group, units, weight FROM donations WHERE donation_id = $donation_id";
        $result = $con->query($donation_details_sql);
        if ($result) {
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $blood_group = $row['blood_group'];
                $units = $row['units'];
                $weight = $row['weight'];
                $age=$row['age'];



                // Start transaction for atomicity
                $con->begin_transaction();

                // Update the donation status to "Denied" in the donations table
                $update_sql = "UPDATE donations SET status = 'Denied' WHERE donation_id = $donation_id";
                if ($con->query($update_sql) === TRUE) {
                    // Update blood inventory to reduce units
                    $update_inventory_sql = "UPDATE bloodinventory SET units = units - $units WHERE blood_group = '$blood_group'";

                    if ($con->query($update_inventory_sql) === TRUE) {
                        // Commit transaction
                        $con->commit();
                        echo "Donation denied successfully and BloodInventory updated.";
                    } else {
                        // Rollback transaction on failure
                        $con->rollback();
                        echo "Error updating BloodInventory: " . $con->error;
                    }
                } else {
                    // Error denying donation
                    echo "Error denying donation: " . $con->error;
                }
            } else {
                echo "Error: Donation details not found.";
            }
        } else {
            echo "Error executing query: " . $con->error;
        }
    }
}

// Query to retrieve donation records with user information
$sql = "SELECT donations.donation_id, donations.blood_group, donations.units, donations.weight, donations.status, donations.diseases,donations.age , users.name AS user_name 
        FROM donations 
        JOIN users ON donations.id = users.id 
        ORDER BY donations.donation_id DESC";


$result = $con->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Donations</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        h2 {
            text-align: center;
            margin-top: 50px;
            color: #333;
        }

        nav {
            background-color: brown;
            color: black;
        }

        nav ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            overflow: hidden;
        }

        nav ul li {
            float: left;
        }

        nav ul li a {
            display: block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        nav ul li a:hover {
            background-color: #555;
        }
    </style>
</head>
<body>

    <h2>Donation Records</h2>
    <table>
        <tr>
            <th>Donor Name</th>
            <th>Blood Group</th>
            <th>Units</th>
            <th>Weight</th>
            <th>Age</th>
            <th>Diseases</th>
            <th>Status</th>
            <th>Accept</th>
            <th>Deny</th>
        </tr>
        <?php
        // Display donation records in a table
        if ($result) {
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['user_name'] . "</td>";
                    echo "<td>" . $row['blood_group'] . "</td>";
                    echo "<td>" . $row['units'] . "</td>";
                    echo "<td>" . $row['weight'] . "</td>";
                    echo "<td>" . $row['age'] . "</td>";
                    echo "<td>" . $row['diseases'] . "</td>";
                    echo "<td>" . ucfirst($row['status']) . "</td>";
                    echo "<td>";
                    echo "<form method='post' action='".$_SERVER['PHP_SELF']."'>";
                    echo "<input type='hidden' name='donation_id' value='" . $row['donation_id'] . "'>";
                    echo "<button type='submit' name='accept'>Accept</button>";
                    echo "</form>";
                    echo "</td>";
                    echo "<td>";
                    echo "<form method='post' action='".$_SERVER['PHP_SELF']."'>";
                    echo "<input type='hidden' name='donation_id' value='" . $row['donation_id'] . "'>";
                    echo "<button type='submit' name='deny'>Deny</button>";
                    echo "</form>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='9'>No donation records found.</td></tr>";
            }
        } else {
            echo "<tr><td colspan='9'>Error executing query: " . $con->error . "</td></tr>";
        }
        ?>
    </table>

</body>
</html>

<?php
// Close the database connection
$con->close();
?>

<?php
// Include database connection
include 'connection.php';
include 'adminnavbar.php';

// Define report type based on user selection
$report_type = isset($_POST['report_type']) ? $_POST['report_type'] : '';

// Prepare SQL queries for different reports
$sql_queries = [
    'donation_records' => "SELECT donation_id, blood_group, units,status FROM donations ORDER BY donation_id DESC",
    'inventory_status' => "SELECT blood_group, SUM(units) AS total_units FROM bloodinventory GROUP BY blood_group",
    'request_status' => "SELECT request_id, blood_group, units, status FROM requests ORDER BY request_id DESC"
];

$result = [];
if ($report_type && isset($sql_queries[$report_type])) {
    $query = $sql_queries[$report_type];
    $result = $con->query($query);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        form {
            text-align: center;
            margin-bottom: 20px;
        }
        select, input[type="submit"] {
            padding: 10px;
            font-size: 16px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .no-data {
            text-align: center;
            font-style: italic;
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
    <h1>Reports</h1>
    
    <form action="reports.php" method="post">
        <label for="report_type">Select Report:</label>
        <select id="report_type" name="report_type">
            <option value="">-- Select a Report --</option>
            <option value="donation_records" <?php if ($report_type == 'donation_records') echo 'selected'; ?>>Donation Records</option>
            <option value="inventory_status" <?php if ($report_type == 'inventory_status') echo 'selected'; ?>>Inventory Status</option>
            <option value="request_status" <?php if ($report_type == 'request_status') echo 'selected'; ?>>Request Status</option>
        </select>
        <input type="submit" value="Generate Report">
    </form>

    <?php if ($report_type && isset($sql_queries[$report_type])): ?>
        <table>
            <thead>
                <tr>
                    <?php
                    // Define table headers for each report type
                    $headers = [
                        'donation_records' => ['Donor ID', 'Blood Group', 'Units', 'Status'],
                        'inventory_status' => ['Blood Group', 'Total Units'],
                        'request_status' => ['Request ID', 'Blood Group', 'Units', 'Status']
                    ];

                    foreach ($headers[$report_type] as $header) {
                        echo "<th>{$header}</th>";
                    }
                    ?>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result && $result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        foreach ($row as $column) {
                            echo "<td>{$column}</td>";
                        }
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='" . count($headers[$report_type]) . "' class='no-data'>No data available</td></tr>";
                }
                ?>
            </tbody>
        </table>
    <?php endif; ?>
</body>
</html>

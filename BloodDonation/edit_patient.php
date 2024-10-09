<?php
// Include the database connection file
include 'connection.php';

// Check if the donor ID is provided in the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch the donor details from the database
    $sql = "SELECT * FROM users WHERE id = $id";
    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $name = $row['name'];
        $email = $row['email'];
        $gender = $row['gender'];
        $age = $row['age'];
        $weight = $row['weight'];
        $address = $row['address'];
        $phone = $row['phone'];
        $blood_group = $row['blood_group'];
    } else {
        // If no patient found with the provided ID, redirect or display an error message
        echo "Patient not found.";
        exit; // Stop further execution
    }
} else {
    // If ID parameter is not provided, redirect or display an error message
    echo "Patient ID not provided.";
    exit; // Stop further execution
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve updated patient information from the form
    // Perform validation if necessary

    // Update patient information in the database
    $updatedName = $_POST['name'];
    $updatedEmail = $_POST['email'];
    $updatedGender = $_POST['gender'];
    $updatedAge = $_POST['age'];
    $updatedWeight = $_POST['weight'];
    $updatedAddress = $_POST['address'];
    $updatedPhone = $_POST['phone'];
    $updatedBloodGroup = $_POST['blood_group'];

    $updateSql = "UPDATE users SET name='$updatedName', email='$updatedEmail', gender='$updatedGender', age=$updatedAge, weight=$updatedWeight, address='$updatedAddress', phone='$updatedPhone', blood_group='$updatedBloodGroup' WHERE id=$id";

    if ($con->query($updateSql) === TRUE) {
        echo "Patient information updated successfully";
        // Redirect to patient list or any other page
    } else {
        echo "Error updating patient information: " . $con->error;
    }

    $con->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Donor</title>
    <link rel="stylesheet" href="">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }

        #edit {
            background-color: beige;
        }

        h2 {
            margin-bottom: 20px;
        }

        form {
            max-width: 400px;
            margin: 0 auto;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="email"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button[type="submit"] {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h2>Edit Donor</h2>
    <section id="edit">
        <form action="update_patient.php" method="post">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="<?php echo $name; ?>" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo $email; ?>" required>
            <label for="gender">Gender:</label>
        <select id="gender" name="gender" required>
            <option value="Male" <?php if($gender === 'Male') echo 'selected'; ?>>Male</option>
            <option value="Female" <?php if($gender === 'Female') echo 'selected'; ?>>Female</option>
            <option value="Other" <?php if($gender === 'Other') echo 'selected'; ?>>Other</option>
        </select>

        <label for="age">Age:</label>
        <input type="number" id="age" name="age" value="<?php echo $age; ?>" required>

        <label for="weight">Weight (kg):</label>
        <input type="number" id="weight" name="weight" step="0.01" value="<?php echo $weight; ?>" required>

        <label for="address">Address:</label>
        <textarea id="address" name="address" rows="4" required><?php echo $address; ?></textarea>

        <label for="phone_number">Phone Number:</label>
        <input type="text" id="phone_number" name="phone_number" value="<?php echo $phone; ?>" required>

        <label for="blood_group">Blood Group:</label>
        <input type="text" id="blood_group" name="blood_group" value="<?php echo $blood_group; ?>" required>


            <button type="submit">Update Donor</button>
        </form>
    </section>
</body>
</html>

<?php
include 'adminnavbar.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Donors</title>
    <link rel="stylesheet" href=""> 
    <style>
        body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
}

main {
    width: 80%;
    margin: 0 auto;
    padding: 20px 0;
}

section {
    margin-bottom: 20px;
}

h2 {
    margin-bottom: 10px;
}

form {
    display: flex;
    flex-direction: column;
    max-width: 300px;
}

label {
    margin-bottom: 5px;
}

input[type="text"],
input[type="email"] {
    padding: 8px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
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

ul {
    list-style-type: none;
    padding: 0;
}

footer {
    background-color: #f0f0f0;
    padding: 10px 0;
    text-align: center;
}
nav {
background-color: brown;
color: #fff;
}

nav ul {
list-style-type: none;
margin: 0;
padding: 0;
overflow: hidden;
}

nav ul li {
float:left;
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
/* CSS for patient List */
#patient-list {
    margin-top: 20px;
    background-color:beige;
}

#patient-list h2 {
    font-size: 24px;
    color: #333;
    margin-bottom: 10px;
}

#patient-list ul {
    list-style: none;
    padding: 0;
}

#patient-list li {
    background-color: #f9f9f9;
    border: 1px solid #ccc;
    border-radius: 5px;
    margin-bottom: 5px;
    padding: 10px;
    position: relative;
}

#patient-list li:hover {
    background-color: #eaeaea;
}

#patient-list li {
    background-color: #f9f9f9;
    border: 1px solid #ccc;
    border-radius: 5px;
    margin-bottom: 5px;
    padding: 10px;
    position: relative; 
}

#patient-list li a {
    text-decoration: none;
    padding: 5px 10px;
    border-radius: 4px;
    cursor: pointer;
    float: right;

 
}

#patient-list li a.delete {
    background-color: green; 
    color: green;
     
}

#patient-list li a.edit {
    background-color: green; 
    color: white;
 
}

#patient-list li a:hover {
    opacity: 0.8;
}
table {
        width: 100%;
        border-collapse: collapse;
    }

    th, td {
        padding: 8px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    th {
        background-color: #f2f2f2;
    }

    tr:nth-child(even) td {
        background-color: #f9f9f9;
    }

    tr:hover td {
        background-color: #f2f2f2;
    }


    </style>
</head>
<body>
<section id="add-patient">
            <h2>Add Patient</h2>
            <form action="add_patient.php" method="post">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
                <label for="gender">Gender:</label>
            <select id="gender" name="gender" required>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Other">Other</option>
            </select>

            
            <label for="address">Address:</label>
            <textarea id="address" name="address" rows="4" required></textarea>
            <label for="phone">Phone Number:</label>
            <input type="text" id="phone" name="phone" required>   

           
            <label for="blood_group">Blood Group:</label>
            <input type="text" id="blood_group" name="blood_group" required>
            

            <button type="submit">Add Patient</button>
        </form>

               
        </section>
        <section id="patient-list">
    <h2>Patient List</h2>
    <?php
    // Include the database connection file
    include 'connection.php';

    // Fetch the list of patients from the users and requests tables using JOIN
    $sql = "SELECT users.id, users.name, users.email, users.gender, users.address, users.phone, requests.blood_group
    FROM users
    JOIN requests ON users.id = requests.id 
    WHERE users.role = 'patient'";

    $result = $con->query($sql);

    // Debugging: Check if query is executed correctly
    if ($result === false) {
        echo "<p>Error: " . $con->error . "</p>";
    } else 
        // Debugging: Output the number of rows found
        echo "<p>Patients Found: " . $result->num_rows . "</p>";


    // Check if there are patients
    if ($result->num_rows > 0) {
        // Output data of each patient
        echo "<table>";
        echo "<tr>
                <th>Name</th>
                <th>Email</th>
                <th>Gender</th>
                <th>Address</th>
                <th>Phone Number</th>
                <th>Blood Group</th>
                <th>Action</th>
            </tr>";
        while ($row = $result->fetch_assoc()) {
            $id = $row['id'];
            $name = $row['name'];
            $email = $row['email'];
            $gender = $row['gender'];
            $address = $row['address'];
            $phone = $row['phone'];
            $blood_group = $row['blood_group'];
            // Output patient information in rows and columns
            echo "<tr>
                    <td>$name</td>
                    <td>$email</td>
                    <td>$gender</td>
                    <td>$address</td>
                    <td>$phone</td>
                    <td>$blood_group</td>
                    <td>
                        <a href='delete_patient.php?id={$id}' onclick='return confirm(\"Are you sure you want to delete this patient?\")'>Delete</a>
                        <a href='edit_donor.php?id={$id}'>Edit</a>
                    </td>
                </tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No patients found.</p>";
    }

    // Close the database connection
    $con->close();
    ?>
</section>

</body>
</html>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection details
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "redstream_db";

    // Create a connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get form data
    $name = $conn->real_escape_string($_POST['name']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $user_email = $conn->real_escape_string($_POST['user_email']);
    $blood_type = $conn->real_escape_string($_POST['blood_type']);
    $city = $conn->real_escape_string($_POST['city']);

    // Insert data into donations table
    $sql = "INSERT INTO donations (name, phone, user_email, blood_type, city) VALUES ('$name', '$phone', '$user_email', '$blood_type', '$city')";

    if ($conn->query($sql) === TRUE) {
        echo "Donation successful! Thank you for donating.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the connection
    $conn->close();
}
?>

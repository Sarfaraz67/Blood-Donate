<?php
// Check if the form is submitted
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

    // Construct the SQL query based on user input
    $sql = "SELECT COUNT(*) as totalDonors FROM donations WHERE";

    if (isset($_POST['blood-type']) && !empty($_POST['blood-type'])) {
        // If blood type is provided, add it to the query
        $bloodType = $conn->real_escape_string($_POST['blood-type']);
        $sql .= " blood_type = '$bloodType'";
    }

    if (isset($_POST['city']) && !empty($_POST['city'])) {
        // If city is provided, add it to the query
        $city = $conn->real_escape_string($_POST['city']);
        $sql .= " AND city = '$city'";
    }

    // Execute the query
    $result = $conn->query($sql);

    if ($result) {
        $row = $result->fetch_assoc();
        $totalDonors = $row['totalDonors'];
        echo "Total Donors: " . $totalDonors;
    } else {
        echo "Error: " . $conn->error;
    }

    // Close the connection
    $conn->close();
}
?>

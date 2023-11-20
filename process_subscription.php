<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate the email address
    if (isset($_POST["email_address"]) && filter_var($_POST["email_address"], FILTER_VALIDATE_EMAIL)) {
        // Sanitize the email address to prevent SQL injection
        $email = htmlspecialchars($_POST["email_address"]);
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
        // Prepare and execute the SQL query to insert the email into the database
        $stmt = $conn->prepare("INSERT INTO response_back (email) VALUES (?)");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        // Check if the email is inserted successfully
        if ($stmt->affected_rows > 0) {
            // Email added successfully, show the popup message
            echo '<script>showPopup("Email added successfully!");</script>';
        } else {
            // Unable to add email, show the popup message
            echo '<script>showPopup("Error: Unable to add email. Please try again later.");</script>';
        }
        // Close the statement and connection
        $stmt->close();
        $conn->close();
    } else {
        // Invalid email address, show the popup message
        echo '<script>showPopup("Error: Invalid email address. Please enter a valid email.");</script>';
    }
}
?>

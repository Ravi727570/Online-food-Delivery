<?php
// Replace these variables with your actual database credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate form data (add more validation if needed)
    if (empty($_POST["name"]) || empty($_POST["email"]) || empty($_POST["phone"]) || empty($_POST["message"])) {
        echo "All fields are required.";
    } else {
        // Use prepared statements to prevent SQL injection
        $stmt = $conn->prepare("INSERT INTO `userinfo' (name, email, phone, message) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $email, $phone, $message);

        // Sanitize and set parameters
        $name = $_POST["name"];
        $email = $_POST["email"];
        $phone = $_POST["phone"];
        $message = $_POST["message"];

        // Execute the statement
        if ($stmt->execute()) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    }
}

// Close the database connection
$conn->close();
?>

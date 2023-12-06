<?php
include '../config/connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve user input from the registration form
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Hash the password for security
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    try {
        // Prepare and execute the SQL query to insert user data into the 'users' table
        $sql = "INSERT INTO users (email, password) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$email, $hashedPassword]);

        // Redirect to the login page upon successful registration
        header("Location: ../index.php");
        exit(); // Make sure to exit after the header to prevent further execution
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

<?php
include '../config/connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Retrieve user input from the login form
  $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
  $password = $_POST["password"];

  try {
    // Retrieve hashed password from the database based on the provided email
    $sql = "SELECT id, password FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$email]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    // Check if the email exists and verify the password
    if ($row && password_verify($password, $row['password'])) {
      // Start a session and store user information
      session_start();
      $_SESSION['user_id'] = $row['id'];

      // Regenerate session ID
      session_regenerate_id(true);

      // Redirect to the dashboard upon successful login
      header("Location: /view/dashboard.php");
      exit(); // Make sure to exit after the header to prevent further execution
    } else {
      // Redirect back to the login page with an error message
      header("Location: /index.php?error=InvalidCredentials");
      exit();
    }
  } catch (PDOException $e) {
    // Log the error and display a generic error message
    error_log("Error connecting to the database: " . $e->getMessage(), 0);
    header("Location: /index.php?error=InternalServerError");
    exit();
  }
}
?>
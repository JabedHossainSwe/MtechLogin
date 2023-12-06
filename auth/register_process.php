<?php
include '../config/connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $email = $_POST["email"];
  $password = $_POST["password"];

  $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

  try {

    $sql = "INSERT INTO users (email, password) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$email, $hashedPassword]);

    header("Location: ../index.ph");
    exit();
  } catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
  }
}
?>
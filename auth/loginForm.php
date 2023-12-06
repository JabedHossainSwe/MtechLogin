<?php
include './config/connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
  $password = $_POST["password"];

  try {
    $sql = "SELECT id, password FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$email]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row && password_verify($password, $row['password'])) {
      session_start();
      $_SESSION['user_id'] = $row['id'];

      session_regenerate_id(true);

      header("Location: view/dashboard.php");
      exit(); 
    } else {
      
      header("Location: index.php?error=InvalidCredentials");
      exit();
    }
  } catch (PDOException $e) {
    error_log("Error connecting to the database: " . $e->getMessage(), 0);
    header("Location: /index.php?error=InternalServerError");
    exit();
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
  <form class="login-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <div class="row mb-3">
      <div class="col-md-12">
        <label for="email" class="form-label">Email</label>
        <input type="email" id="email" name="email" autocomplete="off" class="form-control" placeholder="Email">
      </div>
    </div>
    <div class="row mb-3">
      <div class="col-md-12">
        <label for="password" class="form-label">Password</label>
        <input type="password" id="password" name="password" autocomplete="off" class="form-control"
          placeholder="Password">
      </div>
    </div>
    <div class="row mb-3">
      <div class="col-md-12">
        <div class="form-check">
          <input type="checkbox" id="remember-me" name="remember-me" class="form-check-input">
          <label for="remember-me" class="form-check-label">Remember me</label>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12 text-center">
        <button type="submit" class="btn btn-primary btn-lg">Login</button>
      </div>
    </div>
  </form>
</body>

</html>
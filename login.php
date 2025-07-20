
<?php include "db.php"; session_start(); ?>
<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="form-box">
  <h2>Login</h2>
  <?php
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = htmlspecialchars($_POST['username']);
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE username=?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
      if (password_verify($password, $row['password'])) {
        $_SESSION['user'] = $row['username'];
        header("Location: dashboard.php");
        exit;
      } else {
        echo "<p class='error'>Invalid password</p>";
      }
    } else {
      echo "<p class='error'>User not found</p>";
    }
  }
  ?>
  <form method="POST">
    <input type="text" name="username" placeholder="Username" required><br>
    <input type="password" name="password" placeholder="Password" required><br>
    <button type="submit">Login</button>
  </form>
  <p>New user? <a href="register.php">Register</a></p>
</div>
</body>
</html>

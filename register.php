
<?php include "db.php"; ?>
<!DOCTYPE html>
<html>
<head>
  <title>Register</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="form-box">
  <h2>Register</h2>
  <?php
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = htmlspecialchars($_POST['username']);
    $email = htmlspecialchars($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $check = $conn->prepare("SELECT * FROM users WHERE email=? OR username=?");
    $check->bind_param("ss", $email, $username);
    $check->execute();
    $result = $check->get_result();

    if ($result->num_rows > 0) {
      echo "<p class='error'>Username or email already taken!</p>";
    } else {
      $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
      $stmt->bind_param("sss", $username, $email, $password);
      if ($stmt->execute()) {
        echo "<p class='success'>Registered successfully!</p>";
      }
    }
  }
  ?>
  <form method="POST">
    <input type="text" name="username" placeholder="Username" required><br>
    <input type="email" name="email" placeholder="Email" required><br>
    <input type="password" name="password" placeholder="Password" required><br>
    <button type="submit">Register</button>
  </form>
  <p>Already have an account? <a href="login.php">Login</a></p>
</div>
</body>
</html>

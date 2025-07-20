
<?php session_start(); if (!isset($_SESSION['user'])) header("Location: login.php"); ?>
<!DOCTYPE html>
<html>
<head>
  <title>Dashboard</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="form-box">
  <h2>Welcome, <?php echo $_SESSION['user']; ?>!</h2>
  <p>This is your dashboard.</p>
  <a href="logout.php">Logout</a>
</div>
</body>
</html>

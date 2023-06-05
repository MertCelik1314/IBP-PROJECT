<?php
session_start(); // Start the session

$servername = "localhost";
$username = "root";
$password = "";

try {
  $db = new PDO("mysql:host=$servername;dbname=heal", $username, $password);
  // set the PDO error mode to exception
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}

function hashPassword($password) {
  return hash('sha256', $password); // Hash the password using SHA-256 algorithm
}

if (isset($_POST['submit'])) {
  $username = $_POST['username'];
  $password = hashPassword($_POST['password']);

  $stmt = $db->prepare("SELECT * FROM user WHERE username = :username AND password = :password");
  $stmt->bindParam(':username', $username);
  $stmt->bindParam(':password', $password);
  $stmt->execute();

  $user = $stmt->fetch(PDO::FETCH_ASSOC);

  if ($user) {
    $_SESSION['username'] = $username;
    header("Location: user_index.php");
    exit;
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Login Form</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="a.css">
  <style>
    .user-change-switch {
      position: absolute;
      top: 10px;
      right: 10px;
      z-index: 9999;
      cursor: pointer;
      display: flex;
      align-items: center;
    }

    .user-change-switch input {
      display: none;
    }

    .user-change-switch-label {
      display: inline-block;
      height: 25px;
      width: 45px;
      background-color: #ddd;
      border-radius: 25px;
      position: relative;
      transition: background-color 0.4s;
    }

    .user-change-switch-label::before {
      content: "";
      height: 19px;
      width: 19px;
      background-color: #fff;
      border-radius: 50%;
      position: absolute;
      top: 3px;
      left: 3px;
      transition: left 0.4s;
    }

    .user-change-switch-input:checked + .user-change-switch-label {
      background-color: #2196F3;
    }

    .user-change-switch-input:checked + .user-change-switch-label::before {
      left: 23px;
    }

    .btn-group .btn {
      margin-right: 10px;
    }
  </style>
</head>
<body>
  <?php include 'header.php'; ?>

  <div class="container">
    <div class="login-box">
      <h2>Login</h2>
      <form name="form" method="POST">
        <div class="form-group">
          <label for="username">Username</label>
          <input type="text" class="form-control" name="username" id="username" required>
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" class="form-control" name="password" id="password" required>
        </div>
        <div class="btn-group" role="group">
          <button type="submit" class="btn btn-primary" name="submit">Login</button>
          <a href="register.php" class="btn btn-link">Register</a>
        </div>
      </form>
    </div>
  </div>

  <div class="user-change-switch">
    <input type="checkbox" id="userChangeSwitch" class="user-change-switch-input">
    <label for="userChangeSwitch" class="user-change-switch-label"></label>
  </div>

  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script>
    const userChangeSwitch = document.querySelector('#userChangeSwitch');
    userChangeSwitch.addEventListener('change', function() {
      if (this.checked) {
        window.location.href = 'adminlogin.php';
      }
    });
  </script>
</body>
</html>

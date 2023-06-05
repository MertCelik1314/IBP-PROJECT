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

$maxLoginAttempts = 3; // Maximum number of login attempts
$timeoutDuration = 30; // Timeout duration in seconds

if (isset($_SESSION['login_attempts'])) {
  $_SESSION['login_attempts']++; // Increment login attempts if session variable exists
} else {
  $_SESSION['login_attempts'] = 1; // Initialize login attempts to 1
}

if ($_SESSION['login_attempts'] > $maxLoginAttempts) {
  $errorMessage = "Too many login attempts. Please try again after $timeoutDuration seconds.";
  $_SESSION['login_attempts'] = 1; // Reset login attempts after displaying error message
  echo $errorMessage;
  sleep($timeoutDuration); // Pause execution for the timeout duration
}

if (isset($_POST['submit'])) {
  $username = $_POST['username'];
  $password = hashPassword($_POST['password']);

  $stmt = $db->prepare("SELECT * FROM admin WHERE username = :username AND password = :password");
  $stmt->bindParam(':username', $username);
  $stmt->bindParam(':password', $password);
  $stmt->execute();

  $user = $stmt->fetch(PDO::FETCH_ASSOC);

  if ($user) {
    $_SESSION['username'] = $username;
    $_SESSION['login_attempts'] = 1; // Reset login attempts on successful login
    header("Location: /odev/admin/");
    exit;
  } else {
    $errorMessage = "Invalid username or password"; // Error message for invalid credentials
    echo $errorMessage;
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
      background-color: #243b55;
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
      right: 3px;
      transition: right 0.4s;
    }

    .user-change-switch-input:checked + .user-change-switch-label {
      background-color: #2196F3;
    }

    .user-change-switch-input:checked + .user-change-switch-label::before {
      right: 23px;
    }

    .error-message {
      color: red;
    }
  </style>
</head>
<body>
  <?php include 'header.php'; ?>

  <div class="container">
    <div class="login-box">
      <h2>Admin Login</h2>
      <?php if (!empty($errorMessage)) : ?>
        <p class="error-message"><?php echo $errorMessage; ?></p>
      <?php endif; ?>
      <form name="form" method="POST">
        <div class="form-group">
          <input type="text" class="form-control" name="username" id="username" required>
          <label>Username</label>
        </div>
        <div class="form-group">
          <input type="password" class="form-control" name="password" id="password" required>
          <label>Password</label>
        </div>
        <div class="btn-group" role="group">
          <button type="submit" class="btn btn-primary" name="submit">Login</button>
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
        window.location.href = 'login.php';
      }
    });
  </script>
</body>
</html>

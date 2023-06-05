<?php
session_start(); // Session'ı başlat

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "heal";

try {
  $db = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  // PDO hata modunu ayarla
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}

function hashPassword($password) {
  return hash('sha256', $password); // Şifreyi SHA-256 algoritmasıyla hashle
}

function isValidEmail($email) {
  return filter_var($email, FILTER_VALIDATE_EMAIL); // E-mail adresinin geçerli olup olmadığını kontrol et
}

if (isset($_POST['submit'])) {
  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $confirm_password = $_POST['confirm_password'];

  // Kullanıcı adının mevcut olup olmadığını kontrol et
  $stmt = $db->prepare("SELECT * FROM user WHERE username = :username");
  $stmt->bindParam(':username', $username);
  $stmt->execute();

  if ($stmt->rowCount() > 0) {
    $usernameError = "Bu kullanıcı adı zaten var!";
  } else {
    // E-mailin mevcut olup olmadığını kontrol et
    $stmt = $db->prepare("SELECT * FROM user WHERE e_mail = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
      $emailError = "Bu e-mail adresi zaten var!";
    } else {
      // E-mailin geçerli olup olmadığını kontrol et
      if (!isValidEmail($email)) {
        $emailError = "Geçerli bir e-mail adresi girin!";
      } else {
        // Şifreleri karşılaştır
        if ($password !== $confirm_password) {
          $passwordError = "Şifreler eşleşmiyor!";
        } else {
          // Şifreyi hashle ve veritabanına kaydet
          $hashedPassword = hashPassword($password);

          $stmt = $db->prepare("INSERT INTO user (username, e_mail, password) VALUES (:username, :email, :password)");
          $stmt->bindParam(':username', $username);
          $stmt->bindParam(':email', $email);
          $stmt->bindParam(':password', $hashedPassword);
          $stmt->execute();

          echo "<script>
                  // Kayıt başarılı mesajını göster
                  $(document).ready(function() {
                    $('.toast').toast('show');
                  });
                  
                  // 2 saniye sonra login.php sayfasına yönlendir
                  setTimeout(function() {
                    window.location.href = 'login.php';
                  }, 2000);
                </script>";
        }
      }
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Register Form</title>
  <?php include 'header.php'; ?>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="a.css">
  <style>
    .register-box {
      margin-top: 100px;
      max-width: 400px;
      margin-left: auto;
      margin-right: auto;
      padding: 20px;
      border: 1px solid #ccc;
      border-radius: 5px;
      background-color: #f9f9f9;
    }

    .error-message {
      color: red;
      margin-top: 5px;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="register-box">
      <h2>Register</h2>
      <form name="form" method="POST">
        <div class="form-group">
          <label for="username">Username</label>
          <input type="text" class="form-control" name="username" id="username" required>
          <?php if(isset($usernameError)) { ?>
            <p class="error-message"><?php echo $usernameError; ?></p>
          <?php } ?>
        </div>
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" class="form-control" name="email" id="email" required>
          <?php if(isset($emailError)) { ?>
            <p class="error-message"><?php echo $emailError; ?></p>
          <?php } ?>
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" class="form-control" name="password" id="password" required>
        </div>
        <div class="form-group">
          <label for="confirm_password">Confirm Password</label>
          <input type="password" class="form-control" name="confirm_password" id="confirm_password" required>
        </div>
        <button type="submit" class="btn btn-primary" name="submit">Register</button>
      </form>
    </div>
  </div>

  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Doktor Tanıtım Sayfası</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="a.css"> <!-- a.css dosyasını ekledik -->
  <?php include 'header.php' ?>
  <style>
    .doctor-card {
      width: 200px;
      margin-bottom: 20px;
    }

    .doctor-card img {
      width: 100%;
      height: auto;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Doktorlar</h1>
    <div class="row">
      <?php
        // Database bağlantısı ve sorgu için gerekli bilgiler
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "heal";

        try {
          $db = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
          $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

          $stmt = $db->query("SELECT * FROM doktorlar");

          // Doktor bilgilerini çekme ve kartları oluşturma
          while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $doktorAdi = $row['doktor'];
            $aciklama = $row['title'];
            $resim = $row['resim'];

            echo '
              <div class="col-md-4">
                <div class="card doctor-card">
                  <img src="' . $resim . '" alt="' . $doktorAdi . '">
                  <div class="card-body">
                    <h5 class="card-title">' . $doktorAdi . '</h5>
                    <p class="card-text">' . $aciklama . '</p>
                    <a href="login.php" class="btn btn-primary">Randevu Al</a>
                  </div>
                </div>
              </div>
            ';
          }
        } catch(PDOException $e) {
          echo "Connection failed: " . $e->getMessage();
        }
      ?>
    </div>
  </div>

  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

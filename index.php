<!DOCTYPE html>
<html lang="en">
<head>
  <title>Güzellik Salonu Anasayfa</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="style.css"> <!-- style.css dosyasını ekledik -->
  <link rel="stylesheet" href="as.css"> <!-- as.css dosyasını ekledik -->
  <?php include 'header.php' ?>
</head>
<body>

  <section class="hero">
    <div class="container">
      <img src="img/doktor.jpg" alt="Güzellik Salonu" />
    </div>
  </section>

  <section class="features">
    <div class="container">
      <div class="row">
        <div class="col-md-4">
          <div class="feature-item">
            <i class="fas fa-cut"></i>
            <h3>Kesim ve Stil</h3>
            <p>Profesyonel kuaförlerimizle saç kesimi ve stil hizmetleri.</p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="feature-item">
            <i class="fas fa-paint-brush"></i>
            <h3>Boyama</h3>
            <p>Deneyimli uzmanlarımızla saç boyama ve renklendirme hizmetleri.</p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="feature-item">
            <i class="fas fa-spa"></i>
            <h3>Cilt Bakımı</h3>
            <p>Güzellik uzmanlarımızla yüz ve cilt bakımı hizmetleri.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="testimonial">
    <div class="container">
      <h2>Müşteri Yorumları</h2>
      <div class="testimonial-carousel">
        <div class="testimonial-item">
          <p>"Çok memnun kaldım, harika bir deneyimdi. Kesinlikle tavsiye ederim!"</p>
          <p class="client-name">- Ayşe K.</p>
        </div>
        <div class="testimonial-item">
          <p>"Personel çok nazik ve profesyoneldi. Harika bir hizmet aldım!"</p>
          <p class="client-name">- Mehmet T.</p>
        </div>
        <div class="testimonial-item">
          <p>"Güzellik Salonu'nun atmosferi çok rahatlatıcı. Yeniden geleceğim!"</p>
          <p class="client-name">- Zeynep A.</p>
        </div>
      </div>
    </div>
  </section>

  <footer>
    <div class="container">
      <p>Tüm hakları saklıdır. Güzellik Salonu &copy; 2023</p>
    </div>
  </footer>

  <script src="https://kit.fontawesome.com/your-font-awesome-kit.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="script.js"></script> <!-- script.js dosyasını ekleyebilirsiniz -->
</body>
</html>

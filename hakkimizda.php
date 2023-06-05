<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Güzellik Salonu Anasayfa</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="da.css"> <!-- a.css dosyasını ekledik -->
</head>
<body>
  <?php include 'header.php'; ?>

  <section class="hero">
    <div class="container">
      <img src="img/doktor.jpg" alt="Güzellik Salonu" />
    </div>
  </section>

  <section id="about" class="about">
    <div class="container">
      <h2>Hakkımızda</h2>
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus eget interdum mauris. Curabitur vitae maximus lectus. Fusce volutpat lectus enim, in dignissim urna hendrerit eget. Nulla lacinia interdum augue, non faucibus enim rutrum sed. In eu libero sed nulla gravida fermentum.</p>
      <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Sed luctus convallis dolor, vitae blandit nisl eleifend nec. Suspendisse potenti. Proin rutrum sem in neque placerat, at interdum massa luctus.</p>
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

  <section class="comment">
    <div class="container">
      <h2>Yorum Yap</h2>
      <form action="save_comment.php" method="POST">
        <div class="form-group">
          <label for="name">İsim</label>
          <input type="text" class="form-control" id="name" name="name" placeholder="İsim">
        </div>
        <div class="form-group">
          <label for="phone">Telefon Numarası</label>
          <input type="tel" class="form-control" id="phone" name="phone" placeholder="Telefon Numarası">
        </div>
        <div class="form-group">
          <label for="comment">Yorum</label>
          <textarea class="form-control" id="comment" name="comment" rows="3" placeholder="Yorumunuzu buraya girin"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Gönder</button>
      </form>
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

<?php
  session_start();
  $time = $_SERVER['REQUEST_TIME'];
  $timeout_duration = 10000;
  if ( isset($_SESSION['LAST_ACTIVITY']) && ($time - $_SESSION['LAST_ACTIVITY']) > $timeout_duration ) {
    session_unset();
    session_destroy();
    session_start();
  }
  $_SESSION['LAST_ACTIVITY'] = $time;
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>Gia Sư Đây</title>
  <!-- Icon trang web -->
  <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico" />
  <!-- Font Awesome icons (free version)-->
  <script src="https://use.fontawesome.com/releases/v5.13.0/js/all.js" crossorigin="anonymous"></script>
  <!-- Google fonts-->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
  <link href="https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
  <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />
  <!-- Core theme CSS (includes Bootstrap)-->
  <link href="css/styles.css" rel="stylesheet" />
  <link href="css/override.css" rel="stylesheet" />
</head>
<body id="page-top">

  <!-- Navigation-->
  <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
    <div class="container">
      <a class="navbar-brand js-scroll-trigger" href="#page-top"><img src="assets/img/navbar-logo.svg"/></a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        Menu<i class="fas fa-bars ml-1"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav text-uppercase ml-auto">
          <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#portfolio">GIA SƯ</a></li>
          <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#services">TÌM GIA SƯ</a></li>
          <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#about">ĐÁNH GIÁ</a></li>
          <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#contact">LIÊN HỆ</a></li>
        </ul>
        <?php require_once('views/display_login.php'); ?>
      </div>
    </div>
  </nav>

  <!-- Masthead-->
  <header class="masthead">
    <div class="container">
      <div class="masthead-heading text-uppercase tieude">giasuday</div>
      <div class="masthead-subheading tieude-cm">Website tìm gia sư IT đầu tiên của Việt Nam</div>
      <!-- <a class="btn btn-primary btn-xl text-uppercase js-scroll-trigger" href="#services">Tell Me More</a> -->
    </div>
  </header>

  <!-- Danh sách gia sư -->
  <?php require_once "views/giasu.php"; ?>

  <!-- Danh sách bài đăng tìm gia sư -->
  <?php require_once "views/baidang.php"; ?>

  <!-- Danh sách review -->
  <?php require_once "views/review.php"; ?>

  
  <!-- Liên hệ, Email Marketing -->
  <section class="page-section" id="contact">
    <div class="container">
      <div class="text-center">
        <h2 class="section-heading text-uppercase">Contact Us</h2>
        <h3 class="section-subheading text-muted"></h3>
      </div>
      <form id="contactForm" name="sentMessage" novalidate="novalidate">
        <div class="row align-items-stretch mb-5">
          <div class="col-md-6">
            <div class="form-group">
              <input class="form-control" id="name" type="text" placeholder="Your Name *" required="required" data-validation-required-message="Please enter your name." />
              <p class="help-block text-danger"></p>
            </div>
            <div class="form-group">
              <input class="form-control" id="email" type="email" placeholder="Your Email *" required="required" data-validation-required-message="Please enter your email address." />
              <p class="help-block text-danger"></p>
            </div>
            <div class="form-group mb-md-0">
              <input class="form-control" id="phone" type="tel" placeholder="Your Phone *" required="required" data-validation-required-message="Please enter your phone number." />
              <p class="help-block text-danger"></p>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group form-group-textarea mb-md-0">
              <textarea class="form-control" id="message" placeholder="Your Message *" required="required" data-validation-required-message="Please enter a message."></textarea>
              <p class="help-block text-danger"></p>
            </div>
          </div>
        </div>
        <div class="text-center">
          <div id="success"></div>
          <button class="btn btn-primary btn-xl text-uppercase" id="sendMessageButton" type="submit">Send Message</button>
        </div>
      </form>
    </div>
  </section>

  <!-- Footer-->
  <footer class="footer py-4" id="footer">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-4 text-lg-left">Website Made By Group-7 (07/2020)</div>
        <div class="col-lg-4 my-3 my-lg-0">
          <a class="btn btn-dark btn-social mx-2" href="#!"><i class="fab fa-twitter"></i></a>
          <a class="btn btn-dark btn-social mx-2" href="#!"><i class="fab fa-facebook-f"></i></a>
          <a class="btn btn-dark btn-social mx-2" href="#!"><i class="fab fa-linkedin-in"></i></a>
        </div>
        <div class="col-lg-4 text-lg-right">
          <a class="mr-3" href="#!">Privacy Policy</a>
          <a href="#!">Terms of Use</a>
        </div>
      </div>
    </div>
  </footer>

  <!-- Portfolio Modals-->
  <!-- Modal Login -->
  <div class="modal fade" id="login">
    <div class="modal-dialog">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Đăng Nhập</h4>
          <button type="button" class="close" data-dismiss="modal">×</button>
        </div>
        <!-- Modal body -->
        <div class="modal-body">
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text"><strong>Số điện thoại: </strong></span>
            </div>
            <input type="text" class="form-control" id="sdt_dn" name="sdt_dn" required>
          </div>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text"><strong>Mật khẩu: </strong></span>
            </div>
            <input type="password" class="form-control" id="password_dn" name="password_dn" required>
          </div>
        </div>
        <!-- Modal footer -->
        <div class="modal-footer mt-0">
          <button class="btn-phd" id="dangnhap" name="dangnhap" onclick="login()">Đăng nhập</button>
        </div> 
      </div>
    </div>
  </div>
  
  <!-- My JavaScript -->
  <script src="js/myScript.js"></script>
  <!-- Bootstrap core JS-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>
  <!-- Third party plugin JS-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
  <!-- Contact form JS-->
  <script src="assets/mail/jqBootstrapValidation.js"></script>
  <script src="assets/mail/contact_me.js"></script>
  <!-- Core theme JS-->
  <script src="js/scripts.js"></script>

</body>
</html>
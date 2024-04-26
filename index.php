
<?php
// Start the session
session_start();
?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>SmartInvest</title>
  <meta content="" name="description">
  <meta content="" name="keywords">


  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Day
  * Template URL: https://bootstrapmade.com/day-multipurpose-html-template-for-free/
  * Updated: Mar 19 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
  <style>
    .login-wrap .form-group {
      margin-bottom: 30px; /* Increased spacing */
    }

    .btn.btn-primary.submit {
      border: 2px solid #ea0707;
      background-color: transparent;
      color: #ea0707;
    }

    .btn.btn-primary.submit:hover {
      background-color: #ea0707;
      border-color: #ea0707;
      color: #fff;
    }

    .btn.btn-primary.submit:active,
    .btn.btn-primary.submit:focus {
      background-color: #ea0707;
      border-color: #ea0707;
      color: #fff;
    }
  </style>
</head>

<body>

  <header id="header" class="header fixed-top">

       
    <div class="branding">

      <di class="container position-relative d-flex align-items-center justify-content-between">
        <a href="index.html" class="logo d-flex align-items-center">
          <!-- Uncomment the line below if you also wish to use an image logo -->
          <!-- <img src="assets/img/logo.png" alt=""> -->
          <h1 class="">SmartInvest</h1>
        </a>

        <nav id="navmenu" class="navmenu">
          <ul>
            <li><a href="#hero" class="">Home</a></li>
            <li><a href="#login">Login</a></li>
          
           
           
            <li><a href="#contact">Contact</a></li>
          </ul>
          <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>

      </di>
    </div>

  </header>

  <main class="main">

    <!-- Hero Section -->
    <section id="hero" class="hero section">

      <img src="assets/img/hero-bg.jpg" alt="" data-aos="fade-in">

      <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="row justify-content-start">
          <div class="col-lg-8">
            <h2 class="">Welcome to SmartInvest</h2>
            <p>Your tailored Investment Plans</p>
            <a href="#login" class="btn-get-started">Get Started</a>

          </div>
        </div>
      </div>

    </section><!-- /Hero Section -->

    <!-- About Section -->
    <section id="login" class="login section">
      <div class="container">
        <div class="row justify-content-center">
          
          <div class="col-md-6 text-center mb-5">
  
            <h2 class="heading-section">Login </h2>
          </div>
        </div>
        <div class="row justify-content-center">
          <div class="col-md-6 col-lg-4">
      
          
          
            <div class="login-outline">	<div class="login-wrap p-0">
              <h3 class="mb-4 text-center">Have an account?</h3>
              <form id="loginForm" action="login_process.php" class="signin-form" method="post">
             <!-- Display error message if it's set and not empty -->
<?php if (isset($_SESSION['login_error']) && !empty($_SESSION['login_error'])): ?>
    <div class="alert alert-danger" role="alert">
        <?php echo $_SESSION['login_error']; ?>
    </div>
    <?php unset($_SESSION['login_error']); ?>
<?php endif; ?>


                <div class="form-group">
                  <input type="text" class="form-control" name="username" placeholder="Username" required>
                </div>
                <div class="form-group">
                  <input type="password" class="form-control" name="password" id="password-field" placeholder="Password" required>
                
                  <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                </div>
                <div class="form-group">
                    <button type="submit" class="form-control btn btn-primary submit px-3">Sign In</button>
                </div>
               
              </form>
              <div class="text-center">
                <p>Not Registered? <a href="registration.html">Register here</a></p>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>


    </section><!-- /About Section -->
  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>
  
     
    
  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>

  <!-- Main JS File -->
  <script src="assets/js/main.js"></script>
  

</body>

</html>

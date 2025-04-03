<!doctype html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login | SSN PRO</title>
    <meta name="description" content="SSN PRO - Responsive Bootstrap 5 Admin Dashboard Template">
    <meta name="keywords" content="admin, dashboard, template, bootstrap 5, SSN PRO">
    <meta name="author" content="Iqonic Design">

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('assets/css/core/libs.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/qompac-ui.min.css?v=1.0.1') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.min.css?v=1.0.1') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/dark.min.css?v=1.0.1') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/customizer.min.css?v=1.0.1') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/rtl.min.css?v=1.0.1') }}">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@300;400;500;700&display=swap" rel="stylesheet">

    <!-- Custom Styles -->
    <style>
      * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
      }

      body {
        height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        position: relative;
        background: #121212;
      }

      /* Canvas Background */
      #backgroundCanvas {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: -1;
      }

      .login-container {
        background: rgba(25, 25, 25, 0.95);
        padding: 2rem;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(255, 255, 255, 0.1);
        width: 90%;
        max-width: 380px;
        text-align: center;
        position: relative;
        z-index: 2;
        color: white;
      }

      .login-container h2 {
        font-weight: 600;
        margin-bottom: 1rem;
      }

      .form-group {
        margin-bottom: 1rem;
        text-align: left;
      }

      .form-group label {
        font-weight: 500;
      }

      .form-control {
        border-radius: 8px;
        padding: 0.75rem;
        border: 1px solid #333;
        background: #222;
        color: white;
      }

      .btn-primary {
        width: 100%;
        padding: 0.75rem;
        border-radius: 8px;
        font-size: 16px;
        font-weight: 600;
        background: #007bff;
        border: none;
        transition: background 0.3s;
      }

      .btn-primary:hover {
        background: #0056b3;
      }

      .forgot-password, .register-link {
        display: block;
        margin-top: 0.75rem;
        color: #007bff;
        text-decoration: none;
        font-size: 14px;
      }

      .forgot-password:hover, .register-link:hover {
        text-decoration: underline;
      }

      /* Responsive Design */
      @media (max-width: 576px) {
        .login-container {
          padding: 1.5rem;
          max-width: 320px;
        }
      }

      @media (min-width: 992px) {
        .login-container {
          max-width: 300px;
          padding: 2rem;
        }
      }
    </style>
  </head>
  <body>

    <!-- Animated Canvas Background -->
    <canvas id="backgroundCanvas"></canvas>

   @yield('auth-content')

    <!-- JavaScript Libraries -->
    <script src="{{ asset('assets/js/core/libs.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/slider-tabs.js') }}"></script>
    <script src="{{ asset('assets/js/iqonic-script/utility.min.js') }}"></script>
    <script src="{{ asset('assets/js/iqonic-script/setting.min.js') }}"></script>
    <script src="{{ asset('assets/js/setting-init.js') }}"></script>
    <script src="{{ asset('assets/js/core/external.min.js') }}"></script>
    <script src="{{ asset('assets/js/charts/widgetcharts.js?v=1.0.1') }}" defer></script>
    <script src="{{ asset('assets/js/charts/dashboard.js?v=1.0.1') }}" defer></script>
    <script src="{{ asset('assets/js/qompac-ui.js?v=1.0.1') }}" defer></script>
    <script src="{{ asset('assets/js/sidebar.js?v=1.0.1') }}" defer></script>

    <!-- Canvas Background Animation -->
    <script>
      const canvas = document.getElementById("backgroundCanvas");
      const ctx = canvas.getContext("2d");

      canvas.width = window.innerWidth;
      canvas.height = window.innerHeight;

      let particlesArray = [];

      class Particle {
        constructor() {
          this.x = Math.random() * canvas.width;
          this.y = Math.random() * canvas.height;
          this.size = Math.random() * 4 + 1;
          this.speedX = Math.random() * 1 - 0.5;
          this.speedY = Math.random() * 1 - 0.5;
        }

        update() {
          this.x += this.speedX;
          this.y += this.speedY;

          if (this.x > canvas.width || this.x < 0) this.speedX = -this.speedX;
          if (this.y > canvas.height || this.y < 0) this.speedY = -this.speedY;
        }

        draw() {
          ctx.fillStyle = "rgba(255, 255, 255, 0.8)";
          ctx.beginPath();
          ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2);
          ctx.fill();
        }
      }

      function init() {
        particlesArray = [];
        for (let i = 0; i < 150; i++) {
          particlesArray.push(new Particle());
        }
      }

      function animate() {
        ctx.fillStyle = "rgba(0, 0, 0, 0.2)";
        ctx.fillRect(0, 0, canvas.width, canvas.height);
        for (let particle of particlesArray) {
          particle.update();
          particle.draw();
        }
        requestAnimationFrame(animate);
      }

      init();
      animate();

      window.addEventListener("resize", () => {
        canvas.width = window.innerWidth;
        canvas.height = window.innerHeight;
        init();
      });
    </script>

  </body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="SSN PRO - The most secure and advanced resource platform for authentic documents, fast banking support, and worldwide service.">
    <meta name="robots" content="index, follow"> <!-- Allow search engines to index and follow links -->
    <meta property="og:title" content="SSN Pro - The Most Secure Resource Platform">
    <meta property="og:description" content="Get the best quality docs worldwide with 100% working ratio and lightning-fast support.">
    <meta property="og:url" content="">
    <meta property="og:image" content="path_to_image.jpg"> <!-- Optional image for social media sharing -->
    <title>SSN PRO</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <style>
        body {
            margin: 0;
            padding: 0;
            background: linear-gradient(45deg, #0f2027, #203a43, #2c5364);
            color: white;
            font-family: 'Poppins', sans-serif;
            overflow-x: hidden;
        }
        .hero {
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            position: relative;
            padding: 20px;
        }
        .hero h1 {
            font-size: 3rem;
            font-weight: bold;
            text-transform: uppercase;
        }
        .buttons {
            margin-top: 20px;
        }
        .buttons .btn {
            margin: 10px;
            padding: 12px 24px;
            font-size: 1.2rem;
            border-radius: 30px;
        }
        .animation-bg {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            overflow: hidden;
        }
        .animation-bg span {
            position: absolute;
            width: 20px;
            height: 20px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            animation: move 10s linear infinite;
        }
        @keyframes move {
            from {
                transform: translateY(0);
            }
            to {
                transform: translateY(-100vh);
            }
        }
        .feature-section {
            padding: 60px 20px;
            text-align: center;
        }
        .feature-section .feature-box {
            padding: 20px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            transition: 0.3s;
        }
        .feature-section .feature-box:hover {
            background: rgba(255, 255, 255, 0.2);
        }
    </style>
</head>

<body>
    <div class="animation-bg"></div>
    <header class="hero">
        <div>
            <h1>Welcome to SSN PRO</h1>
            <p>The most secure and advanced  resource platform</p>
            <div class="buttons">
                <a href="{{ route('login') }}" class="btn btn-primary">Sign In</a>
                <a href="{{ route('signUp') }}" class="btn btn-success">Sign Up</a>
            </div>
        </div>
       <a href="https://t.me/ssnprosale" target="_blank" class="telegram-btn">
    <!-- SVG Circle Background -->
    <!--<svg width="34" height="34">-->
    <!--    <circle cx="17" cy="17" fill="var(--accent-btn-color)" r="17"></circle>-->
    <!--</svg>-->
    <!-- Telegram Icon -->
    <i class="fab fa-telegram fa-2x"></i> Contact us on Telegram
</a>
    </header>

    <section class="container feature-section">
        <h2>Why Choose SSN PRO?</h2>
        <p>We offer the best security, lightning-fast resource, and the lowest fees in the industry.</p>
        <div class="row mt-4">
            <div class="col-md-4 feature-box">
                <h3>Secure</h3>
                <p>Get The Best Quality Doc's Worldwide with 100% working ratio.</p>
            </div>
            <div class="col-md-4 feature-box">
                <h3>Fast</h3>
                <p>24/7 Contact Support & Banking Support.</p>
            </div>
            <div class="col-md-4 feature-box">
                <h3>Authentic</h3>
                <p>One SSN Multiple Bank</p>
            </div>
        </div>
    </section>

    <section class="bg-light text-dark py-5 text-center">
        <div class="container">
            <h2>About SSN Pro</h2>
            <p>SSN Pro is designed for professional resource enthusiasts who demands authentic and fresh.</p>
        </div>
    </section>

    <section class="container my-5 text-center">
        <h2>Sign up and Activate your Account</h2>
        <p>Get the best quality docs.</p>
        
    </section>

    <footer class="bg-dark text-white text-center py-4">
        <p>&copy; 2023-present SSN Pro. All rights reserved.</p>
    </footer>

    <script>
        // Generate animated circles
        $(document).ready(function() {
            for (let i = 0; i < 30; i++) {
                let size = Math.random() * 30;
                let span = $('<span></span>');
                span.css({
                    left: Math.random() * 100 + '%',
                    top: Math.random() * 100 + '%',
                    width: size + 'px',
                    height: size + 'px',
                    animationDuration: (Math.random() * 10 + 5) + 's'
                });
                $('.animation-bg').append(span);
            }
        });
    </script>
</body>
</html>

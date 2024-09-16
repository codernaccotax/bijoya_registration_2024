<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yearly Get-Together Invitation</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <style>
    .hero {
        /* background: url('https://via.placeholder.com/1600x600') no-repeat center center; */
        /* background-image: linear-gradient(to right, rgba(255,0,0,0), rgba(255,0,0,1)); */
        /* background-image: url("images/durga.jpg"); */
        background-size: cover;
        color: black;
        text-align: center;
        /* padding: 100px 0; */
    }

    .hero h1 {
        font-size: 2rem;
    }

    .hero p {
        font-size: 1.25rem;
    }

    .section {
        padding: 60px 0;
    }



    body {
        background: #ffffff;
    }

    .circle {
        position: absolute;
        border-radius: 50%;
        background: white;
        animation: ripple 15s infinite;
        box-shadow: 0px 0px 1px 0px #508fb9;
    }

    .small {
        width: 200px;
        height: 200px;
        left: -100px;
        bottom: -100px;
    }

    .medium {
        width: 400px;
        height: 400px;
        left: -200px;
        bottom: -200px;
    }

    .large {
        width: 600px;
        height: 600px;
        left: -300px;
        bottom: -300px;
    }

    .xlarge {
        width: 800px;
        height: 800px;
        left: -400px;
        bottom: -400px;
    }

    .xxlarge {
        width: 1000px;
        height: 1000px;
        left: -500px;
        bottom: -500px;
    }

    .shade1 {
        /* opacity: 0.2; */
        background: #d9d9f2;
        z-index: -5;
    }

    .shade2 {
        /* opacity: 0.5; */
        background: #b3b3e6;
        z-index: -4;
    }

    .shade3 {
        /* opacity: 0.7; */
        background: #7979d2;
        z-index: -3;
    }

    .shade4 {
        /* opacity: 0.8; */
        background: #5353c6;
        z-index: -2;
    }

    .shade5 {
        /* opacity: 0.9; */
        background: #333399;
        z-index: -1;
    }

    @keyframes ripple {
        0% {
            transform: scale(0.8);
        }

        50% {
            transform: scale(1.2);
        }

        100% {
            transform: scale(0.8);
        }
    }

    #durga-img {
        box-shadow: 10px 20px 30px grey;
    }


    .glow {
        font-size: 40px;
        color: #fff;
        text-align: center;
        animation: glow 1s ease-in-out infinite alternate;
    }

    @-webkit-keyframes glow {
        from {
            text-shadow: 0 0 10px #fff, 0 0 20px #fff, 0 0 30px #e60073, 0 0 40px #e60073, 0 0 50px #e60073, 0 0 60px #e60073, 0 0 70px #e60073;
        }

        to {
            text-shadow: 0 0 20px #fff, 0 0 30px #ff4da6, 0 0 40px #ff4da6, 0 0 50px #ff4da6, 0 0 60px #ff4da6, 0 0 70px #ff4da6, 0 0 80px #ff4da6;
        }
    }
    </style>
</head>

<body>
    <div class='ripple-background'>
        <div class='circle xxlarge shade1'></div>
        <div class='circle xlarge shade2'></div>
        <div class='circle large shade3'></div>
        <div class='circle mediun shade4'></div>
        <div class='circle small shade5'></div>
    </div>

    <!-- Hero Section -->
    <section class="hero">
        <img src="images/channels4_profile.jpg" width="70" alt="">
        <div class="container">
            <h1>Join Us for Our Yearly Get-Together!</h1>
            <img id="durga-img" src="images/durga.jpg" width="300" alt="">
            <p><b>We’re excited to invite you to our annual gathering. Let’s make unforgettable memories together!</b>
            </p>
            <a href="./registration.php" class="glow btn btn-primary btn-lg">Click Here for Registration</a>
        </div>
    </section>

    <!-- Invitation Section -->
    <section id="invitation" class="section text-center">
        <div class="container">
            <h2>You're Invited!</h2>
            <p>We look forward to seeing you at our yearly event. It's a perfect chance to catch up, enjoy good company,
                and have a great time.</p>
            <a href="#contact" class="btn btn-primary">RSVP Now</a>
        </div>
    </section>

    <!-- Event Details Section -->
    <section id="details" class="section bg-light">
        <div class="container">
            <h2 class="text-center">Event Details</h2>
            <div class="row">
                <div class="col-md-6">
                    <h3>Date and Time</h3>
                    <p>Saturday, October 12, 2024<br>From 5:00 PM to 10:00 PM</p>
                </div>
                <div class="col-md-6">
                    <h3>Location</h3>
                    <p>123 Celebration Lane,<br>Party City, PC 12345</p>
                </div>
            </div>
        </div>
    </section>


    <!-- Footer -->
    <footer class="bg-light text-center py-3">
        <p>&copy; 2024 Get-Together Event. All rights reserved.</p>
    </footer>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script>
</body>

</html>
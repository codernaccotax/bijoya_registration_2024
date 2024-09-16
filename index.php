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
            background-image: linear-gradient(to right, rgba(255,0,0,0), rgba(255,0,0,1));
            background-size: cover;
            color: white;
            text-align: center;
            padding: 100px 0;
        }
        .hero h1 {
            font-size: 3rem;
        }
        .hero p {
            font-size: 1.25rem;
        }
        .section {
            padding: 60px 0;
        }
    </style>
</head>

<body>

    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <h1>Join Us for Our Yearly Get-Together!</h1>
            <p>We’re excited to invite you to our annual gathering. Let’s make unforgettable memories together!</p>
            <a href="./registration.php" class="btn btn-primary btn-lg">Click Here for Registration</a>
        </div>
    </section>

    <!-- Invitation Section -->
    <section id="invitation" class="section text-center">
        <div class="container">
            <h2>You're Invited!</h2>
            <p>We look forward to seeing you at our yearly event. It's a perfect chance to catch up, enjoy good company, and have a great time.</p>
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

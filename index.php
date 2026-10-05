<?php
// Include header
include 'includes/header.php';
?>

<!-- Hero Section -->
<section class="hero">
    <div class="container">
        <h1>Welcome to PSUT Announcements & News Portal</h1>
        <p>Stay updated with the latest news, events, and announcements from Princess Sumaya University for Technology.</p>
        <a href="auth/login.php" class="btn btn-primary btn-lg">Login</a>
        <a href="auth/register.php" class="btn btn-outline-light btn-lg ms-2">Register</a>
    </div>
</section>

<!-- About Section -->
<section class="container my-5">
    <div class="row">
        <div class="col-lg-6">
            <h2>About PSUT</h2>
            <p>Princess Sumaya University for Technology (PSUT) is a specialized, non-governmental, non-profit Jordanian university, established in 1991, owned by the Royal Scientific Society (RSS), the leading applied research center in Jordan.</p>
            <p>PSUT's vision is to build a distinctive reputation for its graduates by offering a specialized and high-quality education that meets market demand and enables graduates to compete locally, regionally and internationally.</p>
        </div>
        <div class="col-lg-6">
            <img src="assets/images/psut-campus.jpg" alt="PSUT Campus" class="img-fluid rounded shadow">
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="bg-light py-5">
    <div class="container">
        <h2 class="text-center mb-5">Portal Features</h2>
        <div class="row">
            <div class="col-md-4">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <i class="fas fa-bullhorn fa-3x text-primary mb-3"></i>
                        <h3 class="card-title">Announcements</h3>
                        <p class="card-text">Get the latest announcements from administration, faculty, and departments.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <i class="fas fa-newspaper fa-3x text-primary mb-3"></i>
                        <h3 class="card-title">News</h3>
                        <p class="card-text">Stay updated with the latest news and events happening on campus.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <i class="fas fa-user-circle fa-3x text-primary mb-3"></i>
                        <h3 class="card-title">User Account</h3>
                        <p class="card-text">Create your account to access all portal features and stay connected.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="container my-5 text-center">
    <h2>Join the PSUT Community</h2>
    <p class="lead">Create an account to access all portal features and stay connected with the latest announcements.</p>
    <a href="auth/register.php" class="btn btn-primary btn-lg mt-3">Register Now</a>
</section>

<?php
// Include footer
include 'includes/footer.php';
?> 
<?php
// Start the session for user authentication
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PSUT Announcements & News Portal</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <div class="container">
                <a class="navbar-brand" href="index.php">PSUT Portal</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Home</a>
                        </li>
                        <?php if (isset($_SESSION["username"])): ?>
                            <li class="nav-item">
                                <a class="nav-link" href="announcements.php">Announcements</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="auth/logout.php">Logout</a>
                            </li>
                            <li class="nav-item">
                                <span class="nav-link text-white">Welcome, <?php echo htmlspecialchars($_SESSION["username"]); ?></span>
                            </li>
                        <?php else: ?>
                            <li class="nav-item">
                                <a class="nav-link" href="auth/login.php">Login</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="auth/register.php">Register</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <main class="container py-4"> 

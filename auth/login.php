<?php
// Include authentication functions
require_once 'auth_functions.php';

// Initialize variables
$username = $password = "";
$error_message = "";
$success_message = "";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate inputs
    $username = sanitizeInput($_POST["username"]);
    $password = $_POST["password"]; // Don't sanitize password as it may contain special characters
    
    // Server-side validation
    if (empty($username)) {
        $error_message = "Username is required";
    } elseif (empty($password)) {
        $error_message = "Password is required";
    } else {
        // Attempt to login the user
        $result = loginUser($username, $password);
        
        if ($result['status'] === 'success') {
            // Redirect to announcements page
            header("Location: ../announcements.php");
            exit;
        } else {
            $error_message = $result['message'];
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - PSUT Portal</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../assets/css/style.css">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="form-container">
                    <div class="text-center mb-4">
                        <h2>Login to PSUT Portal</h2>
                        <p>Access announcements and news</p>
                    </div>
                    
                    <?php if (!empty($error_message)): ?>
                        <div class="alert alert-danger"><?php echo $error_message; ?></div>
                    <?php endif; ?>
                    
                    <?php if (!empty($success_message)): ?>
                        <div class="alert alert-success"><?php echo $success_message; ?></div>
                    <?php endif; ?>
                    
                    <form id="loginForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" value="<?php echo $username; ?>">
                        </div>
                        
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <div class="password-container">
                                <input type="password" class="form-control" id="password" name="password">
                                <span class="password-toggle"><i class="fas fa-eye"></i></span>
                            </div>
                        </div>
                        
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg">Login</button>
                        </div>
                    </form>
                    
                    <div class="mt-3 text-center">
                        <p>Don't have an account? <a href="register.php">Register here</a></p>
                        <p><a href="../index.php">Back to Home</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JavaScript -->
    <script src="../assets/js/script.js"></script>
</body>
</html> 

<?php
// Include authentication functions
require_once 'auth_functions.php';

// Initialize variables
$username = $email = $school = $password = $confirm_password = "";
$error_message = "";
$success_message = "";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate inputs
    $username = sanitizeInput($_POST["username"]);
    $email = sanitizeInput($_POST["email"]);
    $school = sanitizeInput($_POST["school"]);
    $password = $_POST["password"]; // Don't sanitize password as it may contain special characters
    $confirm_password = $_POST["confirm_password"];
    
    // Server-side validation
    if (empty($username)) {
        $error_message = "Username is required";
    } elseif (empty($email)) {
        $error_message = "Email is required";
    } elseif (!isValidEmail($email)) {
        $error_message = "Invalid email format";
    } elseif (empty($school)) {
        $error_message = "School selection is required";
    } elseif (empty($password)) {
        $error_message = "Password is required";
    } elseif (!isStrongPassword($password)) {
        $error_message = "Password must be at least 8 characters and include letters, numbers, and special characters";
    } elseif ($password !== $confirm_password) {
        $error_message = "Passwords do not match";
    } else {
        // Register the user
        $result = registerUser($username, $email, $school, $password);
        
        if ($result['status'] === 'success') {
            $success_message = $result['message'] . ". You can now <a href='login.php'>login</a>.";
            // Clear form data
            $username = $email = $school = $password = $confirm_password = "";
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
    <title>Register - PSUT Portal</title>
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
                        <h2>Create an Account</h2>
                        <p>Register to access PSUT Announcements & News</p>
                    </div>
                    
                    <?php if (!empty($error_message)): ?>
                        <div class="alert alert-danger"><?php echo $error_message; ?></div>
                    <?php endif; ?>
                    
                    <?php if (!empty($success_message)): ?>
                        <div class="alert alert-success"><?php echo $success_message; ?></div>
                    <?php endif; ?>
                    
                    <form id="registrationForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" value="<?php echo $username; ?>">
                        </div>
                        
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>">
                        </div>
                        
                        <div class="mb-3">
                            <label for="school" class="form-label">School</label>
                            <select class="form-select" id="school" name="school">
                                <option value="" <?php echo empty($school) ? 'selected' : ''; ?>>Select School</option>
                                <option value="School of Computing Sciences" <?php echo $school == "School of Computing Sciences" ? 'selected' : ''; ?>>School of Computing Sciences</option>
                                <option value="School of Business Technology" <?php echo $school == "School of Business Technology" ? 'selected' : ''; ?>>School of Business Technology</option>
                                <option value="School of Electrical Engineering" <?php echo $school == "School of Electrical Engineering" ? 'selected' : ''; ?>>School of Electrical Engineering</option>
                                <option value="School of Applied Sciences" <?php echo $school == "School of Applied Sciences" ? 'selected' : ''; ?>>School of Applied Sciences</option>
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <div class="password-container">
                                <input type="password" class="form-control" id="password" name="password">
                                <span class="password-toggle"><i class="fas fa-eye"></i></span>
                            </div>
                            <small class="text-muted">Must be at least 8 characters and include letters, numbers, and special characters</small>
                        </div>
                        
                        <div class="mb-3">
                            <label for="confirmPassword" class="form-label">Confirm Password</label>
                            <div class="password-container">
                                <input type="password" class="form-control" id="confirmPassword" name="confirm_password">
                                <span class="password-toggle"><i class="fas fa-eye"></i></span>
                            </div>
                        </div>
                        
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg">Register</button>
                        </div>
                    </form>
                    
                    <div class="mt-3 text-center">
                        <p>Already have an account? <a href="login.php">Login here</a></p>
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

<?php
// Authentication helper functions

// Include database connection
require_once '../config/database.php';

/**
 * Register a new user
 * 
 * @param string $username The username
 * @param string $email The email address
 * @param string $school The school
 * @param string $password The password
 * @return array Array with status and message
 */
function registerUser($username, $email, $school, $password) {
    global $conn;
    
    // Check if username already exists
    $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        return ['status' => 'error', 'message' => 'Username already taken'];
    }
    
    // Check if email already exists
    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        return ['status' => 'error', 'message' => 'Email already registered'];
    }
    
    // Hash the password with salt
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
    // Insert the new user
    $stmt = $conn->prepare("INSERT INTO users (username, email, school, password) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $username, $email, $school, $hashed_password);
    
    if ($stmt->execute()) {
        return ['status' => 'success', 'message' => 'Registration successful'];
    } else {
        return ['status' => 'error', 'message' => 'Registration failed: ' . $conn->error];
    }
}

/**
 * Authenticate user login
 * 
 * @param string $username The username
 * @param string $password The password
 * @return array Array with status and message
 */
function loginUser($username, $password) {
    global $conn;
    
    // Check if user is blocked
    $stmt = $conn->prepare("SELECT is_blocked, block_expires FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        
        // Check if user is blocked
        if ($user['is_blocked'] == 1) {
            // Check if block period has expired
            if ($user['block_expires'] > date('Y-m-d H:i:s')) {
                return ['status' => 'error', 'message' => 'Your account is temporarily blocked. Please try again later.'];
            } else {
                // Unblock the user
                $stmt = $conn->prepare("UPDATE users SET is_blocked = 0, login_attempts = 0 WHERE username = ?");
                $stmt->bind_param("s", $username);
                $stmt->execute();
            }
        }
    }
    
    // Get user information
    $stmt = $conn->prepare("SELECT id, username, password, login_attempts FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows == 0) {
        return ['status' => 'error', 'message' => 'Invalid username or password'];
    }
    
    $user = $result->fetch_assoc();
    
    // Verify password
    if (password_verify($password, $user['password'])) {
        // Reset login attempts
        $stmt = $conn->prepare("UPDATE users SET login_attempts = 0 WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        
        // Start session and store user information
        session_start();
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        
        return ['status' => 'success', 'message' => 'Login successful'];
    } else {
        // Increment login attempts
        $login_attempts = $user['login_attempts'] + 1;
        
        // Check if we should block the user (3 failed attempts)
        if ($login_attempts >= 3) {
            // Block the user for 5 minutes
            $block_expires = date('Y-m-d H:i:s', strtotime('+5 minutes'));
            $stmt = $conn->prepare("UPDATE users SET login_attempts = ?, is_blocked = 1, block_expires = ? WHERE username = ?");
            $stmt->bind_param("iss", $login_attempts, $block_expires, $username);
            $stmt->execute();
            
            return ['status' => 'error', 'message' => 'Too many failed login attempts. Your account has been temporarily blocked for 5 minutes.'];
        } else {
            // Update login attempts
            $stmt = $conn->prepare("UPDATE users SET login_attempts = ?, last_login_attempt = NOW() WHERE username = ?");
            $stmt->bind_param("is", $login_attempts, $username);
            $stmt->execute();
            
            return ['status' => 'error', 'message' => 'Invalid username or password. You have ' . (3 - $login_attempts) . ' attempts remaining.'];
        }
    }
}

/**
 * Sanitize input data
 * 
 * @param string $data The input data
 * @return string Sanitized data
 */
function sanitizeInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

/**
 * Validate email format
 * 
 * @param string $email The email to validate
 * @return bool True if valid, false otherwise
 */
function isValidEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

/**
 * Check if password is strong
 * 
 * @param string $password The password to check
 * @return bool True if strong, false otherwise
 */
function isStrongPassword($password) {
    // Minimum 8 characters, at least one letter, one number and one special character
    return preg_match('/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/', $password);
}

/**
 * Generate a random token
 * 
 * @param int $length The length of the token
 * @return string The generated token
 */
function generateToken($length = 6) {
    return str_pad(rand(0, 999999), $length, '0', STR_PAD_LEFT);
}

/**
 * Verify if a user is logged in
 * 
 * @return bool True if logged in, false otherwise
 */
function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

/**
 * Redirect to login page if not logged in
 */
function requireLogin() {
    if (!isLoggedIn()) {
        header("Location: auth/login.php");
        exit;
    }
}
?> 

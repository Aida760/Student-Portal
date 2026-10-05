// PSUT Announcements & News Portal JavaScript

document.addEventListener('DOMContentLoaded', function() {
    // Toggle password visibility
    const togglePassword = document.querySelectorAll('.password-toggle');
    
    if (togglePassword) {
        togglePassword.forEach(function(toggle) {
            toggle.addEventListener('click', function() {
                const passwordField = this.previousElementSibling;
                
                // Toggle the password field type
                if (passwordField.type === 'password') {
                    passwordField.type = 'text';
                    this.innerHTML = '<i class="fas fa-eye-slash"></i>';
                } else {
                    passwordField.type = 'password';
                    this.innerHTML = '<i class="fas fa-eye"></i>';
                }
            });
        });
    }
    
    // Form validation for registration
    const registrationForm = document.getElementById('registrationForm');
    
    if (registrationForm) {
        registrationForm.addEventListener('submit', function(event) {
            let isValid = true;
            
            // Get form elements
            const username = document.getElementById('username');
            const email = document.getElementById('email');
            const school = document.getElementById('school');
            const password = document.getElementById('password');
            const confirmPassword = document.getElementById('confirmPassword');
            
            // Clear previous error messages
            clearErrors();
            
            // Validate username
            if (username.value.trim() === '') {
                showError(username, 'Username is required');
                isValid = false;
            }
            
            // Validate email
            if (email.value.trim() === '') {
                showError(email, 'Email is required');
                isValid = false;
            } else if (!isValidEmail(email.value)) {
                showError(email, 'Please enter a valid email address');
                isValid = false;
            }
            
            // Validate school selection
            if (school.value === '') {
                showError(school, 'Please select a school');
                isValid = false;
            }
            
            // Validate password
            if (password.value === '') {
                showError(password, 'Password is required');
                isValid = false;
            } else if (!isStrongPassword(password.value)) {
                showError(password, 'Password must be at least 8 characters long and include letters, numbers, and special characters');
                isValid = false;
            }
            
            // Validate confirm password
            if (confirmPassword.value === '') {
                showError(confirmPassword, 'Please confirm your password');
                isValid = false;
            } else if (password.value !== confirmPassword.value) {
                showError(confirmPassword, 'Passwords do not match');
                isValid = false;
            }
            
            // Prevent form submission if validation fails
            if (!isValid) {
                event.preventDefault();
            }
        });
    }
    
    // Form validation for login
    const loginForm = document.getElementById('loginForm');
    
    if (loginForm) {
        loginForm.addEventListener('submit', function(event) {
            let isValid = true;
            
            // Get form elements
            const username = document.getElementById('username');
            const password = document.getElementById('password');
            
            // Clear previous error messages
            clearErrors();
            
            // Validate username
            if (username.value.trim() === '') {
                showError(username, 'Username is required');
                isValid = false;
            }
            
            // Validate password
            if (password.value === '') {
                showError(password, 'Password is required');
                isValid = false;
            }
            
            // Prevent form submission if validation fails
            if (!isValid) {
                event.preventDefault();
            }
        });
    }
    
    // Helper functions
    function showError(input, message) {
        const formGroup = input.parentElement;
        const errorElement = document.createElement('div');
        errorElement.className = 'text-danger mt-1 validation-error';
        errorElement.textContent = message;
        formGroup.appendChild(errorElement);
        input.classList.add('is-invalid');
    }
    
    function clearErrors() {
        const errorMessages = document.querySelectorAll('.validation-error');
        errorMessages.forEach(function(error) {
            error.remove();
        });
        
        const invalidInputs = document.querySelectorAll('.is-invalid');
        invalidInputs.forEach(function(input) {
            input.classList.remove('is-invalid');
        });
    }
    
    function isValidEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }
    
    function isStrongPassword(password) {
        // Minimum 8 characters, at least one letter, one number, and one special character
        const passwordRegex = /^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
        return passwordRegex.test(password);
    }
}); 

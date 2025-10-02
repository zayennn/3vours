document.addEventListener('DOMContentLoaded', function() {
    const loginForm = document.getElementById('loginForm');
    const emailInput = document.getElementById('email');
    const passwordInput = document.getElementById('password');
    const emailError = document.getElementById('email-error');
    const passwordError = document.getElementById('password-error');
    
    loginForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        resetErrors();
        
        let isValid = true;
        
        if (!emailInput.value.trim()) {
            showError(emailError, 'Email is required');
            isValid = false;
        } else if (!isValidEmail(emailInput.value.trim())) {
            showError(emailError, 'Please enter a valid email address');
            isValid = false;
        }
        
        if (!passwordInput.value.trim()) {
            showError(passwordError, 'Password is required');
            isValid = false;
        } else if (passwordInput.value.trim().length < 6) {
            showError(passwordError, 'Password must be at least 6 characters');
            isValid = false;
        }
        
        if (isValid) {
            window.location.href = '/dashboard/home';
        }
    });
    
    emailInput.addEventListener('blur', function() {
        if (!emailInput.value.trim()) {
            showError(emailError, 'Email is required');
        } else if (!isValidEmail(emailInput.value.trim())) {
            showError(emailError, 'Please enter a valid email address');
        } else {
            clearError(emailError);
        }
    });
    
    passwordInput.addEventListener('blur', function() {
        if (!passwordInput.value.trim()) {
            showError(passwordError, 'Password is required');
        } else if (passwordInput.value.trim().length < 6) {
            showError(passwordError, 'Password must be at least 6 characters');
        } else {
            clearError(passwordError);
        }
    });
    
    emailInput.addEventListener('input', function() {
        if (emailError.textContent) {
            clearError(emailError);
        }
    });
    
    passwordInput.addEventListener('input', function() {
        if (passwordError.textContent) {
            clearError(passwordError);
        }
    });

    function isValidEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }
    
    function showError(errorElement, message) {
        errorElement.textContent = message;
        errorElement.style.display = 'block';
    }
    
    function clearError(errorElement) {
        errorElement.textContent = '';
        errorElement.style.display = 'none';
    }
    
    function resetErrors() {
        clearError(emailError);
        clearError(passwordError);
    }
    
    const formInputs = document.querySelectorAll('.form-group input');
    formInputs.forEach(input => {
        input.addEventListener('focus', function() {
            this.parentElement.classList.add('focused');
        });
        
        input.addEventListener('blur', function() {
            if (!this.value) {
                this.parentElement.classList.remove('focused');
            }
        });
    });
});
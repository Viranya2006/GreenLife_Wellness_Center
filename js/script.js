document.addEventListener('DOMContentLoaded', function() {

    // --- Form Validation ---
    const contactForm = document.getElementById('contactForm');
    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            if (!validateContactForm()) { e.preventDefault(); }
        });
    }
    
    const loginForm = document.getElementById('loginForm');
    if (loginForm) {
        loginForm.addEventListener('submit', function(e) {
            if (!validateLoginForm()) { e.preventDefault(); }
        });
    }
    
    const registerForm = document.getElementById('registerForm');
    if (registerForm) {
        registerForm.addEventListener('submit', function(e) {
            if (!validateRegisterForm()) { e.preventDefault(); }
        });
    }

    function validateContactForm() {
        let isValid = true;
        isValid &= validateField('name', 'Name is required.');
        isValid &= validateEmail('email');
        isValid &= validateField('subject', 'Subject is required.');
        isValid &= validateField('message', 'Message cannot be empty.');
        return isValid;
    }

    function validateLoginForm() {
        let isValid = true;
        isValid &= validateEmail('login-email');
        isValid &= validateField('login-password', 'Password is required.');
        return isValid;
    }

    function validateRegisterForm() {
        let isValid = true;
        isValid &= validateField('reg-name', 'Name is required.');
        isValid &= validateEmail('reg-email');
        isValid &= validatePassword('reg-password');
        isValid &= validatePasswordMatch('reg-password', 'reg-password-confirm');
        return isValid;
    }

    // --- Helper Functions for Validation ---
    function validateField(fieldId, errorMessage) {
        const field = document.getElementById(fieldId);
        if (field.value.trim() === '') {
            showError(field, errorMessage);
            return false;
        }
        showSuccess(field);
        return true;
    }

    function validateEmail(fieldId) {
        const field = document.getElementById(fieldId);
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        
        if (field.value.trim() === '') {
            showError(field, 'Email is required.');
            return false;
        } else if (!emailRegex.test(field.value)) {
            showError(field, 'Please enter a valid email address.');
            return false;
        }
        showSuccess(field);
        return true;
    }
    
    function validatePassword(fieldId) {
        const field = document.getElementById(fieldId);
        if (field.value.trim().length < 8) {
             showError(field, 'Password must be at least 8 characters long.');
             return false;
        }
        showSuccess(field);
        return true;
    }
    
    function validatePasswordMatch(passId1, passId2) {
        const pass1 = document.getElementById(passId1);
        const pass2 = document.getElementById(passId2);
        if(pass1.value !== pass2.value) {
            showError(pass2, 'Passwords do not match.');
            return false;
        }
        if (pass2.value.trim() !== '') { showSuccess(pass2); }
        return true;
    }

    function showError(input, message) {
        const formGroup = input.parentElement;
        const errorMessage = formGroup.querySelector('.error-message');
        formGroup.classList.add('error');
        errorMessage.innerText = message;
        errorMessage.style.display = 'block';
    }

    function showSuccess(input) {
        const formGroup = input.parentElement;
        formGroup.classList.remove('error');
        const errorMessage = formGroup.querySelector('.error-message');
        errorMessage.style.display = 'none';
    }
});
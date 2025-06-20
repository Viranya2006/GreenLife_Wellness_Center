<?php include 'header.php'; ?>
<title>Register - GreenLife Wellness Center</title>
<main>
    <section class="page-header"><div class="container"><h1>Create Your Account</h1></div></section>
    <section class="content-section">
        <div class="container form-container-small">
            <form id="registerForm" action="includes/register_handler.php" method="POST">
                <h2>Join Our Community</h2>

                <?php
                    if (isset($_GET['error'])) {
                        if ($_GET['error'] == 'email_exists') {
                            // Error message if the email exists.
                            echo '<p class="form-message error">email already registered</p>';
                        } else {
                            //  fallback for other potential errors.
                            echo '<p class="form-message error">An error occurred. Please try again.</p>';
                        }
                    }
                ?>
                <div class="form-group"><label for="reg-name">Full Name</label><input type="text" id="reg-name" name="name" required><small class="error-message"></small></div>
                <div class="form-group"><label for="reg-email">Email Address</label><input type="email" id="reg-email" name="email" required><small class="error-message"></small></div>
                <div class="form-group"><label for="reg-password">Password (min. 8 characters)</label><input type="password" id="reg-password" name="password" required><small class="error-message"></small></div>
                <div class="form-group"><label for="reg-password-confirm">Confirm Password</label><input type="password" id="reg-password-confirm" name="password_confirm" required><small class="error-message"></small></div>
                <button type="submit" class="btn-primary btn-full-width">Register</button>
                <p class="form-switch-text">Already have an account? <a href="login.php">Login here</a></p>
            </form>
        </div>
    </section>
</main>
<?php include 'footer.php'; ?>

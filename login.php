<?php include 'header.php'; ?>
<title>Login - GreenLife Wellness Center</title>
<main>
    <section class="page-header"><div class="container"><h1>Client & Staff Login</h1></div></section>
    <section class="content-section">
        <div class="container form-container-small">
            <form id="loginForm" action="includes/login_handler.php" method="POST">
                <h2>Welcome Back</h2>
                <?php
                    if (isset($_GET['error'])) { echo '<p class="form-message error">Invalid email or password.</p>'; }
                    if (isset($_GET['status']) && $_GET['status'] == 'reg_success') { echo '<p class="form-message success">Registration successful! Please log in.</p>'; }
                ?>
                <div class="form-group"><label for="login-email">Email Address</label><input type="email" id="login-email" name="email"><small class="error-message"></small></div>
                <div class="form-group"><label for="login-password">Password</label><input type="password" id="login-password" name="password"><small class="error-message"></small></div>
                <button type="submit" class="btn-primary btn-full-width">Login</button>
                <p class="form-switch-text">Don't have an account? <a href="register.php">Register here</a></p>
            </form>
        </div>
    </section>
</main>
<?php include 'footer.php'; ?>
<?php 
  // We include session.php on every page to ensure the session is always active.
  include_once 'includes/session.php'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/GreenLife%20Wellness%20Center/css/style.css">
</head>
<body>
    <header class="main-header">
        <div class="container">
            <a href="/GreenLife%20Wellness%20Center/index.html" class="logo"><img src="/GreenLife%20Wellness%20Center/images/logo.png" alt="GreenLife Logo"><span>GreenLife</span></a>
            <nav class="main-nav">
                <ul>
                    <li><a href="/GreenLife%20Wellness%20Center/index.html">Home</a></li>
                    <li><a href="/GreenLife%20Wellness%20Center/about.html">About Us</a></li>
                    <li><a href="/GreenLife%20Wellness%20Center/services.php">Services</a></li>
                    <li><a href="/GreenLife%20Wellness%20Center/contact.html">Contact Us</a></li>
                </ul>
            </nav>
            <div class="header-actions">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <?php 
                        $dashboard_link = '/GreenLife%20Wellness%20Center/client/index.php'; 
                        
                        if (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin') {
                            $dashboard_link = '/GreenLife%20Wellness%20Center/admin/index.php';
                        } elseif (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'therapist') {
                            $dashboard_link = '/GreenLife%20Wellness%20Center/therapist/index.php';
                        }
                    ?>
                    <a href="<?php echo $dashboard_link; ?>" class="btn-primary">Dashboard</a>
                    <a href="/GreenLife%20Wellness%20Center/logout.php" class="btn-secondary-outline">Logout</a>
                <?php else: ?>
                    <a href="/GreenLife%20Wellness%20Center/login.php" class="btn-primary">Book Now</a>
                <?php endif; ?>
            </div>
        </div>
    </header>

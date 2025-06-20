<?php 
//displays a form for the client to send a general inquiry.

    include_once '../includes/session.php';
    if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'client') { header("Location: /GreenLife%20Wellness%20Center/login.php"); exit(); }
    include '../header.php'; 
?>
<title>Send an Inquiry - GreenLife</title>
<main>
    <section class="page-header"><div class="container"><h1>Send a General Inquiry</h1></div></section>
    <section class="content-section">
        <div class="container dashboard-grid">
            <aside class="dashboard-nav">
                <h3>Client Menu</h3>
                <ul>
                    <li><a href="index.php">Dashboard</a></li>
                    <li><a href="book_appointment.php">Book Appointment</a></li>
                    <li><a href="upcoming_appointments.php">Upcoming Appointments</a></li>
                    <li><a href="send_inquiry.php" class="active">Send Inquiry</a></li>
                    <li><a href="pending_inquiries.php">My Inquiries</a></li>
                    <li><a href="my_profile.php">My Profile</a></li>
                    <li><a href="../logout.php">Logout</a></li>
                </ul>
            </aside>
            <div class="dashboard-content">
                <form id="inquiryForm" action="../includes/inquiry_handler.php" method="POST" class="form-container-small">
                    <h2>Your Question</h2>
                     <?php if (isset($_GET['status']) && $_GET['status'] == 'success') { echo '<p class="form-message success">Your inquiry has been sent!</p>'; } ?>
                    <div class="form-group"><label for="subject">Subject</label><input type="text" id="subject" name="subject" required><small class="error-message"></small></div>
                    <div class="form-group"><label for="message">Your Message</label><textarea id="message" name="message" rows="6" required></textarea><small class="error-message"></small></div>
                    <button type="submit" class="btn-primary btn-full-width">Send Inquiry</button>
                </form>
            </div>
        </div>
    </section>
</main>
<?php include '../footer.php'; ?>
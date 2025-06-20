<?php 
//  main dashboard page for a logged-in client.

// Includes the session and database connection files.
    include_once '../includes/session.php';
    include_once '../includes/db_connect.php';
    
// Security Check: Verifies that the user is logged in and has the 'client' role.
// If not, they are redirected to the login page.
    if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'client') {
        header("Location: /GreenLife%20Wellness%20Center/login.php");
        exit();
    }
    
    // Gets the user's name from the session to display a personalized welcome message.
    // htmlspecialchars() is used for security.
    $user_name = htmlspecialchars($_SESSION['user_name']);
    include '../header.php'; 
?>
<title>Your Dashboard - GreenLife</title>
<main>
    <section class="page-header"><div class="container"><h1>Welcome, <?php echo $user_name; ?>!</h1></div></section>
    <section class="content-section">
        <div class="container dashboard-grid">
            <aside class="dashboard-nav">
                <h3>Client Menu</h3>
                <ul>
                    <li><a href="index.php" class="active">Dashboard</a></li>
                    <li><a href="book_appointment.php">Book Appointment</a></li>
                    <li><a href="upcoming_appointments.php">Upcoming Appointments</a></li>
                    <li><a href="send_inquiry.php">Send Inquiry</a></li>
                    <li><a href="pending_inquiries.php">My Inquiries</a></li>
                    <li><a href="my_profile.php">My Profile</a></li>
                    <li><a href="../logout.php">Logout</a></li>
                </ul>
            </aside>
            <div class="dashboard-content">
                <h2>Client Dashboard</h2>
                <p>This is your personal space. From here you can book new appointments, view your upcoming sessions, send inquiries to our team, and manage your profile.</p>
                <p>Your journey to wellness is important to us. Explore your options and feel free to reach out with any questions.</p>
            </div>
        </div>
    </section>
</main>
<?php include '../footer.php'; ?>
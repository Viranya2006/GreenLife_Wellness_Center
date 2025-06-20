<?php 
// displays a form for clients to book a new appointment.

    include_once '../includes/session.php';
    if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'client') { header("Location: /GreenLife%20Wellness%20Center/login.php"); exit(); }
    include_once '../includes/db_connect.php';

    // SQL query to fetch all services from the database for the dropdown menu.
    $services_sql = "SELECT service_id, service_name FROM services ORDER BY service_name";
    $services_result = mysqli_query($conn, $services_sql);

    // SQL query to fetch all therapists from the database for the dropdown menu.
    $therapists_sql = "SELECT user_id, full_name FROM users WHERE role = 'therapist' ORDER BY full_name";
    $therapists_result = mysqli_query($conn, $therapists_sql);

    include '../header.php'; 
?>
<title>Book an Appointment - GreenLife</title>
<main>
    <section class="page-header"><div class="container"><h1>Book a Session</h1></div></section>
    <section class="content-section">
        <div class="container dashboard-grid">
            <aside class="dashboard-nav">
                <h3>Client Menu</h3>
                <ul>
                    <li><a href="index.php">Dashboard</a></li>
                    <li><a href="book_appointment.php" class="active">Book Appointment</a></li>
                    <li><a href="upcoming_appointments.php">Upcoming Appointments</a></li>
                    <li><a href="send_inquiry.php">Send Inquiry</a></li>
                    <li><a href="pending_inquiries.php">My Inquiries</a></li>
                    <li><a href="my_profile.php">My Profile</a></li>
                    <li><a href="../logout.php">Logout</a></li>
                </ul>
            </aside>
            <div class="dashboard-content">
                <form id="bookingForm" action="../includes/booking_handler.php" method="POST" class="form-container-small">
                    <h2>New Appointment</h2>
                    <?php if (isset($_GET['status']) && $_GET['status'] == 'success') { echo '<p class="form-message success">Your appointment request has been sent!</p>'; } ?>
                    <?php if (isset($_GET['error'])) { echo '<p class="form-message error">There was an error. Please try again.</p>'; } ?>
                    <div class="form-group"><label for="service">Choose a Service</label><select id="service" name="service_id" required><option value="">-- Select a Service --</option><?php while ($service = mysqli_fetch_assoc($services_result)) { echo "<option value='" . htmlspecialchars($service['service_id']) . "'>" . htmlspecialchars($service['service_name']) . "</option>"; } ?></select></div>
                    <div class="form-group"><label for="therapist">Choose a Therapist</label><select id="therapist" name="therapist_id" required><option value="">-- Select a Therapist --</option><?php while ($therapist = mysqli_fetch_assoc($therapists_result)) { echo "<option value='" . htmlspecialchars($therapist['user_id']) . "'>" . htmlspecialchars($therapist['full_name']) . "</option>"; } ?></select></div>
                    <div class="form-group"><label for="date">Select a Date</label><input type="date" id="date" name="appointment_date" required></div>
                    <div class="form-group"><label for="time">Select a Time</label><input type="time" id="time" name="appointment_time" required></div>
                    <button type="submit" class="btn-primary btn-full-width">Request Appointment</button>
                </form>
            </div>
        </div>
    </section>
</main>
<?php include '../footer.php'; ?>
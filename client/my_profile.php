<?php
// allows the client to view and update their profile information.

include_once '../includes/session.php';
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'client') { header("Location: /GreenLife%20Wellness%20Center/login.php"); exit(); }
include_once '../includes/db_connect.php';

// Get current user details to pre-fill the form.
$user_id = $_SESSION['user_id'];
$sql = "SELECT full_name, email FROM users WHERE user_id = $user_id";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);

include '../header.php'; 
?>
<title>My Profile - GreenLife</title>
<main>
    <section class="page-header"><div class="container"><h1>My Profile</h1></div></section>
    <section class="content-section">
        <div class="container dashboard-grid">
            <aside class="dashboard-nav">
                <h3>Client Menu</h3>
                <ul>
                    <li><a href="index.php">Dashboard</a></li>
                    <li><a href="book_appointment.php">Book Appointment</a></li>
                    <li><a href="upcoming_appointments.php">Upcoming Appointments</a></li>
                    <li><a href="send_inquiry.php">Send Inquiry</a></li>
                    <li><a href="pending_inquiries.php">My Inquiries</a></li>
                    <li><a href="my_profile.php" class="active">My Profile</a></li>
                    <li><a href="../logout.php">Logout</a></li>
                </ul>
            </aside>
            <div class="dashboard-content">
                <form id="profileForm" action="../includes/profile_handler.php" method="POST" class="form-container-small">
                    <h2>Your Details</h2>
                    <?php if (isset($_GET['status']) && $_GET['status'] == 'updated'){ echo '<p class="form-message success">Your profile has been updated successfully!</p>'; } ?>
                    <div class="form-group"><label for="name">Full Name</label><input type="text" id="name" name="name" value="<?php echo htmlspecialchars($user['full_name']); ?>"></div>
                    <div class="form-group"><label for="email">Email Address</label><input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>"></div>
                    <hr><p><strong>Change Password</strong></p>
                    <div class="form-group"><label for="new_password">New Password</label><input type="password" id="new_password" name="new_password"><small>Leave blank if you do not want to change the password.</small></div>
                    <button type="submit" class="btn-primary btn-full-width">Update Profile</button>
                </form>
            </div>
        </div>
    </section>
</main>
<?php mysqli_close($conn); include '../footer.php'; ?>
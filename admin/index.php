<?php
//main dashboard page for the administrator.

// Includes the session, functions, and database connection files.
    include_once '../includes/session.php';
    include_once '../includes/functions.php';
    check_admin(); // This function checks if the user is an admin, protecting the page.
    include_once '../includes/db_connect.php';

// SQL queries to get overview statistics for the dashboard cards.
// Each query counts the number of records in a specific table.
    $total_clients = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(user_id) AS total FROM users WHERE role = 'client'"))['total'];
    $total_therapists = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(user_id) AS total FROM users WHERE role = 'therapist'"))['total'];
    $total_appointments = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(appointment_id) AS total FROM appointments"))['total'];
    $open_inquiries = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(inquiry_id) AS total FROM inquiries WHERE status = 'open'"))['total'];

    include '../header.php';
?>
<title>Admin Dashboard - GreenLife</title>
<main>
    <section class="page-header"><div class="container"><h1>Administrator Dashboard</h1></div></section>
    <section class="content-section">
        <div class="container dashboard-grid">
            <!-- Admin Navigation Sidebar -->
             <aside class="dashboard-nav">
                <h3>Admin Menu</h3>
                <ul>
                    <li><a href="index.php" class="active">System Overview</a></li>
                    <li><a href="manage_appointments.php">Manage Appointments</a></li>
                    <li><a href="manage_clients.php">Manage Clients</a></li>
                    <li><a href="manage_therapists.php">Manage Therapists</a></li>
                    <li><a href="manage_services.php">Manage Services</a></li>
                    <li><a href="manage_inquiries.php">Manage Inquiries</a></li>
                    <li><a href="../logout.php">Logout</a></li>
                </ul>
            </aside>
            <!-- Main Content Area -->
            <div class="dashboard-content">
                <h2>System Overview</h2>
                <div class="stats-grid">
                    <div class="stat-card"><h3>Total Clients</h3><p><?php echo $total_clients; ?></p></div>
                    <div class="stat-card"><h3>Total Therapists</h3><p><?php echo $total_therapists; ?></p></div>
                    <div class="stat-card"><h3>Total Appointments</h3><p><?php echo $total_appointments; ?></p></div>
                    <div class="stat-card"><h3>Open Inquiries</h3><p><?php echo $open_inquiries; ?></p></div>
                </div>
            </div>
        </div>
    </section>
</main>
<?php include '../footer.php'; ?>
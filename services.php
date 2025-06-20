<?php
include 'header.php'; 
include_once 'includes/db_connect.php';

// Fetch all services from the database to display on the page
$sql = "SELECT service_name, description, image_path FROM services ORDER BY service_name";
$result = mysqli_query($conn, $sql);
?>
<title>Our Services - GreenLife Wellness Center</title>
<main>
    <section class="page-header" style="background-image: url('images/contactus-background.jpg');"><div class="container"><h1>Our Wellness Services</h1></div></section>
    <section class="content-section">
        <div class="container services-list">
            <?php if ($result && mysqli_num_rows($result) > 0): ?>
                <?php while($row = mysqli_fetch_assoc($result)): ?>
                    <div class="service-item">
                        <img src="<?php echo htmlspecialchars($row['image_path']); ?>" alt="<?php echo htmlspecialchars($row['service_name']); ?>" class="service-item-img">
                        <div class="service-item-text">
                            <h3><?php echo htmlspecialchars($row['service_name']); ?></h3>
                            <p><?php echo htmlspecialchars($row['description']); ?></p>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>No services are currently available. Please check back later.</p>
            <?php endif; ?>
        </div>
    </section>
</main>
<?php mysqli_close($conn); include 'footer.php'; ?>

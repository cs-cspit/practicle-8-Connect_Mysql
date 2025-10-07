<?php
include 'dbconnection.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    
    // First, check if the event exists
    $check_sql = "SELECT * FROM events WHERE id = $id";
    $check_result = $conn->query($check_sql);
    
    if ($check_result->num_rows > 0) {
        // Event exists, proceed with deletion
        $sql = "DELETE FROM events WHERE id = $id";
        
        if ($conn->query($sql) === TRUE) {
            $message = "Event deleted successfully!";
            $message_type = "success";
        } else {
            $message = "Error deleting event: " . $conn->error;
            $message_type = "error";
        }
    } else {
        $message = "Event not found!";
        $message_type = "error";
    }
} else {
    $message = "Invalid request!";
    $message_type = "error";
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Delete Event | Event Portal</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <!-- Header -->
  <header>
    <div class="container">
      <div class="header-content">
        <div class="logo">
          <i class="fas fa-calendar-alt"></i>
          <span>EventPortal</span>
        </div>
        <button class="mobile-menu-btn">
          <i class="fas fa-bars"></i>
        </button>
        <nav>
          <ul>
            <li><a href="index.html">Home</a></li>
            <li><a href="view_events.php">Events</a></li>
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="#">About</a></li>
            <li><a href="#">Contact</a></li>
          </ul>
        </nav>
      </div>
    </div>
  </header>

  <!-- Main Content -->
  <main class="container">
    <div class="card" style="text-align: center; padding: 3rem;">
      <?php if ($message_type == "success"): ?>
        <i class="fas fa-check-circle" style="font-size: 4rem; color: var(--success); margin-bottom: 1rem;"></i>
        <h2>Success!</h2>
        <div class="alert alert-success">
          <?php echo $message; ?>
        </div>
      <?php else: ?>
        <i class="fas fa-exclamation-circle" style="font-size: 4rem; color: var(--danger); margin-bottom: 1rem;"></i>
        <h2>Error</h2>
        <div class="alert alert-error">
          <?php echo $message; ?>
        </div>
      <?php endif; ?>
      
      <div style="margin-top: 2rem;">
        <a href="view_events.php" class="btn">
          <i class="fas fa-arrow-left"></i> Back to Events
        </a>
        <a href="index.html" class="btn btn-outline" style="margin-left: 10px;">
          <i class="fas fa-home"></i> Go Home
        </a>
      </div>
    </div>
  </main>

  <!-- Footer -->
  <footer>
    <div class="container">
      <div class="footer-content">
        <div class="footer-column">
          <h3>EventPortal</h3>
          <p>Your complete solution for event management and organization.</p>
          <div class="social-links">
            <a href="#"><i class="fab fa-facebook-f"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fab fa-linkedin-in"></i></a>
          </div>
        </div>
        <div class="footer-column">
          <h3>Quick Links</h3>
          <ul>
            <li><a href="index.html">Home</a></li>
            <li><a href="view_events.php">All Events</a></li>
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="index.html#add-event">Create Event</a></li>
          </ul>
        </div>
        <div class="footer-column">
          <h3>Resources</h3>
          <ul>
            <li><a href="#">Help Center</a></li>
            <li><a href="#">Event Guidelines</a></li>
            <li><a href="#">Privacy Policy</a></li>
            <li><a href="#">Terms of Service</a></li>
          </ul>
        </div>
        <div class="footer-column">
          <h3>Contact Us</h3>
          <ul>
            <li><i class="fas fa-envelope"></i> info@eventportal.com</li>
            <li><i class="fas fa-phone"></i> +1 (555) 123-4567</li>
            <li><i class="fas fa-map-marker-alt"></i> 123 Event Street, City, State</li>
          </ul>
        </div>
      </div>
      <div class="copyright">
        &copy; 2023 EventPortal. All rights reserved.
      </div>
    </div>
  </footer>

  <script>
    // Mobile menu toggle
    document.querySelector('.mobile-menu-btn').addEventListener('click', function() {
      document.querySelector('nav').classList.toggle('active');
    });

    // Auto redirect after 3 seconds if successful
    <?php if ($message_type == "success"): ?>
    setTimeout(function() {
      window.location.href = 'view_events.php';
    }, 3000);
    <?php endif; ?>
  </script>
</body>
</html>
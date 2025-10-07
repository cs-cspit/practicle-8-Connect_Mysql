<?php
include 'dbconnection.php';

$sql = "SELECT * FROM events ORDER BY created_at DESC LIMIT 5";
$result = $conn->query($sql);

// Get total events count
$total_events_sql = "SELECT COUNT(*) as total FROM events";
$total_events_result = $conn->query($total_events_sql);
$total_events = $total_events_result->fetch_assoc()['total'];

// Get upcoming events (events with future dates)
$upcoming_sql = "SELECT COUNT(*) as upcoming FROM events WHERE event_date >= CURDATE()";
$upcoming_result = $conn->query($upcoming_sql);
$upcoming_events = $upcoming_result->fetch_assoc()['upcoming'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard | Event Portal</title>
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
            <li><a href="dashboard.php" class="active">Dashboard</a></li>
            <li><a href="#">About</a></li>
            <li><a href="#">Contact</a></li>
          </ul>
        </nav>
      </div>
    </div>
  </header>

  <!-- Main Content -->
  <main class="container">
    <h1 class="section-title">Dashboard Overview</h1>
    
    <!-- Stats Section -->
    <section class="stats">
      <div class="stat-item">
        <span class="stat-number"><?php echo $total_events; ?></span>
        <span class="stat-label">Total Events</span>
      </div>
      <div class="stat-item">
        <span class="stat-number"><?php echo $upcoming_events; ?></span>
        <span class="stat-label">Upcoming Events</span>
      </div>
      <div class="stat-item">
        <span class="stat-number">5</span>
        <span class="stat-label">This Week</span>
      </div>
      <div class="stat-item">
        <span class="stat-number">89%</span>
        <span class="stat-label">Completion Rate</span>
      </div>
    </section>

    <!-- Latest Events -->
    <section>
      <h2 class="section-title">Latest 5 Events</h2>
      <div class="row">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='col-2'>";
                echo "<div class='card event-card'>";
                echo "<div class='card-header'>";
                echo "<h3 class='event-title'>" . htmlspecialchars($row['event_name']) . "</h3>";
                echo "<div class='event-meta'>";
                echo "<span><i class='fas fa-calendar'></i> " . date('M j, Y', strtotime($row['created_at'])) . "</span>";
                echo "</div>";
                echo "</div>";
                echo "<div class='card-body'>";
                echo "<p>" . htmlspecialchars($row['event_desc']) . "</p>";
                echo "</div>";
                echo "<div class='card-footer'>";
                echo "<div class='event-actions'>";
                echo "<a href='update_event.php?id=" . $row['id'] . "' class='btn btn-outline'>Edit</a>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
            }
        } else {
            echo "<div class='col'><p>No events found.</p></div>";
        }
        ?>
      </div>
    </section>

    <!-- Quick Actions -->
    <section>
      <h2 class="section-title">Quick Actions</h2>
      <div class="row">
        <div class="col-3">
          <div class="card" style="text-align: center; padding: 2rem;">
            <i class="fas fa-plus" style="font-size: 3rem; color: var(--success); margin-bottom: 1rem;"></i>
            <h3>Add Event</h3>
            <a href="index.html#add-event" class="btn btn-success">Create New</a>
          </div>
        </div>
        <div class="col-3">
          <div class="card" style="text-align: center; padding: 2rem;">
            <i class="fas fa-list" style="font-size: 3rem; color: var(--primary); margin-bottom: 1rem;"></i>
            <h3>View All</h3>
            <a href="view_events.php" class="btn">All Events</a>
          </div>
        </div>
        <div class="col-3">
          <div class="card" style="text-align: center; padding: 2rem;">
            <i class="fas fa-chart-pie" style="font-size: 3rem; color: var(--secondary); margin-bottom: 1rem;"></i>
            <h3>Reports</h3>
            <a href="#" class="btn btn-secondary">Generate</a>
          </div>
        </div>
        <div class="col-3">
          <div class="card" style="text-align: center; padding: 2rem;">
            <i class="fas fa-download" style="font-size: 3rem; color: var(--warning); margin-bottom: 1rem;"></i>
            <h3>Export</h3>
            <a href="#" class="btn btn-outline">Download</a>
          </div>
        </div>
      </div>
    </section>
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
  </script>
</body>
</html>
<?php
$conn->close();
?>
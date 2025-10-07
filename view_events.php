<?php
include 'dbconnection.php';

$sql = "SELECT * FROM events ORDER BY created_at DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>All Events | Event Portal</title>
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
            <li><a href="view_events.php" class="active">Events</a></li>
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
    <h1 class="section-title">All Events</h1>

    <!-- Search and Filter -->
    <div class="search-filter">
      <div class="row">
        <div class="col-3">
          <div class="form-group">
            <input type="text" id="search" class="form-control" placeholder="Search events...">
          </div>
        </div>
        <div class="col-3">
          <div class="form-group">
            <select id="sort" class="form-control">
              <option value="newest">Newest First</option>
              <option value="oldest">Oldest First</option>
            </select>
          </div>
        </div>
        <div class="col-3">
          <button class="btn" onclick="searchEvents()">
            <i class="fas fa-search"></i> Search
          </button>
        </div>
        
        <div class="card-footer">
  <div class="event-actions">
    <a href='update_event.php?id=<?php echo $row['id']; ?>' class='btn btn-outline'>Edit</a>
    <a href='delete_event.php?id=<?php echo $row['id']; ?>' class='btn btn-danger' 
       onclick='return confirm("Are you sure you want to delete this event?")'>Delete</a>
  </div>
</div>
        <div class="col-3">
          <a href="index.html#add-event" class="btn btn-secondary">
            <i class="fas fa-plus"></i> Add New Event
          </a>
        </div>
      </div>
    </div>

    <!-- Events Grid -->
    <div class="row">
      <?php
      if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
              echo "<div class='col-3'>";
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
              echo "<a href='#' class='btn btn-danger'>Delete</a>";
              echo "</div>";
              echo "</div>";
              echo "</div>";
              echo "</div>";
          }
      } else {
          echo "<div class='col'>";
          echo "<div class='card' style='text-align: center; padding: 3rem;'>";
          echo "<i class='fas fa-calendar-times' style='font-size: 4rem; color: var(--gray); margin-bottom: 1rem;'></i>";
          echo "<h3>No Events Found</h3>";
          echo "<p>Get started by creating your first event.</p>";
          echo "<a href='index.html#add-event' class='btn btn-secondary'>Create Event</a>";
          echo "</div>";
          echo "</div>";
      }
      ?>
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

    function searchEvents() {
      const searchTerm = document.getElementById('search').value.toLowerCase();
      const events = document.querySelectorAll('.event-card');
      
      events.forEach(event => {
        const title = event.querySelector('.event-title').textContent.toLowerCase();
        const description = event.querySelector('.card-body p').textContent.toLowerCase();
        
        if (title.includes(searchTerm) || description.includes(searchTerm)) {
          event.parentElement.style.display = 'block';
        } else {
          event.parentElement.style.display = 'none';
        }
      });
    }
  </script>
</body>
</html>
<?php
$conn->close();
?>
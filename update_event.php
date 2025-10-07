<?php
include 'dbconnection.php';

$success_message = '';
$error_message = '';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $conn->real_escape_string($_POST['event_name']);
        $desc = $conn->real_escape_string($_POST['event_desc']);
        $category = $conn->real_escape_string($_POST['event_category']);
        $date = $conn->real_escape_string($_POST['event_date']);
        $time = $conn->real_escape_string($_POST['event_time']);
        $location = $conn->real_escape_string($_POST['event_location']);

        $sql = "UPDATE events SET event_name='$name', event_desc='$desc', event_category='$category', 
                event_date='$date', event_time='$time', event_location='$location' WHERE id=$id";
        
        if ($conn->query($sql) === TRUE) {
            $success_message = "Event Updated Successfully!";
        } else {
            $error_message = "Error: " . $conn->error;
        }
    }

    $res = $conn->query("SELECT * FROM events WHERE id=$id");
    if ($res->num_rows > 0) {
        $row = $res->fetch_assoc();
    } else {
        die("Event not found!");
    }
} else {
    die("Invalid request!");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Update Event | Event Portal</title>
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
    <h1 class="section-title">Update Event</h1>

    <?php if ($success_message): ?>
      <div class="alert alert-success">
        <i class="fas fa-check-circle"></i> <?php echo $success_message; ?>
        <a href="view_events.php" style="margin-left: 10px;">View All Events</a>
      </div>
    <?php endif; ?>

    <?php if ($error_message): ?>
      <div class="alert alert-error">
        <i class="fas fa-exclamation-circle"></i> <?php echo $error_message; ?>
      </div>
    <?php endif; ?>

    <div class="card">
      <div class="card-body">
        <form method="POST" class="row">
          <div class="col-2">
            <div class="form-group">
              <label for="event_name" class="form-label">Event Name *</label>
              <input type="text" id="event_name" name="event_name" class="form-control" 
                     value="<?php echo htmlspecialchars($row['event_name']); ?>" required>
            </div>
          </div>
          <div class="col-2">
            <div class="form-group">
              <label for="event_category" class="form-label">Category</label>
              <select id="event_category" name="event_category" class="form-control">
                <option value="business" <?php echo ($row['event_category'] == 'business') ? 'selected' : ''; ?>>Business</option>
                <option value="technology" <?php echo ($row['event_category'] == 'technology') ? 'selected' : ''; ?>>Technology</option>
                <option value="social" <?php echo ($row['event_category'] == 'social') ? 'selected' : ''; ?>>Social</option>
                <option value="education" <?php echo ($row['event_category'] == 'education') ? 'selected' : ''; ?>>Education</option>
                <option value="other" <?php echo ($row['event_category'] == 'other') ? 'selected' : ''; ?>>Other</option>
              </select>
            </div>
          </div>
          <div class="col-2">
            <div class="form-group">
              <label for="event_date" class="form-label">Event Date *</label>
              <input type="date" id="event_date" name="event_date" class="form-control" 
                     value="<?php echo $row['event_date']; ?>" required>
            </div>
          </div>
          <div class="col-2">
            <div class="form-group">
              <label for="event_time" class="form-label">Event Time *</label>
              <input type="time" id="event_time" name="event_time" class="form-control" 
                     value="<?php echo $row['event_time']; ?>" required>
            </div>
          </div>
          <div class="col">
            <div class="form-group">
              <label for="event_desc" class="form-label">Event Description *</label>
              <textarea id="event_desc" name="event_desc" class="form-control" required><?php echo htmlspecialchars($row['event_desc']); ?></textarea>
            </div>
          </div>
          <div class="col">
            <div class="form-group">
              <label for="event_location" class="form-label">Location</label>
              <input type="text" id="event_location" name="event_location" class="form-control" 
                     value="<?php echo htmlspecialchars($row['event_location']); ?>" placeholder="Event location">
            </div>
            <div class="form-group" style="margin-top: 2rem;">
              <button type="submit" class="btn btn-secondary">
                <i class="fas fa-save"></i> Update Event
              </button>
              <a href="view_events.php" class="btn btn-outline" style="margin-left: 10px;">
                <i class="fas fa-arrow-left"></i> Back to Events
              </a>
            </div>
          </div>
        </form>
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
            <li><a href="add_event.php">Create Event</a></li>
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
<?php
include 'dbconnection.php';

$success_message = '';
$error_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST['event_name']);
    $desc = $conn->real_escape_string($_POST['event_desc']);
    $category = $conn->real_escape_string($_POST['event_category']);
    $date = $conn->real_escape_string($_POST['event_date']);
    $time = $conn->real_escape_string($_POST['event_time']);
    $location = $conn->real_escape_string($_POST['event_location']);

    $sql = "INSERT INTO events (event_name, event_desc, event_category, event_date, event_time, event_location) 
            VALUES ('$name', '$desc', '$category', '$date', '$time', '$location')";
    
    if ($conn->query($sql) === TRUE) {
        $success_message = "Event Added Successfully!";
    } else {
        $error_message = "Error: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Event | Event Portal</title>
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
    <h1 class="section-title">Add New Event</h1>

    <?php if ($success_message): ?>
      <div class="alert alert-success">
        <i class="fas fa-check-circle"></i> <?php echo $success_message; ?>
        <a href="view_events.php" style="margin-left: 10px;">View All Events</a> | 
        <a href="index.html" style="margin-left: 5px;">Go Back Home</a>
      </div>
    <?php endif; ?>

    <?php if ($error_message): ?>
      <div class="alert alert-error">
        <i class="fas fa-exclamation-circle"></i> <?php echo $error_message; ?>
      </div>
    <?php endif; ?>

    <div class="card">
      <div class="card-body">
        <form action="add_event.php" method="POST" class="row">
          <div class="col-2">
            <div class="form-group">
              <label for="event_name" class="form-label">Event Name *</label>
              <input type="text" id="event_name" name="event_name" class="form-control" placeholder="Enter event name" required>
            </div>
          </div>
          <div class="col-2">
            <div class="form-group">
              <label for="event_category" class="form-label">Category</label>
              <select id="event_category" name="event_category" class="form-control">
                <option value="business">Business</option>
                <option value="technology">Technology</option>
                <option value="social">Social</option>
                <option value="education">Education</option>
                <option value="other">Other</option>
              </select>
            </div>
          </div>
          <div class="col-2">
            <div class="form-group">
              <label for="event_date" class="form-label">Event Date *</label>
              <input type="date" id="event_date" name="event_date" class="form-control" required>
            </div>
          </div>
          <div class="col-2">
            <div class="form-group">
              <label for="event_time" class="form-label">Event Time *</label>
              <input type="time" id="event_time" name="event_time" class="form-control" required>
            </div>
          </div>
          <div class="col">
            <div class="form-group">
              <label for="event_desc" class="form-label">Event Description *</label>
              <textarea id="event_desc" name="event_desc" class="form-control" placeholder="Describe your event" required></textarea>
            </div>
          </div>
          <div class="col">
            <div class="form-group">
              <label for="event_location" class="form-label">Location</label>
              <input type="text" id="event_location" name="event_location" class="form-control" placeholder="Event location">
            </div>
            <div class="form-group" style="margin-top: 2rem;">
              <button type="submit" class="btn btn-secondary">
                <i class="fas fa-plus-circle"></i> Add Event
              </button>
              <a href="index.html" class="btn btn-outline" style="margin-left: 10px;">
                <i class="fas fa-arrow-left"></i> Back to Home
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

    // Set minimum date to today
    document.getElementById('event_date').min = new Date().toISOString().split('T')[0];
  </script>
</body>
</html>
<?php
$conn->close();
?>
<?php
// Database configuration
$host = "localhost";
$user = "root";
$pass = "";
$database_name = "prac8";

// Create connection
$conn = new mysqli($host, $user, $pass);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database
$sql = "CREATE DATABASE IF NOT EXISTS $database_name";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully<br>";
} else {
    echo "Error creating database: " . $conn->error . "<br>";
}

// Select database
$conn->select_db($database_name);

// Create events table
$sql = "CREATE TABLE IF NOT EXISTS events (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    event_name VARCHAR(255) NOT NULL,
    event_desc TEXT NOT NULL,
    event_category VARCHAR(50) DEFAULT 'other',
    event_date DATE,
    event_time TIME,
    event_location VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
    echo "Table 'events' created successfully<br>";
} else {
    echo "Error creating table: " . $conn->error . "<br>";
}

// Insert sample data
$sample_data = [
    "INSERT INTO events (event_name, event_desc, event_category, event_date, event_time, event_location) VALUES 
    ('Tech Conference 2023', 'Annual technology conference featuring latest innovations', 'technology', '2023-10-15', '09:00:00', 'San Francisco')",
    
    "INSERT INTO events (event_name, event_desc, event_category, event_date, event_time, event_location) VALUES 
    ('Business Networking', 'Connect with industry leaders and expand your network', 'business', '2023-11-05', '18:30:00', 'New York')",
    
    "INSERT INTO events (event_name, event_desc, event_category, event_date, event_time, event_location) VALUES 
    ('Charity Gala Dinner', 'Evening of fine dining and fundraising for community', 'social', '2023-12-12', '19:00:00', 'Chicago')"
];

foreach ($sample_data as $query) {
    if ($conn->query($query) === TRUE) {
        echo "Sample data inserted successfully<br>";
    } else {
        echo "Error inserting data: " . $conn->error . "<br>";
    }
}

echo "<h3>Database setup completed!</h3>";
echo "<a href='index.html'>Go to Event Portal</a>";

$conn->close();
?>
<?php
// Include header
include 'includes/header.php';

// Include database connection
require_once 'config/database.php';

// Check if user is logged in
if (!isset($_SESSION["username"])) {
    header("Location: auth/login.php");
    exit;
}

// Fetch announcements from database
$sql = "SELECT * FROM announcements ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!-- Announcements Header -->
<section class="container my-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>PSUT Announcements & News</h1>
        <span class="badge bg-primary p-2 fs-6">Welcome, <?php echo htmlspecialchars($_SESSION["username"]); ?></span>
    </div>
    <hr>
</section>

<!-- Announcements Content -->
<section class="container">
    <?php
    // Check if there are any announcements
    if ($result && $result->num_rows > 0) {
        // Output announcements
        while ($row = $result->fetch_assoc()) {
            $created_date = date('F j, Y', strtotime($row["created_at"]));
            
            echo "<div class='announcement'>";
            echo "<h3>" . htmlspecialchars($row["title"]) . "</h3>";
            echo "<span class='announcement-date'><i class='far fa-calendar-alt me-2'></i>" . $created_date . "</span>";
            echo "<p>" . nl2br(htmlspecialchars($row["content"])) . "</p>";
            
            // Display image if available
            if (!empty($row["image_path"])) {
                echo "<div class='announcement-media'>";
                echo "<img src='" . htmlspecialchars($row["image_path"]) . "' alt='Announcement Image' class='img-fluid'>";
                echo "</div>";
            }
            
            // Display video if available
            if (!empty($row["video_path"])) {
                echo "<div class='announcement-media'>";
                echo "<div class='ratio ratio-16x9'>";
                echo "<iframe src='" . htmlspecialchars($row["video_path"]) . "' allowfullscreen></iframe>";
                echo "</div>";
                echo "</div>";
            }
            
            echo "</div>";
        }
    } else {
        echo "<div class='alert alert-info'>No announcements available at this time.</div>";
    }
    ?>
    
    <!-- For demonstration: Static content with images and videos -->
    <div class="announcement">
        <h3>University Open Day</h3>
        <span class="announcement-date"><i class="far fa-calendar-alt me-2"></i>May 15, 2024</span>
        <p>PSUT is hosting an open day for prospective students and their families. Come learn about our programs, meet faculty, and tour our state-of-the-art facilities.</p>
        <div class="announcement-media">
            <img src="assets/images/open-day.jpg" alt="University Open Day" class="img-fluid">
        </div>
    </div>
    
    <div class="announcement">
        <h3>New Computer Labs Opening</h3>
        <span class="announcement-date"><i class="far fa-calendar-alt me-2"></i>May 10, 2024</span>
        <p>We're excited to announce the opening of our new computer labs equipped with the latest technology and software to enhance your learning experience.</p>
        <div class="announcement-media">
            <div class="ratio ratio-16x9">
                <iframe src="https://www.youtube.com/embed/dQw4w9WgXcQ" allowfullscreen></iframe>
            </div>
        </div>
    </div>
    
    <div class="announcement">
        <h3>Summer Courses Registration</h3>
        <span class="announcement-date"><i class="far fa-calendar-alt me-2"></i>May 5, 2024</span>
        <p>Registration for summer courses will begin on May 20th. Please consult with your academic advisor before registering for courses. The summer semester starts on June 15th and ends on August 15th.</p>
    </div>
</section>

<?php
// Include footer
include 'includes/footer.php';
?> 
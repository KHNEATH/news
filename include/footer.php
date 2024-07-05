<?php
// Start PHP session


// Include database connection


// Check if session variable is not set (indicating first visit in this session)
if (!isset($_SESSION['visited'])) {
    // Increment view count in database
    try {
        // Assuming your table name is 'viewer' and you have a field 'view_count' and an 'id' for the news item
        $newsId = 1; // Replace with your actual news item ID or get it from your page logic
        $incrementViewCountStmt = $dbh->prepare("UPDATE viewer SET view_count = view_count + 1 WHERE id = :id");
        $incrementViewCountStmt->bindParam(':id', $newsId, PDO::PARAM_INT);
        $incrementViewCountStmt->execute();

        // Set session variable to indicate visit
        $_SESSION['visited'] = true;
    } catch (PDOException $e) {
        die('Database error: ' . $e->getMessage());
    }
}

// Fetch the news item to display
try {
    $stmt = $dbh->prepare("SELECT * FROM viewer WHERE id = :id");
    $stmt->bindParam(':id', $newsId, PDO::PARAM_INT);
    $stmt->execute();
    $newsItem = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$newsItem) {
        echo 'News item not found.';
        exit();
    }
} catch (PDOException $e) {
    die('Database error: ' . $e->getMessage());
}
?>

<!-- Footer -->
<footer class="text-center text-lg-start bg-light text-muted">
    <!-- Section: Social media -->
    <section class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom">
        <!-- Left -->
        <div class="me-5 d-none d-lg-block">
        <i class='bx bx-show bx-tada me-2' ></i><span>Viewer Page:<?php echo htmlspecialchars($newsItem['view_count']); ?></span>
        </div>
        <!-- Right -->
        <div>
            <a href="https://www.facebook.com/profile.php?id=100069646752356" class="me-4 text-reset">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M22 12c0-5.52-4.48-10-10-10S2 6.48 2 12c0 4.84 3.44 8.87 8 9.8V15H8v-3h2V9.5C10 7.57 11.57 6 13.5 6H16v3h-2c-.55 0-1 .45-1 1v2h3v3h-3v6.95c5.05-.5 9-4.76 9-9.95z"></path>
                </svg>
            </a>
            <a href="https://www.instagram.com/internal_audit_unit_of_fsa/" class="me-4 text-reset">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M7.8 2h8.4C19.4 2 22 4.6 22 7.8v8.4a5.8 5.8 0 0 1-5.8 5.8H7.8C4.6 22 2 19.4 2 16.2V7.8A5.8 5.8 0 0 1 7.8 2m-.2 2A3.6 3.6 0 0 0 4 7.6v8.8C4 18.39 5.61 20 7.6 20h8.8a3.6 3.6 0 0 0 3.6-3.6V7.6C20 5.61 18.39 4 16.4 4H7.6m9.65 1.5a1.25 1.25 0 0 1 1.25 1.25A1.25 1.25 0 0 1 17.25 8A1.25 1.25 0 0 1 16 6.75a1.25 1.25 0 0 1 1.25-1.25M12 7a5 5 0 0 1 5 5a5 5 0 0 1-5 5a5 5 0 0 1-5-5a5 5 0 0 1 5-5m0 2a3 3 0 0 0-3 3a3 3 0 0 0 3 3a3 3 0 0 0 3-3a3 3 0 0 0-3-3Z"></path>
                </svg>
            </a>
            <a href="https://t.me/iauoffsa" class="me-4 text-reset">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10s10-4.48 10-10S17.52 2 12 2zm4.64 6.8c-.15 1.58-.8 5.42-1.13 7.19c-.14.75-.42 1-.68 1.03c-.58.05-1.02-.38-1.58-.75c-.88-.58-1.38-.94-2.23-1.5c-.99-.65-.35-1.01.22-1.59c.15-.15 2.71-2.48 2.76-2.69a.2.2 0 0 0-.05-.18c-.06-.05-.14-.03-.21-.02c-.09.02-1.49.95-4.22 2.79c-.4.27-.76.41-1.08.4c-.36-.01-1.04-.2-1.55-.37c-.63-.2-1.12-.31-1.08-.66c.02-.18.27-.36.74-.55c2.92-1.27 4.86-2.11 5.83-2.51c2.78-1.16 3.35-1.36 3.73-1.36c.08 0 .27.02.39.12c.1.08.13.19.14.27c-.01.06.01.24 0 .38z"></path>
                </svg>
            </a>
            <a href="https://webmail.supremecluster.com/" class="me-4 text-reset">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M19 22q-1.65 0-2.825-1.175T15 18v-4.5q0-1.05.725-1.775T17.5 11q1.05 0 1.775.725T20 13.5V18h-2v-4.5q0-.2-.15-.35T17.5 13q-.2 0-.35.15t-.15.35V18q0 .825.588 1.413T19 20q.825 0 1.413-.588T21 18v-4h2v4q0 1.65-1.175 2.825T19 22ZM3 18q-.825 0-1.413-.588T1 16V4q0-.825.588-1.413T3 2h16q.825 0 1.413.588T21 4v6h-3.5q-1.45 0-2.475 1.025T14 13.5V18H3Zm8-7l8-5V4l-8 5l-8-5v2l8 5Z"></path>
                </svg>
            </a>
        </div>
        <!-- Right -->
    </section>
    <!-- Section: Social media -->

    <!-- Section: Links  -->
    <section class="">
        <div class="container text-center text-md-start mt-5">
            <!-- Grid row -->
            <div class="row mt-3">
                <!-- Grid column -->
                <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                    <!-- Content -->
                    <h6 class="text-uppercase fw-bold mb-4">
                        <i class="fas fa-gem me-3"></i>INTERNAL AUDIT UNIT
                    </h6>
                    <p>
                        គុណភាព គុណតម្លៃ និងកាត់បន្ថយភាពអសកម្ម (Quality ,Value and ReduceUnproductive)

                    </p>
                </div>
                <!-- Grid column -->
                <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
                    <!-- Links -->
                    <h6 class="text-uppercase fw-bold mb-4">NEWS</h6>
                    <p>
                        <a href="#!" class="text-reset">OTHER NEWS</a>
                    </p>
                    <p>
                        <a href="#!" class="text-reset">Social programs</a>
                    </p>
                    <p>
                        <a href="#!" class="text-reset">Links to Other Websites</a>
                    </p>
                </div>
                <!-- Grid column -->
                <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                    <!-- Links -->
                    <h6 class="text-uppercase fw-bold mb-4">Contact</h6>
                    <p><i class="fas fa-home me-3"></i> Address: Building No. 168F (9th Floor), Street 598, Sangkat Chrang Chamres 1, Khan RusseyKeo, PhnomPenh Cambodia</p>
                    <p>
                        <i class="fas fa-envelope me-3"></i>
                        E-mail: iauoffsa.gov.kh
                    </p>
                    <!-- <p><i class="fas fa-phone me-3"></i> + 01 234 567 88</p>
                    <p><i class="fas fa-print me-3"></i> + 01 234 567 89</p> -->
                </div>
                <!-- Grid column -->
            </div>
            <!-- Grid row -->
        </div>
    </section>
    <!-- Section: Links  -->

    <!-- Copyright -->
    <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05)">
        © 2024 Copyright:
        <a class="text-reset fw-bold" href="">By the Internal Audit Unit of អ.ស.ហ.</a>
    </div>
    <!-- Copyright -->
</footer>

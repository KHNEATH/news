<?php include('../include/dbconn.php');


// Initialize variables
$newsId = 1; // Assuming this is the ID of the news item to display

// Check if session variable is not set (indicating first visit in this session)
// if (!isset($_SESSION['visited'])) {
//     try {
//         // Increment view count in database
//         $incrementViewCountStmt = $dbh->prepare("UPDATE viewer SET view_count = view_count + 1 WHERE id = :id");
//         $incrementViewCountStmt->bindParam(':id', $newsId, PDO::PARAM_INT);
//         $incrementViewCountStmt->execute();

//         // Set session variable to indicate visit
//         $_SESSION['visited'] = true;
//     } catch (PDOException $e) {
//         die('Database error: ' . $e->getMessage());
//     }
// }

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
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    $title = 'All news';
    include('../include/header.php');
    ?>
    <style>
        .card {
            border: 1px solid #ddd;
            border-radius: 8px;
            margin-bottom: 20px;
            overflow: hidden;
            background-color: #fff;
        }

        .mg-post-thumb {
            position: relative;
        }

        .mg-post-thumb img {
            width: 100%;
            height: auto;
            display: block;
        }

        .mg-post-thumb .post-form {
            position: absolute;
            bottom: 10px;
            left: 10px;
            background: rgba(0, 0, 0, 0.5);
            color: #fff;
            padding: 5px;
            border-radius: 3px;
        }

        .mg-sec-top-post {
            padding: 20px;
        }

        .mg-blog-category a {
            text-decoration: none;
            color: #333;
            font-size: 14px;
        }

        .mg-blog-category a:hover {
            color: #007bff;
        }

        .entry-title a {
            text-decoration: none;
            color: #333;
        }

        .entry-title a:hover {
            color: #007bff;
        }

        .mg-blog-meta {
            margin-bottom: 10px;
            font-size: 12px;
        }

        .mg-content {
            font-size: 14px;
            line-height: 1.6;
        }

        @media (max-width: 767px) {
            .card-body {
                flex-direction: column;
            }

            .col-md-6 {
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <?php include('../include/navbar.php'); ?>
    <div id="content" class="container-fluid home d-flex justify-content-center align-items-center">
        <!--row-->
        <div class="row justify-content-center align-items-center">
            <!--col-md-8-->
            <div class="col-md-8">
                <div id="post-5738" class="post-5738 post type-post status-publish format-standard has-post-thumbnail hentry category-news">
                    <!-- mg-posts-sec mg-posts-modul-6 -->

                    <div class="mg-posts-sec mg-posts-modul-6">

                        <!-- mg-posts-sec-inner -->
                        <div class="mg-posts-sec-inner">

                            <article class="card mg-posts-sec-post mt-3">
                                <div class="card-body d-md-flex align-items-center">
                                    <div class="col-md-6">
                                        <div class="mg-post-thumb back-img md">
                                            <img src="../images/IMG_24_6_2024.jpg" alt="News Image">
                                            <span class="post-form"><i class="fas fa-camera"></i></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mg-sec-top-post py-3">
                                            <div class="mg-blog-category">
                                                <a class="newsup-categories category-color-1" href="https://iauoffsa.gov.kh/category/news/" alt="View all posts in News">News</a>
                                            </div>
                                            <h6 class="entry-title title">
                                                <a href="https://iauoffsa.gov.kh/iau_24-june-24/">លោក នួន សំរតនា ប្រធាននាយកដ្ឋានកិច្ចការទូទៅ បានអញ្ជើញចូលរួមប្រគល់ថវិកាដែលបានមកពីថ្នាក់ដឹកនាំ និងមន្រ្តីរបស់ អ.ស.ហ. ជូនមូលនិធិគន្ធបុប្ផាកម្ពុជា</a>
                                            </h6>
                                            <div class="mg-blog-meta">
                                                <span class="mg-blog-date"><i class="fas fa-clock"></i> <a href="https://iauoffsa.gov.kh/2024/06/">Jun 24, 2024</a></span>
                                            </div>
                                            <div class="mg-content">
                                                <p>នាព្រឹកថ្ងៃចន្ទ ៣រោច ខែជេស្ឋ ឆ្នាំរោង ឆស័ក ព.ស. ២៥៦៨ ត្រូវនឹងថ្ងៃទី២៤ ខែមិថុនា ឆ្នាំ២០២៤ ដោយមានការអនុញ្ញាតដ៏ខ្ពង់ខ្ពស់ពី ឯកឧត្តម ឈុន សម្បត្តិ ប្រធានអង្គភាពសវនកម្មផ្ទៃក្នុងនៃ អ.ស.ហ. លោក នួន សំរតនា ប្រធាននាយកដ្ឋានកិច្ចការទូទៅ បានអញ្ជើញចូលរួមប្រគល់ថវិកាដែលបានមកពីថ្នាក់ដឹកនាំ និងមន្រ្តីរបស់ អ.ស.ហ. ជូនមូលនិធិគន្ធបុប្ផាកម្ពុជា...</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </article>

                            <article class="card mg-posts-sec-post mt-3">
                                <div class="card-body d-md-flex align-items-center">
                                    <div class="col-md-6">
                                        <div class="mg-post-thumb back-img md">
                                            <img src="../images/IMG_19_6_24-1024x683.jpg" alt="News Image">
                                            <span class="post-form"><i class="fas fa-camera"></i></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mg-sec-top-post py-3 col">
                                            <div class="mg-blog-category">
                                                <a class="newsup-categories category-color-1" href="https://iauoffsa.gov.kh/category/news/" alt="View all posts in News">News</a>
                                            </div>

                                            <h6 class="entry-title title"><a href="https://iauoffsa.gov.kh/iau-22-june-24/">ឯកឧត្តម ឈុន សម្បត្តិ ប្រធានអង្គភាពសវនកម្មផ្ទៃក្នុងនៃ អ.ស.ហ. អមដំណើរដោយសហការីបានឆ្លៀតពេលចូលថ្វាយបង្គំសម្តេចព្រះព្រហ្មរតនមុនី ពិន សែម សិរីមន្តរាមមានមុខសាសន៍ល្បាយក្នុងប្រជាជនកម្ពុជា ២២មិថុនា ២០២៤។</a></h6>

                                            <div class="mg-blog-meta">
                                                <span class="mg-blog-date">
                                                    <i class="fas fa-clock"></i>
                                                    <a href="https://iauoffsa.gov.kh/2024/06/">June 22, 2024</a>
                                                </span>
                                            </div>

                                            <div class="mg-content">
                                                <p>អមដំណើរដោយសហការីបានឆ្លៀតពេលចូលថ្វាយបង្គំសម្តេចព្រះព្រហ្មរតនមុនីពិន សែម សិរីមន្តរាមមានមុខសាសន៍ល្បាយក្នុងប្រជាជនកម្ពុជា។២២មិថុនា ២០២៤។។។</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <?php include('../include/footer.php') ?>
</body>

</html>
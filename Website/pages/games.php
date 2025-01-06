<?php 
include "../db_conn.php";
include "../igdb/popular_week.php"; 
include "../igdb/access_token.php";
session_start();
$isLoggedIn = isset($_SESSION['username']);

// Output the page content
echo "<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <link rel='stylesheet' type='text/css' href='../styles/games.css?v=1'> 
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css' rel='stylesheet' 
    integrity='sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH' crossorigin='anonymous'>
    <link 
        href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css' 
        rel='stylesheet'>
    <title>Gamerboxd • Social game discovery</title>
</head>
<body>"; 
// Logo Navbar and Search
echo "<nav class='navbar navbar-expand-lg'>
        <div class='container'> 
            <img src='../images/logo.png' alt='Logo' width='60' height='24' class='d-inline-block logo_pic'>  
            <a class='navbar-brand logo' href='../index.php'>Gamerboxd</a>
            <button class='navbar-toggler' type='button' data-bs-toggle='collapse' data-bs-target='#navbarNav' 
                aria-controls='navbarNav' aria-expanded='false' aria-label='Toggle navigation'>
                <span class='navbar-toggler-icon'></span>
            </button> 
            <div class='collapse navbar-collapse justify-content-center collapse' id='navbarNav'>
                <ul class='navbar-nav'>";
            // Condition if Logged In
            if (!$isLoggedIn) {
                echo "<li class='nav-item'>
                        <a class='nav-link' href='#' data-bs-toggle='modal' data-bs-target='#signinModal'>SIGN IN</a>
                    </li> 
                    <li class='nav-item'>
                        <a class='nav-link' href='#' data-bs-toggle='modal' data-bs-target='#createModal'>CREATE ACCOUNT</a>
                    </li>";
            }
                    echo "<li class='nav-item'>
                        <a class='nav-link' href='/pages/games.php'>GAMES</a>
                    </li> 
                    <li class='nav-item'>
                        <a class='nav-link' href='/pages/blappy.php'>LISTS</a>
                    </li> 
                    <li class='nav-item'>
                        <a class='nav-link' href='/pages/aboutus.php'>MEMBERS</a>
                    </li>
                    <li class='nav-item'>
                        <a class='nav-link' href='/pages/contactus.php'>JOURNAL</a>
                    </li>";
            if ($isLoggedIn){
                echo "<li class='nav-item'>
                        <a class='nav-link' href='../posts/post_logout.php'>LOGOUT</a>
                    </li>";
            }    
                    echo "</ul> 
                <li class='search'>
                    <input type='text' name='q' id='search-q' class='form-control border-0' data-lpignore='true' 
                        inputmode='search'>
                    <button type='button'>
                        <i class='fas fa-search'></i>
                    </button>
                </li> 
            </div>
        </div>
    </nav>";

// Display the page content
// Browse By Options
echo '<div class="container text-center browseby">
        <!-- Year -->
        <div class="btn-group">
        <button class="btn dropdown-toggle browse_button" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            YEAR
        </button>
        <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">All</a></li>
            <li><a class="dropdown-item" href="#">Upcoming</a></li>
            <li><a class="dropdown-item" href="#">2024</a></li>
            <li><a class="dropdown-item" href="#">2023</a></li>
            <li><a class="dropdown-item" href="#">2022</a></li>
            <li><a class="dropdown-item" href="#">2021</a></li>
            <li><a class="dropdown-item" href="#">2020</a></li>
            <li><a class="dropdown-item" href="#">2019</a></li>
            <li><a class="dropdown-item" href="#">2018</a></li>
            <li><a class="dropdown-item" href="#">2017</a></li>
            <li><a class="dropdown-item" href="#">2016</a></li>
            <li><a class="dropdown-item" href="#">2015</a></li>
            <li><a class="dropdown-item" href="#">2014</a></li>
            <li><a class="dropdown-item" href="#">2013</a></li>
            <li><a class="dropdown-item" href="#">2012</a></li>
            <li><a class="dropdown-item" href="#">2011</a></li>
            <li><a class="dropdown-item" href="#">2010</a></li> 
            <li><a class="dropdown-item" href="#">Older</a></li>
        </ul>
        </div>
        <!-- Rating -->
        <div class="btn-group">
        <button class="btn dropdown-toggle browse_button" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            RATING
        </button>
        <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Highest First</a></li>
            <li><a class="dropdown-item" href="#">Lowest First</a></li>
            <li><a class="dropdown-item" href="#">Top 250 Games</a></li> 
        </ul>
        </div>
        <!-- Popular -->
        <div class="btn-group">
        <button class="btn dropdown-toggle browse_button" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            POPOULAR
        </button>
        <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">All Time</a></li>
            <li><a class="dropdown-item" href="#">This Year</a></li>
            <li><a class="dropdown-item" href="#">This Month</a></li>
            <li><a class="dropdown-item" href="#">This Week</a></li>
        </ul>
        </div>
        <!-- Genre -->
        <div class="btn-group">
        <button class="btn dropdown-toggle browse_button" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            GENRE
        </button>
        <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Adventure</a></li>
            <li><a class="dropdown-item" href="#">RPG</a></li>
            <li><a class="dropdown-item" href="#">Strategy</a></li>
            <li><a class="dropdown-item" href="#">FPS</a></li>
            <li><a class="dropdown-item" href="#">Simulation</a></li>
            <li><a class="dropdown-item" href="#">Puzzle</a></li>
            <li><a class="dropdown-item" href="#">Sports</a></li>
            <li><a class="dropdown-item" href="#">Racing</a></li>
            <li><a class="dropdown-item" href="#">Horror</a></li>
            <li><a class="dropdown-item" href="#">Casual</a></li> 
        </ul>
        </div>
        <!-- Service -->
        <div class="btn-group">
        <button class="btn dropdown-toggle browse_button" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            SERVICE
        </button>
        <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Xbox</a></li>
            <li><a class="dropdown-item" href="#">PC</a></li>
            <li><a class="dropdown-item" href="#">Nintendo</a></li>
            <li><a class="dropdown-item" href="#">PlayStation</a></li> 
            <li><a class="dropdown-item" href="#">Other</a></li> 
        </ul>
        </div>
        <!-- OTHER -->
        <div class="btn-group">
        <button class="btn dropdown-toggle browse_button" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            OTHER
        </button>
        <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Most Anticipated</a></li>
            <li><a class="dropdown-item" href="#">Coming Soon</a></li>
            <li><a class="dropdown-item" href="#">(A-Z)</a></li>
            <li><a class="dropdown-item" href="#">Collections</a></li>
        </ul>
        </div>
    </div>';


// Get the access token from IGDB API
$access_token = getAccessToken();

// Fetch popular games from the IGDB API
$games = getPopularGames($access_token);   
// Fetch Game Data
$game_details = getGameData($access_token, $games);   
// BIG Container for Page Contents Margins for Ads
echo "<div class='container-fluid content'>";

// Popular Games This Week
echo "<div class='popular'>BEST OF ALL TIME</div>
    <hr class='divider'>";

// Display the games as a carousel with 4 different items at a time
echo "<div id='carouselExampleFade' class='carousel slide' data-bs-ride='carousel'>
  <div class='carousel-inner'>";

// Loop through the games and display sets of 4 images at a time
$gamesCount = count($game_details);
for ($i = 0; $i < $gamesCount; $i += 4) {
    // Get the cover URLs for the next 4 games
    $coverUrl1 = isset($game_details[$i]['cover']['url']) ? "https:" . $game_details[$i]['cover']['url'] : '../images/default.png';
    $coverUrl2 = isset($game_details[$i + 1]['cover']['url']) ? "https:" . $game_details[$i + 1]['cover']['url'] : '../images/default.png';
    $coverUrl3 = isset($game_details[$i + 2]['cover']['url']) ? "https:" . $game_details[$i + 2]['cover']['url'] : '../images/default.png';
    $coverUrl4 = isset($game_details[$i + 3]['cover']['url']) ? "https:" . $game_details[$i + 3]['cover']['url'] : '../images/default.png';

    // Set the 'active' class only for the first set of 4 images
    $activeClass = ($i === 0) ? 'active' : '';

    // Display 4 images in each carousel item
    echo "<div class='carousel-item {$activeClass}'>
            <div class='d-flex justify-content-between'>
                <img src='{$coverUrl1}' class='d-block w-25 carousel_img' alt='...'>
                <img src='{$coverUrl2}' class='d-block w-25 carousel_img' alt='...'>
                <img src='{$coverUrl3}' class='d-block w-25 carousel_img' alt='...'>
                <img src='{$coverUrl4}' class='d-block w-25 carousel_img' alt='...'>
            </div>
          </div>";
}

echo "</div>
  <button class='carousel-control-prev' type='button' data-bs-target='#carouselExampleFade' data-bs-slide='prev'>
    <span class='carousel-control-prev-icon' aria-hidden='true'></span>
    <span class='visually-hidden'>Previous</span>
  </button>
  <button class='carousel-control-next' type='button' data-bs-target='#carouselExampleFade' data-bs-slide='next'>
    <span class='carousel-control-next-icon' aria-hidden='true'></span>
    <span class='visually-hidden'>Next</span>
  </button>
</div>";


// Sign In Modal

// Forces Show Modal if Error
if (isset($_GET['error'])) {
    echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            const signinModal = new bootstrap.Modal(document.getElementById('signinModal'));
            signinModal.show();
        });
    </script>";
}
echo "<div class='modal fade' id='signinModal' tabindex='-1' aria-labelledby='signinModalLabel' aria-hidden='true'>
        <div class='modal-dialog'>
            <div class='modal-content'>
                <div class='modal-header'>
                    <h5 class='modal-title' id='signinModalLabel'>Sign In</h5>
                    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                </div>
                <div class='modal-body'>";
                if (isset($_GET['error'])) {
                    echo "<div class='alert alert-danger' role='alert'>" . htmlspecialchars($_GET['error']) . "</div>";
                }
                    echo "<form action='../posts/post_sign.php' method='POST'>
                        <div class='mb-3'>
                            <label for='username' class='form-label'>Username</label>
                            <input type='text' class='form-control' id='username' name='username' 
                                pattern='[A-Za-z0-9_]{3,15}' required>
                        </div>
                        <div class='mb-3'>
                            <label for='password' class='form-label'>Password</label>
                            <input type='password' class='form-control' id='password' name='password' required>
                        </div>
                        <button type='submit' class='btn sign_button'>SIGN IN</button>
                    </form>
                </div>
            </div>
        </div>
    </div>";

// Create Account Modal
echo "<div class='modal fade' id='createModal' tabindex='-1' aria-labelledby='createModalLabel' aria-hidden='true'>
        <div class='modal-dialog'>
            <div class='modal-content'>
                <div class='modal-header'>
                    <h5 class='modal-title' id='createModalLabel'>Create Account</h5>
                    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                </div>
                <div class='modal-body'>
                    <form action='../posts/post_create.php' method='POST'>
                        <div class='mb-3'>
                            <label for='email' class='form-label'>Email Address</label>
                            <input type='email' class='form-control' id='email' name='email' required>
                        </div>
                        <div class='mb-3'>
                            <label for='username' class='form-label'>Username</label>
                            <input type='text' class='form-control' id='username' name='username' 
                            pattern='[A-Za-z0-9_]{3,15}' required>
                        </div>
                        <div class='mb-3'>
                            <label for='password' class='form-label'>Password</label>
                            <input type='password' class='form-control' id='password' name='password' required>
                        </div>
                        <button type='submit' class='btn sign_button'>SIGN UP</button>
                    </form>
                </div>
            </div>
        </div>
    </div>";
// End Page
echo "</div>
    <script src='https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js'></script>
    </body></html>";

?>
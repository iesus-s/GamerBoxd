<?php 
include "db_conn.php"; 
session_start();
$isLoggedIn = isset($_SESSION['username']);

// Output the page content
echo "<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <link rel='stylesheet' type='text/css' href='../styles/main.css?v=1'> 
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
            <img src='./images/logo.png' alt='Logo' width='60' height='24' class='d-inline-block logo_pic'>  
            <a class='navbar-brand logo' href='index.php'>Gamerboxd</a>
            <button class='navbar-toggler' type='button' data-bs-toggle='collapse' data-bs-target='#navbarNav' 
                aria-controls='navbarNav' aria-expanded='false' aria-label='Toggle navigation'>
                <span class='navbar-toggler-icon'></span>
            </button> 
            <div class='collapse navbar-collapse justify-content-center collapse' id='navbarNav'>
                <ul class='navbar-nav'> 
                    <li class='nav-item'>
                        <a class='nav-link' href='#' data-bs-toggle='modal' data-bs-target='#signinModal'>SIGN IN</a>
                    </li> 
                    <li class='nav-item'>
                        <a class='nav-link' href='#' data-bs-toggle='modal' data-bs-target='#createModal'>CREATE ACCOUNT</a>
                    </li> 
                    <li class='nav-item'>
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
                    </li> 
                </ul> 
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

// Welcome Message
echo "<div class='container'> 
    <h1 class='text-center'>Welcome to Gamerboxd</h1>
    <p class='text-center'>Discover new games and connect with other gamers</p>
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
                    echo "<form action='/posts/post_sign.php' method='POST'>
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
                    <form action='/posts/post_create.php' method='POST'>
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
echo "<script src='https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js'></script>
    </body></html>";
?>

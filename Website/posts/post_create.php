<?php
session_start();
include "../db_conn.php"; 

// function to sanitize user input
function validate($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// ensure the request is POST and data is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $uname = validate($_POST['username']);
    $email = validate($_POST['email']);
    $pass = validate($_POST['password']);  

    // hash the password before storing it
    $hashed_pass = password_hash($pass, PASSWORD_DEFAULT);

    // Prepare the SQL query
    $sql = "INSERT INTO Users (username, email, password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("sss", $uname, $email, $hashed_pass);

        // Execute the query and check for success
        if ($stmt->execute()) { 
            exit();
        } 
        else {
            echo "error occurred: " . $stmt->error;
            exit();
        }
        $stmt->close();
    }  
}  
?>

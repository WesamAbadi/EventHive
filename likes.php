<?php
// Include the database configuration file
require_once 'config.php';

// Initialize the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: login.php');
    exit;
}

// Check if event ID is provided
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['event_id'])) {
    $event_id = $_POST['event_id'];
    $user_id = $_SESSION['id'];

    // Check if the user has already liked the event
    $sql = "SELECT id FROM likes WHERE user_id = '$user_id' AND event_id = '$event_id'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) === 0) {
        // Insert a new like record
        $sql = "INSERT INTO likes (user_id, event_id) VALUES ('$user_id', '$event_id')";
        mysqli_query($conn, $sql);

        // Update the event's like count
        $sql = "UPDATE events SET likes = likes + 1 WHERE id = '$event_id'";
        mysqli_query($conn, $sql);
    }
}

// Redirect back to the home page
header('Location: index.php');
exit;

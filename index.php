<?php


// Include the database configuration file
require_once 'config.php';

// Initialize the session
session_start();

// Check if the user is logged in, otherwise redirect to the login page
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: login.php');
    exit;
}

// Process the event creation form
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['title']) && isset($_POST['description'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $userId = $_SESSION['id'];

    // Insert the event into the database
    $sql = "INSERT INTO events (title, description, user_id) VALUES ('$title', '$description', '$userId')";
    if (mysqli_query($conn, $sql)) {
        header('Location: index.php');
        exit;
    } else {
        echo 'Error: ' . $sql . '<br>' . mysqli_error($conn);
    }
}

// Retrieve all events from the database
$sql = "SELECT events.id, events.title, events.description, events.likes, users.username
        FROM events
        INNER JOIN users ON events.user_id = users.id";
$result = mysqli_query($conn, $sql);
$events = mysqli_fetch_all($result, MYSQLI_ASSOC);

mysqli_free_result($result);
mysqli_close($conn);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Event Hive ⬢⬡⬢</title>
    <link rel="stylesheet" type="text/css" href="/eventhive/src/css/style.css">
    <link rel="stylesheet" type="text/css" href="/eventhive/src/css/home.css">

</head>
<body>
<div class="container">
    <h1>Event Hive ⬢⬡⬢ 🐝</h1>
    <h1>Welcome, <?php echo $_SESSION['username']; ?>!</h1>
    <h2>Create Event ✨</h2>
    <form action="" method="POST">
        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" name="title" id="title" required>
        </div>
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea name="description" id="description" required></textarea>
        </div>
        <div class="button-container">
            <button type="submit">Create Event ➕</button>
        </div>
    </form>

    <h2>Events</h2>
    <div class="events">
    <?php foreach ($events as $event) : ?>
        <div class="event">
            <div class="event-title"><?php echo $event['title']; ?></div>
            <div class="event-description"><?php echo $event['description']; ?></div>
            <div class="event-likes">Likes: <?php echo $event['likes']; ?></div>
            <div>Posted by: <?php echo $event['username']; ?></div>
            <form action="likes.php" method="POST">
                <input type="hidden" name="event_id" value="<?php echo $event['id']; ?>">
                <button type="submit" class="like-button">Like 💖</button>
            </form>
        </div>
    <?php endforeach; ?>
    </div>

    <a href="logout.php" class="logout-link">Logout</a>
</div>
</body>
</html>


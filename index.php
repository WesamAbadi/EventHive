<?php
include('includes/database.php');
include('includes/config.php');
include('includes/functions.php');

include('includes/header.php');
if (isset($_SESSION['id'])) {
    echo "logged in session"; 
}
else{
    echo "GO LOGIN!"; 
}

include('includes/footer.php');
?>
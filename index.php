<?php
include('includes/database.php');
include('includes/config.php');
include('includes/functions.php');

include('includes/header.php');
if (isset($_SESSION['id'])) {
    echo "logged in session";

    


} else {
    echo "GO LOGIN!";
?>
<br>
    <button type="button" class="btn btn-link px-3 me-2" onclick="location.href='login.php'">
        Login
    </button>
<?php
}

include('includes/footer.php');
?>
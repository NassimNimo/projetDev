<?php
session_start(); // Start the session
// Check if session variables exist
if (isset($_SESSION['id'])) {
    echo "Session variables still exist.";
} else {
    echo "Session has been successfully destroyed.";
}
session_destroy();

?>
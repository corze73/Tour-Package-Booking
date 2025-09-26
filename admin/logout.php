<?php
require_once '../includes/functions.php';

// Destroy admin session
unset($_SESSION['admin_id']);
unset($_SESSION['admin_username']);
unset($_SESSION['admin_role']);

// Destroy the entire session
session_destroy();

// Redirect to login page
header('Location: login.php');
exit;
?>
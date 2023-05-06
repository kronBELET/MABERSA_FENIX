<?php
session_start();
// Database credentials
$db_host = "localhost";
$db_name = "mabersa";
$db_user = "root";
$db_pass = "";

// Create connection
$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

// Check connection
if (!$conn) {
    die("La conexión falló: " . mysqli_connect_error());
}
// function to check if user is logged in as a student
function isStudentLoggedIn()
{
    if (isset($_SESSION['role']) && $_SESSION['role'] == 'student') {
        return true;
    }
    return false;
}

// function to check if user is logged in as a teacher
function isTeacherLoggedIn()
{
    if (isset($_SESSION['role']) && $_SESSION['role'] == 'teacher') {
        return true;
    }
    return false;
}

// function to check if user is not logged in
function isNotLoggedIn()
{
    if (!isset($_SESSION['user_id'])) {
        return true;
    }
    return false;
}

?>
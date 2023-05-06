<?php
session_start();
// Credenciales de la base de datos
$db_host = "localhost";
$db_name = "mabersa";
$db_user = "root";
$db_pass = "";

// Crear conexión
$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

// Verifica la conexión
if (!$conn) {
    die("La conexión falló: " . mysqli_connect_error());
}
// función para verificar si el usuario está conectado como estudiante
function isStudentLoggedIn()
{
    if (isset($_SESSION['role']) && $_SESSION['role'] == 'student') {
        return true;
    }
    return false;
}

// función para comprobar si el usuario está conectado como profesor
function isTeacherLoggedIn()
{
    if (isset($_SESSION['role']) && $_SESSION['role'] == 'teacher') {
        return true;
    }
    return false;
}

// función para comprobar si el usuario no ha iniciado sesión
function isNotLoggedIn()
{
    if (!isset($_SESSION['user_id'])) {
        return true;
    }
    return false;
}

?>
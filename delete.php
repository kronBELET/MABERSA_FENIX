<?php



// Conectar a la base de datos
require_once('db_conn.php');


// CURSOS
if (isset($_GET['c_id'])) {
  // Obtiene el ID del registro a eliminar
  $id = $_GET['c_id'];

  // Crea la consulta SQL para eliminar el registro
  $consulta = "DELETE FROM courses WHERE c_id = '$id'";

  // Ejecuta la consulta
  mysqli_query($conn, $consulta);

  // Redirige a la página principal
  if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {
    header('location: admin_dashboard.php');
}
elseif (isset($_SESSION['role']) && $_SESSION['role'] == 'teacher') {
    header('location: teacher_dashboard.php');
}
}

// USUARIOS
if (isset($_GET['u_id'])) {
  // Obtiene el ID del registro a eliminar
  $id = $_GET['u_id'];

  // Crea la consulta SQL para eliminar el registro
  $consulta = "DELETE FROM users WHERE u_id = '$id'";

  // Ejecuta la consulta
  mysqli_query($conn, $consulta);

  // Redirige a la página principal
  header('Location: user.php');
}
?>

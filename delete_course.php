<?php



// Conectar a la base de datos
require_once('db_conn.php');


// Verifica si se ha pasado el parámetro "id" en la URL
if (isset($_GET['c_id'])) {
  // Obtiene el ID del registro a eliminar
  $id = $_GET['c_id'];

  // Crea la consulta SQL para eliminar el registro
  $consulta = "DELETE FROM courses WHERE c_id = '$id'";

  // Ejecuta la consulta
  mysqli_query($conn, $consulta);

  // Redirige a la página principal
  header('Location: admin_dashboard.php');
}
?>

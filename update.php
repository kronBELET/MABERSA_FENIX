<?php
// Incluir el archivo de conexión a la base de datos
require_once 'db_conn.php';

if (isset($_POST['c_id'])) {
    $c_id = $_POST['c_id'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descricion'];

    // Realizar la consulta para actualizar los datos del registro
    $query = "UPDATE courses SET course_name = '$nombre', course_description = '$descripcion' WHERE c_id = $c_id";
    $result = mysqli_query($conn, $query);

    if ($result) {
        header('location: admin_dashboard.php');
    } else {
        echo "Hubo un error al actualizar los datos: " . mysqli_error($conn);
    }
}

// Cerrar la conexión a la base de datos
mysqli_close($conn);
?>
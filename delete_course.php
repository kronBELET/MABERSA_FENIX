<?php
// Obtener el identificador del curso desde el parámetro 'id'


// Conectar a la base de datos
require_once('db_conn.php');
$c_id=$_get['c_id'];
    mysqli_query($conexion,"DELETE FROM courses where c_id='$c_id'")or die("error al eliminar");

    mysqli_close($conexion);

    header("location:admin_dashboard");
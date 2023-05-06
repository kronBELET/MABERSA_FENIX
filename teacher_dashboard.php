<?php
// Incluir el archivo de conexión a la base de datos
require_once('db_conn.php');
if (!isTeacherLoggedIn()) {
    header('location:login.php?login_please');
    die();
}
$t_id = $_SESSION['u_id'];
// Preparar la consulta SQL
$sql = "SELECT * FROM courses WHERE t_id = '$t_id'";

// Ejecutar la consulta y almacenar el conjunto de resultados
$result = mysqli_query($conn, $sql);

// Comprobar si se han encontrado resultados
if (mysqli_num_rows($result) > 0) {
    // Iniciar tabla HTML y encabezados de tabla
    $show = '<table>';
    $show .= '<thead><tr><th>ID</th><th>Nombre de curso</th><th>estudiantes inscritos</th><th>Fecha</th><th>Action</th></tr></thead>';
    
   // Recorrer el conjunto de resultados y mostrar cada fila como una fila de tabla
    while($row = mysqli_fetch_assoc($result)) {

        
        $c_id = $row['c_id'];
        $sql1 = "SELECT COUNT(*) AS `total_students` FROM `enrollment` WHERE `c_id` = '$c_id'";
        $result1 = mysqli_query($conn,$sql1);
        $row1 = mysqli_fetch_assoc($result1);

        $show .= '<tr>';
        $show .= '<td>' . $row["c_id"] . '</td>';
        $show .= '<td>' . $row["course_name"] . '</td>';
        $show .= '<td>' . $row1["total_students"] . '</td>';
        $show .= '<td>' . $row["timestamp"] . '</td>';
        $show .= '<td><a href="teacher_course.php?c_id=' . $row["c_id"] . '">Ver detalles</a></td>';
        $show .= '</tr>';
    }
    
    // Cierra la etiqueta de la tabla
    $show .= '</table>';
} else {
    // No se han encontrado resultados
    $show = "<div class='error'>No se encontraron cursos.</div>";
}
?>
<!DOCTYPE html>
<html>

    <head>
        <meta charset="UTF-8">
        <title>Mabersa</title>
        <link rel="stylesheet" type="text/css" href="./assets/css/style.css">
    </head>

    <body>
        
        <?php include('header.php'); ?>
        <main>
            <h1 class="page-title">Cursos</h1>
            <div class="card-container">
                <?php echo $show; ?>
            </div>
        </main>
        <?php include('footer.php'); ?>
    </body>

</html>
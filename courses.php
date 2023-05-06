<?php
// Incluir el archivo de conexión a la base de datos
require_once('db_conn.php');

$show = '';
// Preparar la consulta SQL
$sql = "SELECT * FROM courses ORDER BY `course_name`";

// Ejecutar la consulta y almacenar el conjunto de resultados
$result = mysqli_query($conn, $sql);

// Comprobar si se han encontrado resultados
if (mysqli_num_rows($result) > 0) {
    // Iniciar tabla HTML y encabezados de tabla
   
    // Recorrer el conjunto de resultados y mostrar cada fila como una fila de tabla
    while($row = mysqli_fetch_assoc($result)) {
        $c_id = $row['c_id'];

        $show .= '<div class="card">
        <div class="card-content">
            <h2>'.$row['course_name'].'</h2>
            <p>'.substr($row['course_description'], 0, 100) . "...".'</p>
            <a href="course.php?c_id='.$c_id.'" class="button">Learn More</a>
        </div>
    </div>';
    }
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
<?php
// Incluir el archivo de conexión a la base de datos
require_once('db_conn.php');

$show = '';
// Preparar la consulta SQL
$sql = "SELECT * FROM courses WHERE approved = 'not' ORDER BY `c_id`";

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
            <a href="course.php?c_id='.$c_id.'" class="button">Aprende más</a>
            <form method="post">
            <input type="hidden" name="c_id" value="'.$c_id.'">
            <input type="submit" name="aprobar" value="Aprobar">
            <input type="submit" name="rechazar" value="Rechazar">
            </form>
        </div>
    </div>';
    }
    
} else {
   // No se han encontrado resultados
    $show = "<div class='error'>No se encontraron cursos.</div>";
}

// Procesar el envío del formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $c_id = $_POST['c_id'];
    if (isset($_POST['aprobar'])) {
        // Actualizar la columna "approved" en la tabla de cursos a "yes"
        $sql = "UPDATE courses SET approved='yes' WHERE c_id='$c_id'";
        mysqli_query($conn, $sql);
    } else if (isset($_POST['rechazar'])) {
        // Eliminar la fila correspondiente a este curso de la tabla de cursos
        $sql = "DELETE FROM courses WHERE c_id='$c_id'";
        mysqli_query($conn, $sql);
    }
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
            <h1 class="page-title">Cursos Recientes</h1>
            <div class="card-container">
                <?php echo $show; ?>    
            </div>
        </main>
        <?php include('footer.php'); ?>
    </body>

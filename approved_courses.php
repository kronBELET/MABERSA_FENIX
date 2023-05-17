<?php
// Incluir el archivo de conexión a la base de datos
require_once('db_conn.php');

$show = '';

// Verificar si se ha enviado el formulario de aprobación o rechazo
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verificar si se ha enviado el formulario de aprobación
    if (isset($_POST['aprobar'])) {
        // Obtener el ID del curso a aprobar
        $c_id = $_POST['c_id'];

        // Actualizar el estado del curso como aprobado en la base de datos
        $query = "UPDATE courses SET approved = 1 WHERE c_id = $c_id";
        mysqli_query($conn, $query);

        // Mostrar mensaje de éxito
        $show .= '<div class="success">El curso ha sido aprobado.</div>';
    }

    // Verificar si se ha enviado el formulario de rechazo
    if (isset($_POST['rechazar'])) {
        // Obtener el ID del curso a rechazar
        $c_id = $_POST['c_id'];

        // Actualizar el estado del curso como rechazado en la base de datos
        $query = "UPDATE courses SET approved = 0 WHERE c_id = $c_id";
        mysqli_query($conn, $query);

        // Mostrar mensaje de éxito
        $show .= '<div class="success">El curso ha sido rechazado.</div>';
    }
}

// Preparar la consulta SQL
$sql = "SELECT * FROM courses where approved = '0' ORDER BY `c_id`";

// Ejecutar la consulta y almacenar el conjunto de resultados
$result = mysqli_query($conn, $sql);

// Comprobar si se han encontrado resultados
if (mysqli_num_rows($result) > 0) {
    // Recorrer el conjunto de resultados y mostrar cada fila como una fila de tabla
    while ($row = mysqli_fetch_assoc($result)) {
        $c_id = $row['c_id'];

        $show .= '<div class="card">
            <div class="card-content">
                <h2>' . $row['course_name'] . '</h2>
                <p>' . substr($row['course_description'], 0, 100) . "..." . '</p>
                <a href="course.php?c_id=' . $c_id . '" class="button">Aprende más</a>
                <form method="post">
                    <input type="hidden" name="c_id" value="' . $c_id . '">
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
</html>

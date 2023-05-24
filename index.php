<?php
// Incluir el archivo de conexión a la base de datos
require_once('db_conn.php');

$show = '';
// Preparar la consulta SQL
$sql = "SELECT * FROM courses WHERE approved = 1 ORDER BY `c_id` LIMIT 6";

// Ejecutar la consulta y almacenar el conjunto de resultados
$result = mysqli_query($conn, $sql);

// Comprobar si se han encontrado resultados
if (mysqli_num_rows($result) > 0) {
    // Iniciar tabla HTML y encabezados de tabla

    // Recorrer el conjunto de resultados y mostrar cada fila como una fila de tabla
    while ($row = mysqli_fetch_assoc($result)) {
        $c_id = $row['c_id'];
        $imageUrl = $row['image'];

        $show .= '<div class="card">
        <div class="card-content">
            <h2>' . $row['course_name'] . '</h2>
            <img class="card-image" src="' . $imageUrl . '" alt="' . $row['course_name'] . '">
            <p>' . substr($row['course_description'], 0, 100) . "..." . '</p>
            <a href="course.php?c_id=' . $c_id . '" class="button">Aprende más</a>
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
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="./assets/css/style.css">
    <style>
        .card-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
    </style>
</head>

<body>
    <?php include('header.php'); ?>
    <div class="main-banner" id="top">
        <main>
            
            <section>
                <h2 class="page-title">Bienvenido a Mabersa</h2>
                <p class="paragraph">Descubre nuestra amplia selección de cursos en línea y permítenos ayudarte en tu camino al conocimiento. Contamos con cursos de todo tipo, algunos son:</p>
                <ul class="paragraph" style="list-style: none;">
                    <li>Curso de programación en PHP</li>
                    <li>Curso de diseño gráfico</li>
                    <li>Curso de marketing digital</li>
                    <li>Curso de inglés avanzado</li>
                </ul>
            </section>
        </main>

        <main>
            <h1 class="page-title">Cursos Recientes</h1>
            <div class="card-container">
                <?php echo $show; ?>
            </div>
        </main>

        <?php include('footer.php'); ?>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>



<?php
// Incluir el archivo de conexión a la base de datos
require_once('db_conn.php');

$show = '';
$cursosPorPagina = 10;

// Obtener el número total de cursos
$sqlTotalCursos = "SELECT COUNT(*) AS total FROM courses";
$resultTotalCursos = mysqli_query($conn, $sqlTotalCursos);
$rowTotalCursos = mysqli_fetch_assoc($resultTotalCursos);
$totalCursos = $rowTotalCursos['total'];

// Calcular el número total de páginas disponibles
$totalPaginas = ceil($totalCursos / $cursosPorPagina);

// Obtener el número de página actual
$paginaActual = isset($_GET['page']) ? $_GET['page'] : 1;

// Calcular el desplazamiento
$offset = ($paginaActual - 1) * $cursosPorPagina;

// Preparar la consulta SQL con el límite y el desplazamiento
$sql = "SELECT * FROM courses ORDER BY `c_id` LIMIT $offset, $cursosPorPagina";

/*  --BUSQUEDA-- */ 
// Obtener el término de búsqueda ingresado por el usuario
$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';

// Preparar la consulta SQL con el término de búsqueda
$sql = "SELECT * FROM courses WHERE course_name LIKE '%$searchTerm%' ORDER BY `c_id` LIMIT $offset, $cursosPorPagina";



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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .custom-search-btn {
            background-color: #FF4081;
            border-color: #FF4081;
            color: #fff;
        }

        .custom-search-btn:hover {
            background-color: #FF4081;
            border-color: #FF4081;
            color: #fff;
        }
    </style>
</head>
<body>
<?php include('header.php'); ?>
<main class="container">
    <form action="courses.php" method="GET" class="mb-4">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Buscar cursos">
            <div class="input-group-append">
                <button type="submit" class="btn custom-search-btn">Buscar</button>
            </div>
        </div>
    </form>
    <h1 class="page-title">Cursos</h1>
    <div class="card-container">
        <?php echo $show; ?>    
    </div>

    <!-- Mostrar la paginación -->
    <div class="pagination mt-4">
        <?php
        // Mostrar enlaces a las diferentes páginas
        for ($i = 1; $i <= $totalPaginas; $i++) {
            // Agregar clase 'active' al enlace de la página actual
            $activeClass = ($i == $paginaActual) ? 'active' : '';

            echo '<a href="courses.php?page=' . $i . '" class="page-link ' . $activeClass . '">' . $i . '</a>';
        }
        ?>
    </div>
</main>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

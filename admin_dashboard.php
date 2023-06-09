<?php
// Incluir el archivo de conexión a la base de datos
require_once('db_conn.php');
// Verificar si el usuario está autenticado y tiene permiso de administrador
if (!isAdminLoggedIn()) {
  header('location:login.php?login_please');
  die();
}

$show = '';
$searchTerm = '';

// Verificar si se ha enviado un término de búsqueda
if (isset($_GET['search'])) {
  $searchTerm = $_GET['search'];
  // Escapar caracteres especiales para evitar inyección de SQL
  $searchTerm = mysqli_real_escape_string($conn, $searchTerm);
  // Preparar la consulta SQL con la condición de búsqueda
  $sql = "SELECT * FROM courses WHERE course_name LIKE '%$searchTerm%' ORDER BY `c_id`";
} else {
  // Preparar la consulta SQL sin la condición de búsqueda
  $sql = "SELECT * FROM courses ORDER BY `c_id`";
}

// Ejecutar la consulta y almacenar el conjunto de resultados
$result = mysqli_query($conn, $sql);

// Comprobar si se han encontrado resultados
if (mysqli_num_rows($result) > 0) {
  // Iniciar tabla HTML y encabezados de tabla

  // Recorrer el conjunto de resultados y mostrar cada fila como una fila de tabla
  while($row = mysqli_fetch_assoc($result)) {
    $c_id = $row['c_id'];
    $imageUrl = $row['image'];

    $show .= '<div class="card">
      <div class="card-content">
        <h2>'.$row['course_name'].'</h2>
        <img class="card-image" src="' . $imageUrl . '" alt="' . $row['course_name'] . '">
        <p>'.substr($row['course_description'], 0, 100) . "...".'</p>
        <a href="teacher_course.php?c_id='.$c_id.'" class="button">Detalles</a>
        <a href="delete.php?c_id='.$c_id.'" class="eliminar">Eliminar</a>
        <a href="edit.php?c_id='.$c_id.'" class="editar">Editar</a>
      </div>
    </div>';
  }

}
else {
  // No se han encontrado resultados
  $show = "<div class='error'>No se encontraron cursos.</div>";
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="./assets/css/style.css">
  <title>mabersa</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
</head>
<body>
  <?php include('header.php'); ?>

  <h1 class="mb-4">Panel de Control - cursos</h1>

  <main>
    <h1 class="page-title">Cursos</h1>

    <!-- Agregar el formulario de búsqueda -->
    <form action="" method="GET" class="search-form">
      <input type="text" name="search" placeholder="Buscar cursos" value="<?php echo htmlspecialchars($searchTerm); ?>">
      <button type="submit">Buscar</button>
    </form>

    <div class="card-container">
      <?php echo $show; ?>    
    </div>
  </main>
</body>
</html>


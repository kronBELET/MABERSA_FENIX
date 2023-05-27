<?php
// Incluir el archivo de conexión a la base de datos
require_once('db_conn.php');

$show = $info = '';
if (isset($_REQUEST['c_id'])) {
    $c_id = mysqli_real_escape_string($conn, $_REQUEST['c_id']);

    // Preparar la consulta SQL para obtener los detalles del curso
    $sql = "SELECT * FROM courses WHERE `c_id` = '$c_id'";

    // Ejecutar la consulta y almacenar el conjunto de resultados
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    // Comprobar si se han encontrado resultados
    if (mysqli_num_rows($result) > 0) {
        $c_id = $row['c_id'];
        $t_id = $row['t_id'];

        // Obtén las lesiones disponibles para el curso actual
        $sql_lesiones = "SELECT * FROM lesiones WHERE t_id = $t_id";
        $result_lesiones = mysqli_query($conn, $sql_lesiones);
    } else {
        // No se han encontrado resultados
        $show = "<div class='error'>No se encontraron cursos.</div>";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Mabersa</title>
    <link rel="stylesheet" type="text/css" href="./assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <?php include('header.php'); ?>
    <main>
        <h1 class="page-title">Detalles del curso</h1>
        <?php echo $info; ?>
        <?php echo $show; ?>

        <!-- Mostrar los detalles del curso -->
        <div class="course-container">
            <div class="course-info">
                <h2><?php echo $row['course_name']; ?></h2>
                <p><?php echo nl2br($row['course_description']); ?></p>
                <a href="add_lesion.php?c_id=<?php echo $c_id; ?>" class="btn btn-primary">Agregar Lesiones</a>
            </div>
            <div class="video-container">
                <video src="./<?php echo $row['video']; ?>" controls></video>
            </div>
        </div>

        <?php if (mysqli_num_rows($result_lesiones) > 0): ?>
            <h2>Lesiones Disponibles</h2>
            <ul>
                <?php while ($row_lesiones = mysqli_fetch_assoc($result_lesiones)): ?>
                    <li>
                        <h3><?php echo $row_lesiones['lesion_name']; ?></h3>
                        <p><?php echo $row_lesiones['lesion_description']; ?></p>
                        <video src="<?php echo $row_lesiones['video']; ?>" controls></video>
                    </li>
                <?php endwhile; ?>
            </ul>
        <?php endif; ?>
    </main>
    <?php include('footer.php'); ?>
</body>

</html>

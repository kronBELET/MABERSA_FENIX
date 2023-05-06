<?php
// Incluir el archivo de conexión a la base de datos
require_once('db_conn.php');
$show = $info = '';
if (isset($_REQUEST['c_id'])) {
    $c_id = mysqli_real_escape_string($conn, $_REQUEST['c_id']);
   // Preparar la consulta SQL
    $sql = "SELECT * FROM courses WHERE `c_id` = '$c_id'";

    // Ejecutar la consulta y almacenar el conjunto de resultados
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
  // Comprobar si se han encontrado resultados
    if (mysqli_num_rows($result) > 0) {

        $c_id = $row['c_id'];
        $t_id = $row['t_id'];

        $sql1 = "SELECT * FROM `enrollment` WHERE `c_id` = '$c_id'";
        $result1 = mysqli_query($conn, $sql1);
        $row1 = mysqli_fetch_assoc($result1);
        if (!empty($row1)) {
            $table = '<table>';
            $table .= '<thead><tr><th>ID de usuario</th><th>Nombre</th><th>Correo electrónico</th></tr></thead>';

            do {
                $st_id = $row1['u_id'];
                $sql2 = "SELECT * FROM `users` WHERE `u_id` = '$st_id'";
                $result2 = mysqli_query($conn, $sql2);
                $row2 = mysqli_fetch_assoc($result2);

                $table .= '<tr>';
                $table .= '<td>' . $row2["u_id"] . '</td>';
                $table .= '<td>' . $row2["name"] . '</td>';
                $table .= '<td>' . $row2["email"] . '</td>';
                $table .= '</tr>';
            } while ($row1 = mysqli_fetch_assoc($result1));
            $table .= '</table>';
        }
        $show .= '
            <div class="course-container">
            <div class="video-container">
            <video src="./' . $row['video'] . '" controls></video>
        </div>
        <div class="course-info">
            <h2>' . $row['course_name'] . '</h2>
            <p>' . nl2br($row['course_description']) . '</p>
        </div>
        <div class="students">
        <h2 class="center">Estudiantes Inscritos</h2>
        ' . $table . '
        </div>
        </div>';
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
    </head>

    <body>
        <?php include('header.php'); ?>
        <main>
            <h1 class="page-title">Detalles del curso</h1>
            <?php echo $info; ?>
            <?php echo $show; ?>
        </main>
        <?php include('footer.php'); ?>
    </body>

</html>
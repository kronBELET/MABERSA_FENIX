<?php
// Incluir el archivo de conexión a la base de datos
require_once('db_conn.php');
$show = $info = '';

// Verificar si se ha enviado la solicitud de inscripción
if (isset($_REQUEST['enroll'])) {
    if (isNotLoggedIn() && isTeacherLoggedIn()) {
        $info = '<div class="error">¡Solo los estudiantes conectados pueden inscribirse!</div>';
    } else {
        if (isset($_SESSION['u_id'])) {
            $u_id = $_SESSION['u_id'];
            $c_id = mysqli_real_escape_string($conn,$_REQUEST['enroll']);
            $sql2 = "SELECT * FROM `enrollment` WHERE `c_id` = '$c_id' AND `u_id` = '$u_id'";
            $result2 = mysqli_query($conn,$sql2);
            if (mysqli_num_rows($result2) > 0) {
                $info = '<div class="error">¡Ya estás matriculado en este curso!</div>';
            } else {
                $sql3 = "INSERT INTO `enrollment` (`c_id`,`u_id`) VALUES ('$c_id','$u_id')";
                if (mysqli_query($conn,$sql3)) {
                    $info = '<div class="success">¡Inscripción exitosa!</div>';
                } else {
                    $info = '<div class="error">¡Ocurrió un error!</div>';
                }
            }
        } else {
            // Manejar el caso cuando el usuario no ha iniciado sesión
            $info = '<div class="error">¡Debes iniciar sesión para inscribirte en este curso!</div>';
        }
    }
}

// Verificar si se ha enviado la solicitud de cancelación de inscripción
if (isset($_REQUEST['cancel'])) {
    if (isset($_SESSION['u_id'])) {
        $u_id = $_SESSION['u_id'];
        $c_id = mysqli_real_escape_string($conn, $_REQUEST['cancel']);
        $sql5 = "DELETE FROM `enrollment` WHERE `c_id` = '$c_id' AND `u_id` = '$u_id'";
        if (mysqli_query($conn, $sql5)) {
            $info = '<div class="success">¡Inscripción cancelada!</div>';
        } else {
            $info = '<div class="error">¡Ocurrió un error al cancelar la inscripción!</div>';
        }
    } else {
        // Manejar el caso cuando el usuario no ha iniciado sesión
        $info = '<div class="error">¡Debes iniciar sesión para cancelar la inscripción!</div>';
    }
}

if (isset($_REQUEST['c_id'])) {
    $c_id = mysqli_real_escape_string($conn,$_REQUEST['c_id']);
    // Preparar la consulta SQL
    $sql = "SELECT * FROM courses WHERE `c_id` = '$c_id'";

    // Ejecutar la consulta y almacenar el conjunto de resultados
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    // Comprobar si se han encontrado resultados
    if (mysqli_num_rows($result) > 0) {
        $c_id = $row['c_id'];
        $t_id = $row['t_id'];

        $sql1 = "SELECT * FROM `users` WHERE `u_id` = '$t_id'";
        $result1 = mysqli_query($conn,$sql1);
        $row1 = mysqli_fetch_assoc($result1);

        // Verificar si el usuario está inscrito en el curso
        $enrolled = false;
        if (isset($_SESSION['u_id'])) {
            $u_id = $_SESSION['u_id'];
            $sql4 = "SELECT * FROM `enrollment` WHERE `c_id` = '$c_id' AND `u_id` = '$u_id'";
            $result4 = mysqli_query($conn, $sql4);
            if (mysqli_num_rows($result4) > 0) {
                $enrolled = true;
            }
        }

        $show .= '<div class="video-container">
            <video src="./'.$row['video'].'" controls></video>
        </div>
        <div class="course-info">
            <h2>'.$row['course_name'].'</h2>
            <p><b>Maestro/Maestra:</b> '.$row1['name'].'</p>
            <p>'.nl2br($row['course_description']).'</p>';

        if ($enrolled) {
            $show .= '<a href="?cancel='.$row['c_id'].'" class="cancel-btn">Cancelar inscripción</a>';
        } else {
            $show .= '<a href="?c_id='.$row['c_id'].'&enroll='.$row['c_id'].'" class="enroll-btn">Enlístate ahora</a>';
        }

        $show .= '</div>';
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
        <div class="course-container">
            <?php echo $show; ?>
        </div>
    </main>
    <?php include('footer.php'); ?>
</body>
</html>

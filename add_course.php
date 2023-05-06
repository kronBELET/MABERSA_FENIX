<?php
// Incluir el archivo de conexión a la base de datos
require_once('db_conn.php');
if (!isTeacherLoggedIn()) {
    header('location:login.php?login_please');
    die();
}
// Inicializar la variable de información
$msg = '';

$info = array(); // para contener mensajes de error/éxito
// imprimir_r($_SESION);
if (isset($_POST['add_course'])) {
    // obtener datos del formulario
    $u_id = $_SESSION['u_id'];
    $course_name = mysqli_real_escape_string($conn, $_POST['course_name']);
    $course_description = mysqli_real_escape_string($conn, $_POST['course_description']);
    $sql = "SELECT * FROM `courses` WHERE `course_name` = '$course_name' AND `t_id` = '$u_id'";
    $result1 = mysqli_query($conn,$sql);
    if (mysqli_num_rows($result1) == 0) {
       // validar la carga del archivo
        if (isset($_FILES['video']) && $_FILES['video']['error'] == 0) {
            $allowed_extensions = array('mp4', 'webm');
            $max_file_size = 25 * 1024 * 1024; // 25 MB
            $file_info = pathinfo($_FILES['video']['name']);
            $file_extension = strtolower($file_info['extension']);
            $file_size = $_FILES['video']['size'];

           // comprobar la extensión y el tamaño del archivo
            if (in_array($file_extension, $allowed_extensions) && $file_size <= $max_file_size) {
                // genera un nombre de archivo único y sube el archivo
                $upload_dir = 'uploads/';
                $upload_file = $upload_dir . uniqid() . '.' . $file_extension;
                if (move_uploaded_file($_FILES['video']['tmp_name'], $upload_file)) {
                    // insertar datos del curso en la base de datos
                    $query = "INSERT INTO courses (t_id,course_name, course_description, video) 
                          VALUES ('$u_id', '$course_name', '$course_description', '$upload_file')";
                    if (mysqli_query($conn, $query)) {
                        $info['success'] = 'Curso añadido con éxito';
                    } else {
                        $info['error'] = 'No se pudo agregar el curso';
                    }
                } else {
                    $info['error'] = 'No se pudo cargar el video';
                }
            } else {
                $info['error'] = 'Tamaño o formato de archivo no válido. Tipos de archivos permitidos: mp4, webm, tamaño máximo: 25 MB';
            }
        } else {
            $info['error'] = 'Seleccione un archivo de video';
        }
    } else {
        $info['error'] = '¡Curso ya presente!';
    }
    if (!empty($info)) {
        foreach ($info as $key => $value) {
            $msg .= '<div class="' . $key . '">' . $value . '</div>';
        }
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
            <div class="forms">
                <form method="post" action="add_course.php" enctype="multipart/form-data">
                    <h2 class="subtitle">Añadir curso</h2>
                    <?php echo $msg; ?>
                    <label for="course_name">Nombre del curso:</label>
                    <input type="text" class="input" name="course_name" id="course_name" required>
                    <label for="course_description">Descripción del curso:</label>
                    <textarea class="input" name="course_description" rows="4" id="course_description"
                        required></textarea>
                    <label for="video">Video:</label>
                    <input type="file" class="input" name="video" id="video" required>
                    <button type="submit" class="submit" name="add_course">Añadir curso</button>
                </form>
            </div>
        </main>
        <?php include('footer.php'); ?>
    </body>

</html>
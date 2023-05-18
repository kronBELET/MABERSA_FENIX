<?php
// Incluir el archivo de conexión a la base de datos
require_once('db_conn.php');
if (!isTeacherLoggedIn() && !isAdminLoggedIn()) {
    header('location:login.php?login_please');
    die();
}
// Inicializar la variable de información
$msg = '';

$info = array(); // para contener mensajes de error/éxito

if (isset($_POST['add_course'])) {
    // obtener datos del formulario
    $u_id = $_SESSION['u_id'];
    $course_name = mysqli_real_escape_string($conn, $_POST['course_name']);
    $course_description = mysqli_real_escape_string($conn, $_POST['course_description']);
    $sql = "SELECT * FROM `courses` WHERE `course_name` = '$course_name' AND `t_id` = '$u_id'";
    $result1 = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result1) == 0) {
        // validar la carga del archivo de video
        if (isset($_FILES['video']) && $_FILES['video']['error'] == 0) {
            $allowed_extensions = array('mp4', 'webm');
            $max_file_size = 25 * 1024 * 1024; // 25 MB
            $file_info = pathinfo($_FILES['video']['name']);
            $file_extension = strtolower($file_info['extension']);
            $file_size = $_FILES['video']['size'];

            // comprobar la extensión y el tamaño del archivo de video
            if (in_array($file_extension, $allowed_extensions) && $file_size <= $max_file_size) {
                // generar un nombre de archivo único y subir el archivo de video
                $upload_dir = 'uploads/';
                $video_file = $upload_dir . uniqid() . '.' . $file_extension;
                if (move_uploaded_file($_FILES['video']['tmp_name'], $video_file)) {
                    // validar la carga del archivo de imagen
                    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                        $allowed_image_extensions = array('jpg', 'jpeg', 'png', 'gif');
                        $max_image_size = 5 * 1024 * 1024; // 5 MB
                        $image_info = pathinfo($_FILES['image']['name']);
                        $image_extension = strtolower($image_info['extension']);
                        $image_size = $_FILES['image']['size'];

                        // comprobar la extensión y el tamaño del archivo de imagen
                        if (in_array($image_extension, $allowed_image_extensions) && $image_size <= $max_image_size) {
                            // generar un nombre de archivo único y subir el archivo de imagen
                            $image_file = $upload_dir . uniqid() . '.' . $image_extension;
                            if (move_uploaded_file($_FILES['image']['tmp_name'], $image_file)) {
                                // insertar datos del curso en la base de datos
                                $query = "INSERT INTO courses (t_id, course_name, course_description, video, image) 
                                          VALUES ('$u_id', '$course_name', '$course_description', '$video_file', '$image_file')";
                                if (mysqli_query($conn, $query)) {
                                    $info['success'] = 'Curso añadido con éxito';
                                } else {
                                    $info['error'] = 'No se pudo agregar el curso';
                                }
                            } else {
                                $info['error'] = 'No se pudo cargar la imagen';
                            }
                        } else {
                            $info['error'] = 'Tamaño o formato de archivo de imagen no válido. Tipos de archivos permitidos: jpg, jpeg, png, gif, tamaño máximo: 5 MB';
                        }
                    } else {
                        $info['error'] = 'Seleccione una imagen';
                    }
                } else {
                    $info['error'] = 'No se pudo cargar el video';
                }
            } else {
                $info['error'] = 'Tamaño o formato de archivo de video no válido. Tipos de archivos permitidos: mp4, webm, tamaño máximo: 25 MB';
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
                <textarea class="input" name="course_description" rows="4" id="course_description" required></textarea>
                <label for="video">Video:</label>
                <input type="file" class="input" name="video" id="video" required>
                <label for="image">Imagen:</label>
                <input type="file" class="input" name="image" id="image" required>
                <button type="submit" class="submit" name="add_course">Añadir curso</button>
            </form>
        </div>
    </main>
    <?php include('footer.php'); ?>
</body>

</html>

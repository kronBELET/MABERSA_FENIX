<?php
// Incluir el archivo de conexión a la base de datos
require_once('db_conn.php');

// Verificar si se enviaron los datos del formulario
if (isset($_POST['c_id'])) {
    // Obtener el identificador del registro a actualizar
    $c_id = $_POST['c_id'];

    // Realizar la consulta para obtener los datos del registro
    $query = "SELECT * FROM courses WHERE c_id = $c_id";
    $result = mysqli_query($conn, $query);

    // Verificar si se encontró el registro
    if (mysqli_num_rows($result) > 0) {
        // Obtener los datos del registro
        $row = mysqli_fetch_assoc($result);

        // Obtener los valores actualizados del formulario
        $nombre = mysqli_real_escape_string($conn, $_POST['nombre']);
        $descripcion = mysqli_real_escape_string($conn, $_POST['descripcion']);
        
        // Verificar si se proporcionó un nuevo archivo de imagen
        if ($_FILES['imagen']['name'] != '') {
            $allowed_image_extensions = array('jpg', 'jpeg', 'png', 'gif');
            $max_image_size = 5 * 1024 * 1024; // 5 MB
            $image_info = pathinfo($_FILES['imagen']['name']);
            $image_extension = strtolower($image_info['extension']);
            $image_size = $_FILES['imagen']['size'];

            // Comprobar la extensión y el tamaño del archivo de imagen
            if (in_array($image_extension, $allowed_image_extensions) && $image_size <= $max_image_size) {
                // Generar un nombre de archivo único y subir el archivo de imagen
                $upload_dir = 'uploads/';
                $image_file = $upload_dir . uniqid() . '.' . $image_extension;
                if (move_uploaded_file($_FILES['imagen']['tmp_name'], $image_file)) {
                    // Eliminar el archivo de imagen anterior si existe
                    if (file_exists($row['image'])) {
                        unlink($row['image']);
                    }
                    // Actualizar la ruta de la imagen en la base de datos
                    $update_query = "UPDATE courses SET course_name = '$nombre', course_description = '$descripcion', image = '$image_file' WHERE c_id = $c_id";
                    mysqli_query($conn, $update_query);
                } else {
                    echo "Error al cargar la imagen.";
                }
            } else {
                echo "Tamaño o formato de archivo de imagen no válido. Tipos de archivos permitidos: jpg, jpeg, png, gif, tamaño máximo: 5 MB";
            }
        } else {
            // No se proporcionó un nuevo archivo de imagen, actualizar solo los otros campos
            $update_query = "UPDATE courses SET course_name = '$nombre', course_description = '$descripcion' WHERE c_id = $c_id";
            mysqli_query($conn, $update_query);
        }

        // Verificar si se proporcionó un nuevo archivo de video
        if ($_FILES['video']['name'] != '') {
            $allowed_video_extensions = array('mp4', 'webm');
            $max_video_size = 25 * 1024 * 1024; // 25 MB
            $video_info = pathinfo($_FILES['video']['name']);
            $video_extension = strtolower($video_info['extension']);
            $video_size = $_FILES['video']['size'];

            // Comprobar la extensión y el tamaño del archivo de video
            if (in_array($video_extension, $allowed_video_extensions) && $video_size <= $max_video_size) {
                // Generar un nombre de archivo único y subir el archivo de video
                $upload_dir = 'uploads/';
                $video_file = $upload_dir . uniqid() . '.' . $video_extension;
                if (move_uploaded_file($_FILES['video']['tmp_name'], $video_file)) {
                    // Eliminar el archivo de video anterior si existe
                    if (file_exists($row['video'])) {
                        unlink($row['video']);
                    }
                    // Actualizar la ruta del video en la base de datos
                    $update_query = "UPDATE courses SET video = '$video_file' WHERE c_id = $c_id";
                    mysqli_query($conn, $update_query);
                } else {
                    echo "Error al cargar el video.";
                }
            } else {
                echo "Tamaño o formato de archivo de video no válido. Tipos de archivos permitidos: mp4, webm, tamaño máximo: 25 MB";
            }
        }

        // Redirigir a la página de detalles del curso después de la actualización
        if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {
            header('location: admin_dashboard.php');
        }
        elseif (isset($_SESSION['role']) && $_SESSION['role'] == 'teacher') {
            header('location: teacher_dashboard.php');
        }

        exit();
    } else {
        echo "No se encontró el registro.";
    }

    // Liberar los resultados de la consulta
    mysqli_free_result($result);
}

// Cerrar la conexión a la base de datos
mysqli_close($conn);
?>

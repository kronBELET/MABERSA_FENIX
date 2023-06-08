<?php
// Incluir el archivo de conexión a la base de datos
require_once('db_conn.php');

// Verificar si el maestro está autenticado
if (!isTeacherLoggedIn() && !isAdminLoggedIn()) {
    header('location:login.php?login_please');
    die();
} {
    header('location: login.php');
    exit();
}

// Verificar si se ha enviado el formulario de carga de lesión
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_lesion'])) {
    // Obtener los datos del formulario
    $t_id = $_SESSION['u_id'];
    $lesion_name = mysqli_real_escape_string($conn, $_POST['lesion_name']);
    $lesion_description = mysqli_real_escape_string($conn, $_POST['lesion_description']);

    // Validar y subir el archivo de video de la lesión
    if (isset($_FILES['video']) && $_FILES['video']['error'] === 0) {
        $allowed_extensions = array('mp4', 'webm');
        $max_file_size = 25 * 1024 * 1024; // 25 MB
        $file_info = pathinfo($_FILES['video']['name']);
        $file_extension = strtolower($file_info['extension']);
        $file_size = $_FILES['video']['size'];

        // Verificar la extensión y el tamaño del archivo
        if (in_array($file_extension, $allowed_extensions) && $file_size <= $max_file_size) {
            // Generar un nombre de archivo único y subir el archivo de video
            $upload_dir = 'uploads/';
            $video_file = $upload_dir . uniqid() . '.' . $file_extension;
            if (move_uploaded_file($_FILES['video']['tmp_name'], $video_file)) {
                // Insertar los datos de la lesión en la base de datos
                $query = "INSERT INTO lesiones (t_id, lesion_name, lesion_description, video) 
                          VALUES ('$t_id', '$lesion_name', '$lesion_description', '$video_file')";
                if (mysqli_query($conn, $query)) {
                    // La lesión se ha agregado exitosamente
                    $success_msg = 'La lesión se ha agregado exitosamente.';
                } else {
                    // Error al agregar la lesión en la base de datos
                    $error_msg = 'No se pudo agregar la lesión.';
                }
            } else {
                // Error al subir el archivo de video
                $error_msg = 'No se pudo cargar el archivo de video.';
            }
        } else {
            // Archivo de video no válido (extensión o tamaño)
            $error_msg = 'El archivo de video no es válido. Tipos de archivos permitidos: mp4, webm. Tamaño máximo: 25 MB.';
        }
    } else {
        // No se seleccionó un archivo de video
        $error_msg = 'Seleccione un archivo de video.';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Mabersa - Agregar Lesión</title>
    <link rel="stylesheet" type="text/css" href="./assets/css/style.css">
</head>
<body>
    <?php include('header.php'); ?>

    <main>
        <div class="forms">
            <form method="post" action="add_lesion.php" enctype="multipart/form-data">
                <h2 class="subtitle">Agregar Lesión</h2>
                <?php if (isset($success_msg)): ?>
                    <div class="success"><?php echo $success_msg; ?></div>
                <?php endif; ?>
                <?php if (isset($error_msg)): ?>
                    <div class="error"><?php echo $error_msg; ?></div>
                <?php endif; ?>
                <label for="lesion_name">Nombre de la Lesión:</label>
                <input type="text" class="input" name="lesion_name" id="lesion_name" required>
                <label for="lesion_description">Descripción de la Lesión:</label>
                <textarea class="input" name="lesion_description" rows="4" id="lesion_description" required></textarea>
                <label for="video">Video:</label>
                <input type="file" class="input" name="video" id="video" required>
                <button type="submit" class="submit" name="add_lesion">Agregar Lesión</button>
            </form>
        </div>
    </main>

    <?php include('footer.php'); ?>
</body>
</html>

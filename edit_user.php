<?php
// Incluir el archivo de conexión a la base de datos
require_once('db_conn.php');
// Verificar si el usuario está autenticado y tiene permiso de administrador
if (!isAdminLoggedIn()) {
    header('location:login.php?login_please');
    die();
}

// Comprobar si se ha pasado el parámetro u_id en la URL
if (isset($_GET['u_id'])) {
    $u_id = $_GET['u_id'];

    // Comprobar si se ha enviado el formulario de edición
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Obtener los datos del formulario
        $newName = $_POST['name'];
        $newEmail = $_POST['email'];

        // Actualizar los datos en la base de datos
        $updateSql = "UPDATE users SET name='$newName', email='$newEmail' WHERE u_id=$u_id";
        if (mysqli_query($conn, $updateSql)) {
            // Redirigir a la página user.php después de la actualización exitosa
            header('location:user.php');
            die();
        } else {
            echo "Error al actualizar los datos: " . mysqli_error($conn);
        }
    }

    // Obtener los datos del usuario a editar
    $getUserSql = "SELECT * FROM users WHERE u_id=$u_id";
    $userResult = mysqli_query($conn, $getUserSql);
    if ($userResult && mysqli_num_rows($userResult) > 0) {
        $user = mysqli_fetch_assoc($userResult);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./assets/css/style.css">
    <title>mabersa - Editar Usuario</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<?php include('header.php'); ?>

<h1 class="mb-4">Panel de Control - Editar Usuario</h1>

<main>
    <h1 class="page-title">Editar Usuario</h1>
    <div class="edit-form">
        <form method="POST" action="">
            <input type="hidden" name="u_id" value="<?php echo $user['u_id']; ?>">
            <label for="name">Nombre de usuario:</label>
            <input type="text" name="name" value="<?php echo $user['name']; ?>" required>
            <br>
            <label for="email">Correo electrónico:</label>
            <input type="email" name="email" value="<?php echo $user['email']; ?>" required>
            <br>
            <input type="submit" value="Guardar cambios">
        </form>
    </div>
</main>

</body>
</html>

<?php
    } else {
        echo "Usuario no encontrado.";
    }
} else {
    echo "ID de usuario no proporcionado.";
}
?>


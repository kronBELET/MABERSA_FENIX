<?php
// Incluir el archivo de conexión a la base de datos
require_once('db_conn.php');

// Verificar si el usuario está autenticado y tiene permiso de administrador
if (!isAdminLoggedIn()) {
    header('location:login.php?login_please');
    die();
  }
  
  // Obtener todos los usuarios de la base de datos
  $sql = "SELECT * FROM users";
  $result = mysqli_query($db, $sql);
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
            <h1 class="page-title">Cursos</h1>
            <div class="card-container">
                <?php echo $show; ?>
            </div>
        </main>
        <?php include('footer.php'); ?>
    </body>

</html>
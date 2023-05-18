<?php
 //Incluye el archivo de conexión a la base de datos
require_once('db_conn.php');
// print_r($_SESSION);
// Inicializa la variable de información
$signup_info = $login_info = '';
if (isset($_REQUEST['login_please'])) {
    $login_info = '<div class="error">¡Tienes que iniciar sesión primero!</div>';
}
// Verifica si el formulario se ha enviado
if(isset($_POST['signup'])) {
  // Obtener los datos del formulario
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = md5($_POST['password']);
    $role = mysqli_real_escape_string($conn, $_POST['role']);

   // Verifica si el correo electrónico ya existe en la base de datos
    $email_check_query = "SELECT * FROM users WHERE email = '$email' LIMIT 1";
    $result = mysqli_query($conn, $email_check_query);
    $user = mysqli_fetch_assoc($result);
  
    if (!empty($user)) {  // El correo electrónico ya existe
        if ($user['email'] === $email) {
           // Establece un mensaje de error
            $signup_info = '<div class="error">La dirección de correo ya existe!</div>';
        }
    } else { //// El correo electrónico no existe, inserta un nuevo usuario en la base de datos
        $insert_query = "INSERT INTO users (name, email, password, role) 
                         VALUES('$name', '$email', '$password', '$role')";
        mysqli_query($conn, $insert_query);

         // Establece un mensaje de éxito
        $signup_info = '<div class="success">Usuario creado con éxito!</div>';
    }
}elseif(isset($_POST['login'])){
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $password = md5($_POST['password']);
  
    $query = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $result = mysqli_query($conn, $query);
  
    if(mysqli_num_rows($result) == 1){
      $row = mysqli_fetch_assoc($result);
      $_SESSION['u_id'] = $row['u_id'];
      $_SESSION['name'] = $row['name'];
      $_SESSION['email'] = $row['email'];
      $_SESSION['role'] = $row['role'];
  
      $login_info = "<div class='success'>Inicio de sesión exitoso</div>";
      if ($_SESSION['role'] == 'student') {
        header('location: student_dashboard.php');
      } elseif($_SESSION['role'] == 'teacher') {
        header('location: teacher_dashboard.php');
      }elseif($_SESSION['role'] == 'admin') {
        header('location: admin_dashboard.php');
      }
      
    } else {
      $login_info = "<div class='error'>Correo electrónico o contraseña no válidos</div>";
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
                <form action="login.php" method="post">
                    <h2 class="subtitle">Acceso</h2>
                    <?php echo $login_info; ?>
                    <label class="label" for="email">Correo electrónico</label>
                    <input class="input" type="email" id="email" name="email" required>
                    <label class="label" for="password">Contraseña</label>
                    <input class="input" type="password" id="password" name="password" required>
                    <input class="submit" type="submit" value="Acceso" name="login">
                </form>
                <form action="login.php" method="post">
                    <h2 class="subtitle">Signup</h2>
                    <?php echo $signup_info; ?>
                    <label class="label" for="name">Nombre</label>
                    <input class="input" type="text" id="name" name="name" required>
                    <label class="label" for="email">Correo electrónico</label>
                    <input class="input" type="email" id="email" name="email" required>
                    <label class="label" for="password">Contraseña</label>
                    <input class="input" type="password" id="password" name="password" minlength="8" required>
                    <label class="label" for="role">Rol</label>
                    <select class="select" id="role" name="role" required>
                        <option value="">Selecciona un rol</option>
                        <option value="teacher">Maestro/Maestra</option>
                        <option value="student">Alumno/Alumna</option>
                    </select>
                    <input class="submit" type="submit" name="signup" value="Inscribirse">
                </form>
            </div>
        </main>
        <?php include('footer.php'); ?>
    </body>

</html>
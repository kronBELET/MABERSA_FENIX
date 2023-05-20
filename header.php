<header>
    <h1>Mabersa</h1>
    <nav>
        <ul>
            <?php

            // Comprobar si el usuario está conectado como estudiante
            if (isset($_SESSION['role']) && $_SESSION['role'] == 'student') {
                echo '<li><a href="index.php">Hogar</a></li>';
                echo '<li><a href="courses.php">Cursos</a></li>';
                echo '<li><a href="student_dashboard.php">Panel</a></li>';
                echo '<li><a href="politics.php">nosotros</a></li>';
                echo '<li><a href="logout.php">Cerrar sesión</a></li>';
            }
            // Comprobar si el usuario está conectado como profesor
            elseif (isset($_SESSION['role']) && $_SESSION['role'] == 'teacher') {
                echo '<li><a href="index.php">Hogar</a></li>';
                echo '<li><a href="teacher_dashboard.php">Panel</a></li>';
                echo '<li><a href="courses.php">Cursos</a></li>';
                echo '<li><a href="add_course.php">Añadir curso</a></li>';
                echo '<li><a href="politics.php">nosotros</a></li>';
                echo '<li><a href="logout.php">Cerrar sesión</a></li>';
            }
            //si el usuario es el administrador
            elseif (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {
                echo '<li><a href="approved_courses.php">cursos sin aprovar</a></li>';
                echo '<li><a href="admin_dashboard.php">Cursos</a></li>';
                echo '<li><a href="user.php">Usuarios</a></li>';
                echo '<li><a href="add_course.php">Añadir curso</a></li>';
                echo '<li><a href="politics.php">nosotros</a></li>';
                echo '<li><a href="logout.php">Cerrar sesión</a></li>';
            }
            
            // Si el usuario no está conectado
            else {
                echo '<li><a href="index.php">Hogar</a></li>';
                echo '<li><a href="courses.php">Cursos</a></li>';
                echo '<li><a href="politics.php">nosotros</a></li>';
                echo '<li><a href="login.php">Iniciar sesión/Registrarse</a></li>';
            }
            ?>
        </ul>
    </nav>
</header>
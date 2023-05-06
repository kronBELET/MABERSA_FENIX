<header>
    <h1>Mabersa</h1>
    <nav>
        <ul>
            <?php

            // Check if user is logged in as student
            if (isset($_SESSION['role']) && $_SESSION['role'] == 'student') {
                echo '<li><a href="index.php">Hogar</a></li>';
                echo '<li><a href="courses.php">Cursos</a></li>';
                echo '<li><a href="student_dashboard.php">Panel</a></li>';
                echo '<li><a href="logout.php">Cerrar sesión</a></li>';
            }
            // Check if user is logged in as teacher
            elseif (isset($_SESSION['role']) && $_SESSION['role'] == 'teacher') {
                echo '<li><a href="index.php">Hogar</a></li>';
                echo '<li><a href="teacher_dashboard.php">Panel</a></li>';
                echo '<li><a href="add_course.php">Añadir curso</a></li>';
                echo '<li><a href="logout.php">Cerrar sesión</a></li>';
            }
            // If user is not logged in
            else {
                echo '<li><a href="index.php">Hogar</a></li>';
                echo '<li><a href="courses.php">Cursos</a></li>';
                echo '<li><a href="login.php">Iniciar sesión/Registrarse</a></li>';
            }
            ?>
        </ul>
    </nav>
</header>
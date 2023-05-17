<?php
// Incluir el archivo de conexión a la base de datos
require_once('db_conn.php');

$show = '';
// Preparar la consulta SQL
$sql = "SELECT * FROM courses where approved = 1 ORDER BY `c_id` LIMIT 6";

// Ejecutar la consulta y almacenar el conjunto de resultados
$result = mysqli_query($conn, $sql);

// Comprobar si se han encontrado resultados
if (mysqli_num_rows($result) > 0) {
   // Iniciar tabla HTML y encabezados de tabla
   
    // Recorrer el conjunto de resultados y mostrar cada fila como una fila de tabla
    while($row = mysqli_fetch_assoc($result)) {
        $c_id = $row['c_id'];

        $show .= '<div class="card">
        <div class="card-content">
            <h2>'.$row['course_name'].'</h2>
            <p>'.substr($row['course_description'], 0, 100) . "...".'</p>
            <a href="course.php?c_id='.$c_id.'" class="button">Aprende más</a>
        </div>
    </div>';
    }
    
} else {
   // No se han encontrado resultados
    $show = "<div class='error'>No se encontraron cursos.</div>";
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
    <!DOCTYPE html>
<html>
<head>
	<title>Cursos Online</title>
</head>
<body>
    
    <?php include('header.php'); ?>
    <div class="main-banner" id="top">
        <main>
            <section>
                <h2 class="page-title">Bienbenido a Mabersa</h2>
                <p class="paragraph">Descubre nuestra amplia selección de cursos en línea y permite nos ayudarte en tu camino al conocimiento, contams con cursos de tod tipo, algunos son:</p>
                <ul class="paragraph" style="list-style: none;">
                    <li>Curso de programación en PHP</li>
                    <li>Curso de diseño gráfico</li>
                    <li>Curso de marketing digital</li>
                    <li>Curso de inglés avanzado</li>
                </ul>
            </section>
        </main>
        
        <main>
            <h1 class="page-title">Cursos Recientes</h1>
            <div class="card-container">
                <?php echo $show; ?>    
            </div>
        </main  class="main-banner">
            <section>
            <h2 class="page-title">¿Quienes somos?</h2> 
            <p class="paragraph">Los desarrolladores están trabajando en equipo para crear una página web de cursos en línea. Ambos tienen experiencia en programación web y están dedicados a ofrecer una experiencia de usuario de alta calidad. Están utilizando tecnologías modernas y herramientas para diseñar y desarrollar la página, y están comprometidos a seguir las mejores prácticas de desarrollo web para garantizar la seguridad y la escalabilidad de la plataforma. Uno de los desarrolladores se centra en el front-end, diseñando la interfaz de usuario y la experiencia de usuario, mientras que el otro se centra en el back-end, programando la funcionalidad de la plataforma y la integración de bases de datos. Juntos, están trabajando para crear una plataforma robusta y fácil de usar que permita a los usuarios descubrir, inscribirse y tomar cursos en línea de manera eficiente.</p>
            <br>
            </section>
            <section>
            <h2 class="page-title">Nuestro equipo</h2>
            
            </section>
            <section>
            <h2 class="page-title">Nuestras politicas de privacidad</h2>
                <h1 class="paragraph">Política de privacidad de Mabersa</h1>
            <p class="paragraph">En Mabersa nos tomamos muy en serio la privacidad de nuestros usuarios. Esta política de privacidad describe cómo recopilamos, utilizamos y protegemos su información personal cuando utiliza nuestros servicios en línea.</p>
            <br>
                <h1 class="paragraph">Cómo utilizamos su información</h1>
            <br>
            <p class="paragraph">Utilizamos su información personal para proporcionarle nuestros servicios en línea, incluyendo para procesar pagos y enviarle notificaciones por correo electrónico. También utilizamos su información para mejorar nuestros servicios y personalizar su experiencia en nuestro sitio web.</p>
            <br>
                <h1 class="paragraph">Protección de su información</h1>
            <br>
            <p class="paragraph">Tomamos medidas de seguridad razonables para proteger su información personal contra el acceso no autorizado o el uso indebido. Utilizamos encriptación y otros métodos de seguridad para proteger su información personal mientras se transmite y se almacena en nuestros servidores.</p>
            </section>
        <?php include('footer.php'); ?>
    </body>

</html>
<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Mabersa</title>
    <link rel="stylesheet" type="text/css" href="./assets/css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Estilos personalizados */
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        .main-banner {
            padding: 20px;
        }

        .section-container {
            background-color: #fff;
            padding: 20px;
            margin-bottom: 20px;
        }

        .paragraph {
            color: #666;
            font-size: 16px;
            line-height: 1.5;
            text-align: left;
        }
        
        .team-members {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
        }

        .team-member {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 20px;
            flex-basis: calc(50% - 10px);
        }

        .team-member-name {
            margin-top: 10px;
            margin-bottom: 5px;
        }

        .team-member-image {
            width: 200px; /* ajusta el tamaño de la imagen según tus necesidades */
            height: auto;
        }
        
        .circle-image {
            border-radius: 50%;
            width: 200px; /* Tamaño deseado para el ancho */
            height: 200px; /* Tamaño deseado para la altura */
            object-fit: cover; /* Ajustar imagen para llenar el contenedor sin distorsionar */
        }
        
        .support-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }
        
        .support-text {
            margin-bottom: 10px;
        }

        .support-image {
            margin: 0 auto;
            display: block;
        }
        
        .center {
            text-align: center;
        }
    </style>
</head>

<body>
    <?php include('header.php'); ?>
    <main class="main-banner">
        <section class="section-container">
            <h2 class="page-title">¿Quiénes somos?</h2>
            <p class="paragraph">Los desarrolladores están trabajando en equipo para crear una página web de cursos en línea. Ambos tienen experiencia en programación web y están dedicados a ofrecer una experiencia de usuario de alta calidad. Están utilizando tecnologías modernas y herramientas para diseñar y desarrollar la página, y están comprometidos a seguir las mejores prácticas de desarrollo web para garantizar la seguridad y la escalabilidad de la plataforma. Uno de los desarrolladores se centra en el front-end, diseñando la interfaz de usuario y la experiencia de usuario, mientras que el otro se centra en el back-end, programando la funcionalidad de la plataforma y la integración de bases de datos. Juntos, están trabajando para crear una plataforma robusta y fácil de usar que permita a los usuarios descubrir, inscribirse y tomar cursos en línea de manera eficiente.</p>
        </section>
        <section class="section-container">
            <h2 class="page-title">Nuestro equipo</h2>
            <div class="team-members">
                <div class="team-member">
                    <img src="assets/images/luis1.jpg" alt="Imagen de Jose Luis Giraldo Suaza" class="team-member-image circle-image">
                    <h3 class="team-member-name">Jose Luis Giraldo Suaza</h3>
                </div>
                <div class="team-member">
                    <img src="assets/images/camilo2.jpg" alt="Imagen de Juan Camilo Henao Perez" class="team-member-image circle-image">
                    <h3 class="team-member-name">Juan Camilo Henao Perez</h3>
                </div>
            </div>
        </section>
        <section class="section-container contact-container">
            <h2 class="page-title center">¿Quieres contactarnos?</h2>
            <p class="paragraph contact-email center">Correo: Mabersa@gmail.com</p>
        </section>
        <section class="section-container contact-container">
            <h2 class="page-title center">¡Importante!</h2>
            <p class="paragraph contact-email center">Mabersa es una pagina web para todas las edades por lo que si suves contenido +18 o inaprpiado ten en cuanta que tu publiacacion sera eliminada ademas esta puede no ser aprobada</p>
        </section>

        <section class="section-container">
            <h2 class="page-title">Nuestras políticas de privacidad</h2>
            <h1 class="paragraph">Política de privacidad de Mabersa</h1>
            <p class="paragraph">En Mabersa nos tomamos muy en serio la privacidad de nuestros usuarios. Esta política de privacidad describe cómo recopilamos, utilizamos y protegemos su información personal cuando utiliza nuestros servicios en línea.</p>
            <h1 class="paragraph">Cómo utilizamos su información</h1>
            <p class="paragraph">Utilizamos su información personal para proporcionarle nuestros servicios en línea, incluyendo el procesamiento de pagos y el envío de notificaciones por correo electrónico. También utilizamos su información para mejorar nuestros servicios y personalizar su experiencia en nuestro sitio web.</p>
            <h1 class="paragraph">Protección de su información</h1>
            <p class="paragraph">Tomamos medidas de seguridad razonables para proteger su información personal contra el acceso no autorizado o el uso indebido. Utilizamos encriptación y otros métodos de seguridad para proteger su información personal mientras se transmite y se almacena en nuestros servidores.</p>
        </section>
        <section class="section-container">
            <h2 class="page-title">¿Quieres apoyarnos?</h2>
            <div class="support-container">
                <p class="paragraph support-text">En nuestro Patreon podrás apoyarnos si lo deseas</p>
                <a href="https://patreon.com/Mabersa">
                    <img src="assets/images/patreon.png" alt="patreon" class="support-image">
                </a>
            </div>
        </section>    
    </main>
    <?php include('footer.php'); ?>
</body>
</html>










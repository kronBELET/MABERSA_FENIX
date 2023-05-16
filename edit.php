<?php
// Incluir el archivo de conexión a la base de datos
require_once 'db_conn.php';

// Verificar si se proporcionó el identificador del registro
if (isset($_GET['c_id'])) {
    // Obtener el identificador del registro desde la URL
    $c_id = $_GET['c_id'];

    // Realizar la consulta para obtener los datos del registro
    $query = "SELECT * FROM courses WHERE c_id = $c_id";
    $result = mysqli_query($conn, $query);

    // Verificar si se encontró el registro
    if (mysqli_num_rows($result) > 0) {
        // Obtener los datos del registro
        $row = mysqli_fetch_assoc($result);

        // Mostrar el formulario de edición con los datos del registro
        ?>

<form action="update.php" method="post">
            <input type="hidden" name="c_id" value="<?php echo $row['c_id']; ?>">
            <!-- Aquí puedes mostrar los campos del formulario con los datos del registro -->
            <label>Nombr Del Curso:</label>
            <input type="text" name="nombre" value="<?php echo $row['course_name']; ?>">
            <!-- Otros campos del formulario... -->
            <label>Descrición:</label>
            <input type="text" name="descricion" value="<?php echo $row['course_description']; ?>">
            
            <input type="submit" value="Guardar cambios">
        </form>

        <?php
    } else {
        echo "No se encontró el registro.";
    }

    // Liberar los resultados de la consulta
    mysqli_free_result($result);
}

// Cerrar la conexión a la base de datos
mysqli_close($conn);
?>
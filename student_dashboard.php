<?php
// Include the database connection file
require_once('db_conn.php');
if (!isStudentLoggedIn()) {
    header('location:login.php?login_please');
    die();
}
$u_id = $_SESSION['u_id'];
// Prepare the SQL query
$sql = "SELECT * FROM enrollment WHERE u_id = '$u_id'";

// Execute the query and store the result set
$result = mysqli_query($conn, $sql);

// Check if any results found
if (mysqli_num_rows($result) > 0) {


    // Start HTML table and table headers
    $show = '<table>';
    $show .= '<thead><tr><th>ID</th><th>Nombre del curso</th><th>Maestro/Maestra</th><th>Fecha Agregada</th><th>Acción</th></tr></thead>';

    // Loop through the result set and output each row as a table row
    while ($row = mysqli_fetch_assoc($result)) {
        $c_id = $row['c_id'];

        // Prepare the SQL query
        $sql2 = "SELECT * FROM courses WHERE c_id = '$c_id'";

        // Execute the query and store the result set
        $result2 = mysqli_query($conn, $sql2);
        $row2 = mysqli_fetch_assoc($result2);

        $t_id = $row2['t_id'];
        $sql1 = "SELECT `name` FROM `users` WHERE `u_id` = '$t_id'";
        $result1 = mysqli_query($conn, $sql1);
        $row1 = mysqli_fetch_assoc($result1);

        $show .= '<tr>';
        $show .= '<td>' . $row2["c_id"] . '</td>';
        $show .= '<td>' . $row2["course_name"] . '</td>';
        $show .= '<td>' . $row1["name"] . '</td>';
        $show .= '<td>' . $row2["timestamp"] . '</td>';
        $show .= '<td><a href="course.php?c_id=' . $row["c_id"] . '">Ver detalles</a></td>';
        $show .= '</tr>';
    }

    // Close the table tag
    $show .= '</table>';
} else {
    // No results found
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
        <?php include('header.php'); ?>
        <main>
            <h1 class="page-title">My Courses</h1>
            <div class="card-container">
                <?php echo $show; ?>
            </div>
        </main>
        <?php include('footer.php'); ?>
    </body>

</html>
<?php
// Include the database connection file
require_once('db_conn.php');
if (!isTeacherLoggedIn()) {
    header('location:login.php?login_please');
    die();
}
$t_id = $_SESSION['u_id'];
// Prepare the SQL query
$sql = "SELECT * FROM courses WHERE t_id = '$t_id'";

// Execute the query and store the result set
$result = mysqli_query($conn, $sql);

// Check if any results found
if (mysqli_num_rows($result) > 0) {
    // Start HTML table and table headers
    $show = '<table>';
    $show .= '<thead><tr><th>ID</th><th>Course Name</th><th>Students Enrolled</th><th>Date Added</th><th>Action</th></tr></thead>';
    
    // Loop through the result set and output each row as a table row
    while($row = mysqli_fetch_assoc($result)) {

        
        $c_id = $row['c_id'];
        $sql1 = "SELECT COUNT(*) AS `total_students` FROM `enrollment` WHERE `c_id` = '$c_id'";
        $result1 = mysqli_query($conn,$sql1);
        $row1 = mysqli_fetch_assoc($result1);

        $show .= '<tr>';
        $show .= '<td>' . $row["c_id"] . '</td>';
        $show .= '<td>' . $row["course_name"] . '</td>';
        $show .= '<td>' . $row1["total_students"] . '</td>';
        $show .= '<td>' . $row["timestamp"] . '</td>';
        $show .= '<td><a href="teacher_course.php?c_id=' . $row["c_id"] . '">Ver detalles</a></td>';
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
            <h1 class="page-title">Cursos</h1>
            <div class="card-container">
                <?php echo $show; ?>
            </div>
        </main>
        <?php include('footer.php'); ?>
    </body>

</html>
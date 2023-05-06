<?php
// Include the database connection file
require_once('db_conn.php');

$show = '';
// Prepare the SQL query
$sql = "SELECT * FROM courses ORDER BY `c_id` LIMIT 6";

// Execute the query and store the result set
$result = mysqli_query($conn, $sql);

// Check if any results found
if (mysqli_num_rows($result) > 0) {
    // Start HTML table and table headers
   
    // Loop through the result set and output each row as a table row
    while($row = mysqli_fetch_assoc($result)) {
        $c_id = $row['c_id'];

        $show .= '<div class="card">
        <div class="card-content">
            <h2>'.$row['course_name'].'</h2>
            <p>'.substr($row['course_description'], 0, 100) . "...".'</p>
            <a href="course.php?c_id='.$c_id.'" class="button">Learn More</a>
        </div>
    </div>';
    }
    
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
            <h1 class="page-title">Cursos Recientes</h1>
            <div class="card-container">
                <?php echo $show; ?>    
            </div>
        </main>
        <?php include('footer.php'); ?>
    </body>

</html>
<?php
// Include the database connection file
require_once('db_conn.php');
$show = $info = '';
if (isset($_REQUEST['enroll'])) {
    if (isNotLoggedIn() && isTeacherLoggedIn()) {
        $info = '<div class="error">Only logged in students can enroll!</div>';
    } else {
        $u_id = $_SESSION['u_id'];
        $c_id = mysqli_real_escape_string($conn,$_REQUEST['enroll']);
        $sql2 = "SELECT * FROM `enrollment` WHERE `c_id` = '$c_id' AND `u_id` = '$u_id'";
        $result2 = mysqli_query($conn,$sql2);
        if (mysqli_num_rows($result2) > 0) {
            $info = '<div class="error">You are already enrolled in this subject!</div>';
        }else{
            $sql3 = "INSERT INTO `enrollment` (`c_id`,`u_id`) VALUES ('$c_id','$u_id')";
            if (mysqli_query($conn,$sql3)) {
                $info = '<div class="success">Enrollment successful!</div>';
            }else{
                $info = '<div class="error">An error occurred!</div>';
            }
        }
    }
    
}
if (isset($_REQUEST['c_id'])) {
    $c_id = mysqli_real_escape_string($conn,$_REQUEST['c_id']);
    // Prepare the SQL query
    $sql = "SELECT * FROM courses WHERE `c_id` = '$c_id'";

    // Execute the query and store the result set
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    // Check if any results found
    if (mysqli_num_rows($result) > 0) {

        $c_id = $row['c_id'];
        $t_id = $row['t_id'];

            $sql1 = "SELECT * FROM `users` WHERE `u_id` = '$t_id'";
            $result1 = mysqli_query($conn,$sql1);
            $row1 = mysqli_fetch_assoc($result1);

            $show .= '<div class="video-container">
            <video src="./'.$row['video'].'" controls></video>
        </div>
        <div class="course-info">
            <h2>'.$row['course_name'].'</h2>
            <p><b>Maestro/Maestra:</b> '.$row1['name'].'</p>
            <p>'.nl2br($row['course_description']).'</p>
            <a href="?c_id='.$row['c_id'].'&enroll='.$row['c_id'].'" class="enroll-btn">Enlístate ahora</a>
        </div>';
    } else {
        // No results found
        $show = "<div class='error'>No se encontraron cursos.</div>";
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
            <h1 class="page-title">Detalles del curso</h1>
                <?php echo $info; ?>
            <div class="course-container">
                <?php echo $show; ?>
            </div>
        </main>
        <?php include('footer.php'); ?>
    </body>

</html>
<?php
include('../../Includes/db_config.php');
if (isset($_POST['done'])) {
    $g_id = $_POST['g_id'];
    $sub_goal = $_POST['done'];
    echo $g_id;
    echo $sub_goal;
    // $sql = "DELETE FROM sub_goals WHERE g_id = $g_id AND sub_goals='$sub_goal'";
    $sql = "UPDATE sub_goals SET status = 1 WHERE g_id = $g_id AND sub_goals = '$sub_goal'";
    // Execute the delete query
    if (mysqli_query($conn, $sql)) {
        header("Location: index.php");
        exit;
    } else {
        echo "Error deleting task: " . mysqli_error($conn);
    }
}
?>
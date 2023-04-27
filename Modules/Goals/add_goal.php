<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="goals.css" />
</head>

<body>
    <form action="" method="POST">
        <div class="add_goal_container">
            <label for="g_name" class="g_labels">Enter your goal:</label><br>
            <input type="text" name="g_name" class="g_inputs"><br><br>
            <label for="sub_goals" class="g_labels">Enter your sub goals:</label><br>
            <input type="text" name="sub_goals" class="g_inputs"><br><br>
            <label for="due_date" class="g_labels">Enter the due date:</label><br>
            <input type="date" name="due_date" class="g_inputs"><br><br>
        </div>
        <!-- <input type="submit" class="add_goal"  value="Submit"> -->
        <button class="shadow_btn" role="button" name="submit" style="font-size: 14pt;">Add</button>

    </form>
</body>

</html>

<?php
include('../../Includes/db_config.php');
if (isset($_POST['submit'])) {
    // Get goal name, due date, and sub goals from form data
    $goal_name = $_POST['g_name'];
    $due_date = $_POST['due_date'];
    $sub_goals = $_POST['sub_goals'];
    $start_date = date("Y/m/d");
    $u_id = '1';

    // Insert goal into "goals" table
    // $status = 0; // Set status to 0 (not completed) by default
    $sql = "INSERT INTO goals (u_id, goal, start_date, end_date) VALUES ('$u_id', '$goal_name', '$start_date', '$due_date')";
    if ($conn->query($sql) === FALSE) {
        echo "Error: " . $sql . "<br>" . $conn->error;
    } else {
        // Get ID of newly inserted goal
        $g_id = $conn->insert_id;

        // Insert sub goals into "sub_goals" table
        $sub_goal_array = explode(',', $sub_goals);
        foreach ($sub_goal_array as $sub_goal) {
            $sql = "INSERT INTO sub_goals (g_id, sub_goals) VALUES ('$g_id', '$sub_goal')";
            if ($conn->query($sql) === FALSE) {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
        header("Location: index.php");
        // Close database connection
        $conn->close();
    }
}
?>
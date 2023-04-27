<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Goals</title>
    <link rel="stylesheet" href="goals.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
</head>

<body>
    <?php
    // include database connection details
    include('../../Includes/db_config.php');
    $u_id = 1;
    // fetch all goals from the database
    $result = mysqli_query($conn, "SELECT * FROM goals WHERE u_id= '$u_id'");
    $goals = mysqli_fetch_all($result, MYSQLI_ASSOC);


    //  display goals one at a time 

    if (empty($goals)) {
        echo "No goals";
    } else { ?>
        <!-- navigation buttons -->
        <div class="navigation">
            <!-- <button class="goals_nav_btns" id="prevBtn"><span id="prevBtn" class="material-symbols-rounded">chevron_left</span></button> -->
            <!-- <button class="goals_nav_btns" id="nextBtn"><span id="nextBtn" class="material-symbols-rounded">chevron_right</span></button> -->
            <h2>YOUR GOALS</h2>
            <div class="goals_nav_btns"><span id="prevBtn" class="material-symbols-rounded">chevron_left</span></div>
            <div class="goals_nav_btns"><span id="nextBtn" class="material-symbols-rounded">chevron_right</span></div>
        </div>
        <?php foreach ($goals as $i => $goal) : ?>
            <div class="goal_container" <?php if ($i > 0) : ?>style="display: none" <?php endif; ?>>
                <h2 class="g_heading"><?php echo $goal['goal']; ?></h2>

                <!-- fetch sub-goals for this goal from the database -->
                <?php
                $subResult = mysqli_query($conn, "SELECT * FROM sub_goals WHERE g_id = '{$goal['g_id']}'");
                $subGoals = mysqli_fetch_all($subResult, MYSQLI_ASSOC);
                ?>
                <?php if (!empty($subGoals)) : ?>
                    <!-- <p><strong>Sub-Goals:</strong></p> -->
                    <form action="delete_goal.php" method="post">
                        <ul class="sub_goals">
                            <?php foreach ($subGoals as $subGoal) :
                                if ($subGoal['status'] == 1) {
                                    echo "<li class='strikethrough'>" . $subGoal['sub_goals'] . "</li>";
                                } elseif ($subGoal['status'] == 0) { ?>
                                    <li><?php echo $subGoal['sub_goals']; ?><button type="submit" class="goals_done_btn" name="done" value='<?php echo $subGoal['sub_goals'] ?>'>Done</button><input type="hidden" name="g_id" value='<?php echo $subGoal['g_id'] ?>'></li>
                                    <!-- <input type="button" class="goals_done_btn" name="done" value="done"> -->
                            <?php }
                            endforeach; ?>
                        </ul>
                    </form>
                <?php endif; ?>

                <p><strong style="color:black;">Due Date:</strong> <?php echo $goal['end_date']; ?></p>
                <p><strong style="color:black;">Status:</strong> <?php echo $goal['status'] == 1 ? 'Completed' : 'Incomplete'; ?></p>
            </div>
    <?php endforeach;
    } ?>
    <form action="add_goal.php">
        <button class="shadow_btn" role="button">Add Goal</button>
    </form>

    <!-- script to handle navigation -->
    <script>
        const goals = document.querySelectorAll('.goal_container');
        let currentGoal = 0;

        // hide all goals except the first one
        goals.forEach((goal, i) => {
            if (i > 0) {
                goal.style.display = 'none';
            }
        });

        // handle previous button click
        document.getElementById('prevBtn').addEventListener('click', () => {
            if (currentGoal > 0) {
                goals[currentGoal].style.display = 'none';
                currentGoal--;
                goals[currentGoal].style.display = 'block';
            }
        });

        // handle next button click
        document.getElementById('nextBtn').addEventListener('click', () => {
            if (currentGoal < goals.length - 1) {
                goals[currentGoal].style.display = 'none';
                currentGoal++;
                goals[currentGoal].style.display = 'block';
            }
        });
    </script>
</body>

</html>
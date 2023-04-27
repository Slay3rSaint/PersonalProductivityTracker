<?php
include('Includes/db_config.php');
session_start();
$username = $_SESSION['username'];

//fetching name and dp
$query = "SELECT name, profile_pic FROM users WHERE user_id = $username";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
$name = $row['name'];
$dp = $row['profile_pic'];
?>

<!doctype html>
<html lang="eng">

<head>
  <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1" />
  <link type="text/css" rel="stylesheet" href="CSS/ppt.css" />
  <link type="text/css" rel="stylesheet" href="CSS/profileicon.css" />
  <script src="https://unpkg.com/@phosphor-icons/web"></script>
</head>

<body>
  <div id="mobile" class="demo1">
    <div id="burgerBtn"></div>
    <nav>
      <ul id="nav">
        <li id="planners">PLANNERS</li>
        <li id="expense">EXPENSE</li>
        <li id="expense-category">EXPENSE CATEGORY</li>
        <li id="to-do">TO DO</li>
        <li id="goals">GOALS</li>
        <li id="water-tracker">WATER TRACKER</li>
        <li id="analysis">ANALYSIS</li>
        <li id="dashboard">DASHBOARD</li>
        <li id="pred">PREDICTION</li>
      </ul>
    </nav>
    <script>
      // Get all the list items
      var navItems = document.querySelectorAll('#nav li');

      // Keep track of the previously clicked list item
      var previousNavItem = null;

      // Add a click event listener to each list item
      navItems.forEach(function(navItem) {
        navItem.addEventListener('click', function() {
          // Reset the background color of the previous list item
          if (previousNavItem) {
            previousNavItem.style.backgroundColor = '';
            previousNavItem.style.color = '';
          }

          // Set the background color of the clicked list item
          navItem.style.backgroundColor = '#e66577';
          navItem.style.color = 'white';

          // Update the previously clicked list item
          previousNavItem = navItem;
        });
      });
    </script>
    <main>
      <div id="mobileBodyContent">
        <div id="header">
          <div class="action">
            <div class="profile" onclick="menuToggle();">
              <img src="data:image/jpeg;base64,<?php echo base64_encode($dp); ?>" />
            </div>
            <div class="menu">
              <h3><?php echo ($name) ?></h3>
              <ul>
                <li>
                  <i class="ph ph-user-circle"></i><a href="Modules/profile.php">My profile</a>
                </li>
                <!-- <li>
                  <img src="./assets/icons/edit.png" /><a href="#">Edit profile</a>
                </li> -->
                <li>
                  <i class="ph ph-sign-out"></i><a href="?logout">Logout</a>
                  <?php

                  if (isset($_GET['logout'])) {
                    session_unset();
                    session_destroy();
                    echo '<script type="text/javascript"> window.location.href = "login.php"; </script>';

                    exit();
                  }
                  ?>
                </li>   
              </ul>
            </div>
          </div>
          <script>
            function menuToggle() {
              const toggleMenu = document.querySelector(".menu");
              toggleMenu.classList.toggle("active");
            }
          </script>
        </div>
        <!-- <div class="body-content"></div> -->
        <iframe id="body-content" src="Modules/1.Monthly planner/4a-cal-page.php"></iframe>
        <script>
          // Get all list items and add event listener to each
          var listItems = document.querySelectorAll("#nav li");
          listItems.forEach(function(item) {
            item.addEventListener("click", function() {
              var content = document.getElementById("body-content");
              switch (item.id) {
                case "planners":
                  content.src = "Modules/1.Monthly planner/4a-cal-page.php";
                  break;
                case "expense":
                  content.src = "Modules/expense_tracker/index.php";
                  break;
                case "expense-category":
                  content.src = "Modules/expense_tracker/expense_category.php";
                  break;
                case "to-do":
                  content.src = "Modules/Todo/todo.php";
                  break;
                case "goals":
                  content.src = "Modules/Goals/index.php";
                  break;
                case "water-tracker":
                  content.src = "Modules/Water tracker/water.php";
                  break;
                case "analysis":
                  content.src = "analysis.html";
                  break;
                case "dashboard":
                  content.src = "analysis.html";
                  break;
                case "pred":
                  content.src = "Modules/Prediction/predict.php";
                  break;
                default:
                  break;
              }
            });
          });
        </script>
      </div>
  </div>
  </div>
  </main>
  <script>
    var burgerBtn = document.getElementById('burgerBtn');
    var mobile = document.getElementById('mobile');
    var demo1 = document.getElementById('demo1');
    var demo2 = document.getElementById('demo2');
    var demo3 = document.getElementById('demo3');

    burgerBtn.addEventListener('click', function() {
      mobile.classList.toggle('navigation');
    }, false);
  </script>

</body>

</html>

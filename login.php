<?php include('Includes/db_config.php') ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="CSS/login.css" />
</head>
<body>

        <div class="main">
        <div class="wave"></div>
            <div class="lp-image"></div>
            <div class="login-section">                
                <h3>Welcome back!!</h3>
                <form action=" " method="POST">
                <div class="form__group field">
                    <!-- <input required="" placeholder="Username" name="username" class="form__field" type="input"> -->
                    <input required="" placeholder="Username" name="username" class="inputbox" type="input">
                    <label class="form__label" for="Username">Username</label>
                </div>
                <div class="form__group field">
                    <!-- <input required="" placeholder="Password" name="password" class="form__field" type="password"> -->
                    <input required=""  placeholder="Password" name="password" class="inputbox" type="password">
                    <label class="form__label" for="Password">Password</label>
                </div>
                <!-- <input type="text" class="inputbox" placeholder="Username">
            <input type="text" class="inputbox" placeholder="Password"> -->
                <input type="submit" name="submit" id="login" value="Login">
                </form>
                <button class="cta" name="signup">
                <a class="hover-underline-animation" name="hover-underline-animation" href="registration.php">Sign up</a>
                    <!-- <span class="hover-underline-animation">  </span> -->
                    <svg viewBox="0 0 46 16" height="10" width="25" xmlns="http://www.w3.org/2000/svg" id="arrow-horizontal">
                        <path transform="translate(30)" d="M8,0,6.545,1.455l5.506,5.506H-30V9.039H12.052L6.545,14.545,8,16l8-8Z" data-name="Path 10" id="Path_10"></path>
                    </svg>                
                </button>
                <!--             <label>Create your own account.</label>-->
            </div>
        </div>

</body>
</html>
<?php
if (isset($_POST['submit'])) {
    $id = $_POST['username'];
    $pswd = $_POST['password'];
    // $query=mysqli_query($connection,"insert into users values('$id','asfgsg','$pswd')");
    $query = "select * from users where user_id = '$id' and pass = '$pswd'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);
    if ($count == 1) {
        header("Location:layout.php");
        session_start();
        $_SESSION['username'] = $id;
    } else {
        echo '
<script>
    window.location.href="login.php";
    alert("Login failed. Invalid username or password");
</script>
';
    }
}
?>
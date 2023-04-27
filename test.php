<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="CSS/registration.css" />
</head>

<body>
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="main">
            <div class=".reg-page">
                <div class="reg-section">
                    <h2>Create your account</h2>
                    <div class="input-group">
                        <label class="label">Username</label>
                        <input autocomplete="off" name="Username" id="Username" class="input" type="text" required>
                    </div>
                    <div class="input-group">
                        <label class="label">Name</label>
                        <input autocomplete="off" name="Name" id="Name" class="input" type="text" required>
                    </div>
                    <div class="input-group">
                        <label class="label">Phone number</label>
                        <input autocomplete="off" name="Phno" id="Phno" class="input" type="number" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="10" required>
                    </div>
                    <div class="input-group">
                        <label class="label">Email address</label>
                        <input autocomplete="off" name="Email" id="Email" class="input" type="email" required>
                    </div>

                    <div class="input-group">
                        <label class="label">Age</label>
                        <input autocomplete="off" name="Age" id="Age" class="input" type="number" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="2" required>
                    </div>
                    <div class="input-group">
                        <label class="label">Gender</label>
                        <input autocomplete="off" name="Gender" id="Gender" class="input" type="text" required>
                    </div>
                    <div class="input-group">
                        <label class="label">Password</label>
                        <input autocomplete="off" name="Password" id="Password" class="input" type="text" required>
                    </div>
                    <div class="input-group">
                        <label class="label">Confirm Password</label>
                        <input autocomplete="off" name="CPassword" id="CPassword" class="input" type="text" required>
                    </div>
                    <div class="input-group">
                        <label class="label">Upload your photo</label>
                        <input name="photo" id="photo" class="input" type="file" required>
                    </div>
                    <input type="submit" id="reg-btn" name="register" value="Submit">
                </div>
            </div>
        </div>
    </form>
</body>
</html>

<?php
include('Includes/db_config.php');

if (isset($_POST['register'])) {

    $id = $_POST['Username'];
    $name = mysqli_real_escape_string($conn, $_POST['Name']);
    $phno = mysqli_real_escape_string($conn, $_POST['Phno']);
    $email = mysqli_real_escape_string($conn, $_POST['Email']);
    $age = mysqli_real_escape_string($conn, $_POST['Age']);
    $gender = mysqli_real_escape_string($conn, $_POST['Gender']);
    $pswd = mysqli_real_escape_string($conn, $_POST['Password']);
    $cpswd = mysqli_real_escape_string($conn, $_POST['CPassword']);
    // $profile_pic = addslashes(file_get_contents($_FILES["photo"]["tmp_name"])); // convert the image file to binary data
    // $photo = file_get_contents($_FILES['photo']['tmp_name']);
    // $photo = base64_encode($photo);
    // $image = $_FILES['photo']['tmp_name'];
    // $photo = addslashes(file_get_contents($image));
    $photo = addslashes(file_get_contents($_FILES['photo']['tmp_name']));

    // $dp = addslashes(file_get_contents($_FILES['photo']['tmp_name']));

    // if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {

    //     $profile_pic = mysqli_real_escape_string($conn, $_POST['photo']);
    // }

    // Check if passwords match
    if ($pswd !== $cpswd) {
        echo '
        <script>
            alert("Passwords do not match");
        </script>
        ';
        exit();
    }


    // Build the SQL query
    $query = "INSERT INTO users (user_id, name, pass, email,  age, gender, phno, profile_pic) VALUES ('$id', '$name', '$pswd', '$email', '$age', '$gender', '$phno', '$photo')";


    // Execute the query
    $result = mysqli_query($conn, $query);

    // Check if the insert was successful
    if ($result) {
        // echo "Data inserted successfully.";
        // header('Location: login.php');
        echo '
        <script>
            alert("Registration successfull");
        </script>
        ';
        echo '<script type="text/javascript"> window.location.href = "login.php"; </script>';

        exit();
    } else {
        echo "Error inserting data: " . mysqli_error($conn);
    }

    // if (mysqli_affected_rows($conn) > 0) {
    //     header("Location: login.php");
    //     exit();
    // } else {
    //     echo '
    //     <script>
    //         alert("Registration failed");
    //     </script>
    //     ';
    // }
}
?>


<!-- <div class="row">
                <div class="column left">
                          <label>Username:</label>
                          <label>Email:</label>
                          <label>Password:</label>
                          <label>Confirm password:</label>
                          <label>Name:</label>
                          <label>Age:</label>
                          <label>Gender:</label>
                          <label>Phone number:</label>
                </div>
            </div>
                <div class="column right"> </div> 



                // if (isset($_POST['register'])) {

//     $id = $_POST['username'];
//     $pswd = $_POST['password'];
//     // $query=mysqli_query($connection,"insert into users values('$id','asfgsg','$pswd')");
//     $query = "select * from users where user_id = '$id' and pass = '$pswd'";
//     $result = mysqli_query($connection, $query);
//     $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
//     $count = mysqli_num_rows($result);
//     if ($count == 1) {
//         header("Location:layout.php");
//     } else {
//         echo '
// <script>
//     window.location.href="login.php";
//     alert("Login failed. Invalid username or password");
// </script>
// ';
//     }
// }
// Check if the file was uploaded
// if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
//     // Read the uploaded file
//     $image_data = file_get_contents($_FILES['photo']['tmp_name']);
//     // Escape special characters in the binary data
//     $image_data = mysqli_real_escape_string($conn, $image_data);
//     // Get the user ID from the session or a form field
//     $user_id = 1;
//     // Update the user's profile picture in the database
//     $sql = "UPDATE users SET profile_pic = '$image_data' WHERE user_id = $user_id";
//     if (mysqli_query($conn, $sql)) {
//         echo "Profile picture uploaded successfully";
//     } else {
//         echo "Error uploading profile picture: " . mysqli_error($conn);
//     }
// } else {
//     echo "Error uploading file";
// }

// Close the connection





                
            // Check if required fields are empty
    if (empty($id) || empty($email) || empty($pswd) || empty($cpswd) || empty($name)) {
        echo '
        <script>
            alert("Please fill in all required fields.");
        </script>
        ';
        // echo "Please fill in all required fields.";
        exit();
    }
            
            
            
            
            -->























            <?php
include('../Includes/db_config.php');
// session_start();
$username = $_SESSION['username'];

// Build the SQL query
$query = "SELECT * FROM users WHERE user_id = '$username'";


// Execute the query
$result = mysqli_query($conn, $query);

//fetch the row as an array
$row = mysqli_fetch_assoc($result);

// $id = $_POST['Username'];
$photo = $row['profile_pic'];
$name = $row['name'];
$phno = $row['phno'];
$email = $row['email'];
$age = $row['age'];
$gender = $row['gender'];
$pass = $row['pass'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../CSS/registration.css" />
</head>

<body>
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="main">
            <div class=".reg-page">
                <div class="reg-section">
                    <h2>My Profile</h2>
                    <div class="input-group">
                        <label class="label">Username</label>
                        <input autocomplete="off" name="Username" id="Username" class="input" type="text" value="<?php echo ($username) ?>" required>
                    </div>
                    <div class="input-group">
                        <label class="label">Name</label>
                        <input autocomplete="off" name="Name" id="Name" class="input" type="text" value="<?php echo ($name) ?>" required>
                    </div>
                    <div class="input-group">
                        <label class="label">Phone number</label>
                        <input autocomplete="off" name="Phno" id="Phno" class="input" type="number" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="10" value="<?php echo isset($_POST['Phno']) ? $_POST['Phno'] : ''; ?>" required>
                    </div>
                    <div class="input-group">
                        <label class="label">Email address</label>
                        <input autocomplete="off" name="Email" id="Email" class="input" type="email" value="<?php echo isset($_POST['Email']) ? $_POST['Email'] : ''; ?>" required>
                    </div>
                    <div class="input-group">
                        <label class="label">Age</label>
                        <input autocomplete="off" name="Age" id="Age" class="input" type="number" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="2" value="<?php echo isset($_POST['Age']) ? $_POST['Age'] : ''; ?>" required>
                    </div>
                    <div class="input-group">
                        <label class="label">Gender</label>
                        <select name="Gender" id="Gender" class="input" value="<?php echo isset($_POST['Gender']) ? $_POST['Gender'] : ''; ?>" required>
                            <option value="">Select Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                    <div class="input-group">
                        <label class="label">Password</label>
                        <input autocomplete="off" name="Password" id="Password" class="input" type="text" value="<?php echo isset($_POST['Password']) ? $_POST['Password'] : ''; ?>" required>
                    </div>
                    <div class="input-group">
                        <label class="label">Confirm Password</label>
                        <input autocomplete="off" name="CPassword" id="CPassword" class="input" type="text" value="<?php echo isset($_POST['CPassword']) ? $_POST['CPassword'] : ''; ?>" required>
                    </div>
                    <div class="input-group">
                        <label class="label">Upload your photo</label>
                        <input name="photo" id="photo" class="input" type="file" value="data:image/jpeg;base64,<?php echo base64_encode($photo); ?>" required>
                    </div>
                    <input type="submit" id="reg-btn" name="register" value="Submit">
                </div>
            </div>
        </div>
    </form>
</body>
</html>

<?php
include('../Includes/db_config.php');
session_start();
$username = $_SESSION['username'];

if (isset($_POST['register'])) {

    $id = $_POST['Username'];
    $name = mysqli_real_escape_string($conn, $_POST['Name']);
    $phno = mysqli_real_escape_string($conn, $_POST['Phno']);
    $email = mysqli_real_escape_string($conn, $_POST['Email']);
    $age = mysqli_real_escape_string($conn, $_POST['Age']);
    $gender = mysqli_real_escape_string($conn, $_POST['Gender']);
    $pswd = mysqli_real_escape_string($conn, $_POST['Password']);
    $cpswd = mysqli_real_escape_string($conn, $_POST['CPassword']);
    $photo = addslashes(file_get_contents($_FILES['photo']['tmp_name']));

    // Check if passwords match
    if ($pswd !== $cpswd) {
        echo '
        <script>
            alert("Passwords do not match");
        </script>
        ';
        exit();
    }


    // Build the SQL query
    // $query = "UPDATE users (user_id, name, pass, email,  age, gender, phno, profile_pic) VALUES ('$id', '$name', '$pswd', '$email', '$age', '$gender', '$phno', '$photo') WHERE user_id = '$username'";
    $query = "UPDATE users SET name = '$name', pass = '$pswd', email = '$email', age = '$age', gender = '$gender', phno = '$phno', profile_pic = '$photo' WHERE user_id = '$username'";


    // Execute the query
    $result = mysqli_query($conn, $query);

    // Check if the insert was successful
    if ($result) {
        echo '
        <script>
            alert("Registration successfull");
        </script>
        ';
        echo '<script type="text/javascript"> window.location.href = "login.php"; </script>';

        exit();
    } else {
        echo "Error inserting data: " . mysqli_error($conn);
    }

    // if (mysqli_affected_rows($conn) > 0) {
    //     header("Location: login.php");
    //     exit();
    // } else {
    //     echo '
    //     <script>
    //         alert("Registration failed");
    //     </script>
    //     ';
    // }
}
?>
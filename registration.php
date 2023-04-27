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
                        <input autocomplete="off" name="Username" id="Username" class="input" type="text" value="<?php echo isset($_POST['Username']) ? $_POST['Username'] : ''; ?>" required>
                    </div>
                    <div class="input-group">
                        <label class="label">Name</label>
                        <input autocomplete="off" name="Name" id="Name" class="input" type="text" value="<?php echo isset($_POST['Name']) ? $_POST['Name'] : ''; ?>" required>
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
                        <input name="photo" id="photo" class="input" type="file" value="<?php echo isset($_POST['photo']) ? $_POST['photo'] : ''; ?>" required>
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
    $query = "INSERT INTO users (user_id, name, pass, email,  age, gender, phno, profile_pic) VALUES ('$id', '$name', '$pswd', '$email', '$age', '$gender', '$phno', '$photo')";


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
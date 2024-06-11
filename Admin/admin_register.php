
<?php
 // create_user.php

include "admin_connect.php";


if (isset($_POST['fullname'], $_POST['email'], $_POST['phone'], $_POST['gender'], $_POST['password'])) {
    $Fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
    $Email = mysqli_real_escape_string($conn, $_POST['email']);
    $Phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $Password = mysqli_real_escape_string($conn, $_POST['password']);

    $pass = md5($Password);

    $emailquery = "SELECT * FROM registeration_form WHERE email = '{$Email}'";
    $queryi = mysqli_query($conn, $emailquery);

    $emailcount = mysqli_num_rows($queryi);
    if ($emailcount > 0) {
        ?>
        <script>alert("Email Already Exists")</script>
        <?php
    } else {
        if($Password) {
            $isql="INSERT INTO registeration_form (fullname, email, phone, gender, password) VALUES ('$Fullname', '$Email', '$Phone', '$gender', '$pass')";
            $querysql = mysqli_query($conn, $isql);
            if($querysql) {
                $_SESSION['fullname'] = $Fullname; // Store full name in session
                $_SESSION['phone'] = $Phone; // Store full name in session
                $_SESSION['email'] = $Email; // Store email in session
                $_SESSION['gender'] = $gender; // Store gender in session
                // ?>
                // <script>alert("Connection successful")</script>
                // <?php
            } else {
                ?>
                <script>alert("Connection failed!")</script>
                <?php
            }
        } else {
            echo "Passwords do not match";
        }
    }
}

?>
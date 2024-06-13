<?php
include 'dbconn.php';

?>
<?php
session_start();
if (isset($_POST['login'])) {
    // Assuming $conn is your database connection
    $email = $_POST['email'];
    $password = $_POST['pass'];

    // Query to check if the email exists in the database
    $sql = "SELECT * FROM administrator WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);

    // Check if any rows were returned
    $email_count = mysqli_num_rows($result);
 
    if ($email_count) {
        $email_pass = mysqli_fetch_assoc($result);
        $db_pass = $email_pass['password'];

        // Verify if the password matches the password stored in the database
        if ($password === $db_pass) {
            $_SESSION['email'] = $email;
           
            ?>
            <script>
                location.replace("http://localhost/calendarnew/admin/admin_dashboard.php");
            </script>
            <?php
            exit(); // Exit after redirecting to prevent further execution
        } else {
            // Password is incorrect
            ?>
            <script>alert("Password is incorrect!");</script>
            <?php
        }
    } else {
        // Email does not exist in the database
        ?>
        <script>alert("Invalid email!");</script>
        <?php
    }
}
?>





<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>CALENDAR</title>
    <!-- <link src="jquery.php"> -->
    <!-- Google Fonts Link For Icons -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,400,0,0">
    <link rel="stylesheet" href="Style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
    <script src="Script.js" defer></script>
    
</head>
<style>
    body{
        background-color: #A27B5C;
    }
</style>
<body>
    <header id="navbar">
        <nav class="navbar" >
            <span class="hamburger-btn material-symbols-rounded">menu</span>
            <a href="#" class="logo">
                <img src="logo.png" alt="logo">
                <h2>Calendar</h2>
            </a>
            <ul class="links">
                <span class="close-btn material-symbols-rounded">close</span>
                <li><a href="index.php">Home</a></li>
                <li><a href="#f">About us</a></li>
                <li><a href="#c">Contact us</a></li>
            </ul>
            <div class="buttons">
            <button class="btn btn signup" data-bs-toggle="modal" href="#exampleModalToggle" role="button">Admin Sign in</button>
          
            </div>           
            
        </nav>
    </header>
 
    

       

    <section class="hero-section">
        <div class="hero">
            <h2 class="animation"> CALENDAR </h2>
            <p>Celebrate every day and seize the moment with our calendars, where each page holds the key to organization, inspiration, and making the most of your time.</p>
        </div>
        <div class="cal">
            <?php include('Calendar.php') ?>
        </div>
    </section>
    <footer id="f">
        <div class="container">
            <div class="footer-content">
                <div class="footer-section about">
                    <div class="hero">
                        <h2 class="animation">About Us</h2>
                        
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQk2B6borSxCBCdXqQYArQ9TStYhY70T88qnJtU5Sw66_HWhUo48Vl9FOnECwAacd12Ot8&usqp=CAU" alt="img">
                        <p>We are committed to providing you with the best calendar experience to organize your life and increase productivity.</p>
                        <br>
                        <p>A calendar is a system of organizing days. This is done by giving names to periods of time, typically days, weeks, months and years. A date is the designation of a single and specific day within such a system. A calendar is also a physical record of such a system.</p>
                        <br>
                        <p>A calendar serves as a powerful tool for organizing your life and maximizing your productivity. By utilizing a calendar effectively, you can reap numerous benefits. Firstly, a calendar helps you manage your time efficiently by providing a visual representation of your schedule, allowing you to allocate time for various tasks and activities. This ensures that you prioritize important commitments and avoid overcommitting yourself.</p>
                        <br>
                        <p>Furthermore, a calendar facilitates better planning and goal setting by allowing you to map out long-term objectives and break them down into actionable steps. By scheduling regular check-ins and milestones, you can track your progress and stay on course towards achieving your goals.</p>

                    </div>
                </div>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <div class="space">
                <div class="hero">
                    <div id="c" class="container1">
                        <h2 class="animation">Contact Us</h2>
                        <div class="footer-section-contact">
                            <div class="content">
                                <div class="left-side">
                                    <div class="address details">
                                        <i class="fas fa-map-marker-alt"></i>
                                        <div class="topic">Address</div>
                                        <div class="text-one">Surat</div>
                                        <div class="text-two">Birendranagar 06</div>
                                    </div>
                                    <div class="phone details">
                                        <i class="fas fa-phone-alt"></i>
                                        <div class="topic">Phone</div>
                                        <div class="text-one">+0098 9893 5647</div>
                                        <div class="text-two">+0096 3434 5678</div>
                                    </div>
                                    <div class="email details">
                                        <i class="fas fa-envelope"></i>
                                        <div class="topic">Email</div>
                                        <div class="text-one">xyz@gmail.com</div>
                                        <div class="text-two">info.xyz@gmail.com</div>
                                    </div>
                                </div>
                                <div class="right-side">
                                    <div class="topic-text">Send us a message</div>
                                    <p style="color: white;">If you have any work from us or any types of queries related to our website, you can send us a message from here. It's our pleasure to help you.</p>
                                    <form action="#">
                                        <div class="input-box">
                                            <input type="text" placeholder="Enter your name">
                                        </div>
                                        <div class="input-box">
                                            <input type="text" placeholder="Enter your email">
                                        </div>
                                        <div class="input-box message-box">
                                            <input type="text" placeholder="Enter Your Message...">
                                        </div>
                                        <div class="button">
                                            <input  type="button" value="Send Now">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
        <!--end-->
        <div class="footer-bottom">
            <p>&copy; 2024 Calendar App. All rights reserved.</p>
        </div>
    </footer>
    <div class="blur-bg-overlay"></div>

     <!-- Modal -->

     <div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">

    <div class="modal-content form-box login" style="height:0px;margin-top: -500px;" >
    
     
      <div class="modal-body form-details">
  
                    </div>
                        <div class="form-content">
                        <h2>Sign In</h2>
        <form action="<?php $_SERVER['PHP_SELF']; ?>" id="login-form" method="POST" class="login-form">
                        <div class="input-field">
                            <input type="email" id="email" name="email" autocomplete="off" required>
                            <label for>Email</label>
                        </div>
                        <div class="input-field">
                            <input oninput="return formvalid()" type="password" name="pass" id="pass" required autocomplete="off" />
                            <img src="close.jpg" onclick="show()" id="showimg">
                            <label>Password</label>
                            <span id="vaild-pass"></span>
                        </div>
                                <br>        
                            <a href="#" class="forgot-pass-link">Forgot password?</a>
                            <button type="submit"  class="button" name="login" id="signInBtn" onsubmit="login()">Sign In</button>
                    </form>
                        <div class="bottom-link">
                            Don't have an account?
                            <button class="btn btn" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal" data-bs-dismiss="modal">Signup</button>
                        </div>
      </div>
      <div class="modal-footer">
        
      </div>
    </div>
  </div>
</div>



<div class="modal fade" id="exampleModalToggle2" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content form-box signup" style="height:0px;margin-top: -700px;">
      
      <div class="modal-body form-details"></div>
      <div class="form-content">
      <h2>Signup</h2>
                    <form action="" method="POST" onsubmit="return validatePassword()" class="signup-form">
                    <div class="user-details">
                        <div class="input-field">
                            <input type="text" name="fullname" autocomplete="off" required>
                            <label>Full Name</label>
                        </div>
                        <div class="input-field">
                            <input type="email" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}" name="email" autocomplete="off" required>
                            <label>Email</label>
                        </div>
                        <div class="input-field">

                            <input type="tel" id="phone" name="phone" pattern="[6-9]\d{9}" autocomplete="off" required>
                            <label>Phoneno</label>
                            
                        </div>
                        <div class="input-field1">
                        <span for="gender" name="gender" required>Gender:</span>
                        <label>
                            <input type="radio" name="gender" class="gendar" value="male">
                            Male
                        </label>
                        <label>
                            <input type="radio" name="gender" class="gendar" value="female">
                         Female
                        </label>                    
                            
                        </div>

                        <div class="input-field signup-form">
                            <input  type="password" name="password"  id="pass1" required autocomplete="off" />
                            <img src="close.jpg" onclick="show1()" id="showimg1">
                            <label for="pass1">Password</label>
                            
                        </div>
                        <div class="input-field signup-form">
                            <input  type="password" name="confpassword"  id="pass2" required autocomplete="off" />
                            <img src="close.jpg" onclick="show2()" id="showimg2">
                            <label for="pass2">Confirm Password</label>
                             
                        </div>
                        
                        
                    </div>
                        <button name="signup" type="submit" id="signUpBtn">
                        Signup
                        </button>
                    </form>
                    <div class="bottom-link">
                        Already have an account? 
                        <button class="btn btn" data-bs-target="#exampleModalToggle" data-bs-toggle="modal" data-bs-dismiss="modal">Sign In</button>
                    </div>
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>


    <!-- Registeration Validation script -->

     <script>
       function validatePassword() {
            var passwordInput = document.getElementById("pass1").value;
            var confirmPasswordInput = document.getElementById("pass2").value;

            if (passwordInput != confirmPasswordInput) {
                alert("Passwords do not match.");
                return false;
            }

            var upperCaseLetters = /[A-Z]/g;
            var lowerCaseLetters = /[a-z]/g;
            var numbers = /[0-9]/g;

            if (
                passwordInput.length >= 8 &&
                passwordInput.length <= 12 &&
                passwordInput.match(upperCaseLetters) &&
                passwordInput.match(lowerCaseLetters) &&
                passwordInput.match(numbers)
            ) {
                return true;
            } else {
                alert("Password must be 8-12 characters long and include at least one uppercase letter, one lowercase letter, and one number.");
                return false;
            }

            let mail = document.forms["login-form"]["email"].value;
            if(mail == ""){
                alert("Email and Password should not be empty.");
                return false;
            }
            let pass = document.forms["login-form"]["pass"].value;

            if(pass == ""){
                alert("Email and Password should not be empty.");
                return false;
            }
        }
            </script>


  <!-- Admin regisetration validation --> 
  <script>
       function validateAdminPassword() {
            var passwordInput = document.getElementById("passw1").value;
            var confirmPasswordInput = document.getElementById("passw2").value;

            if (passwordInput != confirmPasswordInput) {
                alert("Passwords do not match.");
                return false;
            }

            var upperCaseLetters = /[A-Z]/g;
            var lowerCaseLetters = /[a-z]/g;
            var numbers = /[0-9]/g;

            if (
                passwordInput.length >= 8 &&
                passwordInput.length <= 12 &&
                passwordInput.match(upperCaseLetters) &&
                passwordInput.match(lowerCaseLetters) &&
                passwordInput.match(numbers)
            ) {
                return true;
            } else {
                alert("Password must be 8-12 characters long and include at least one uppercase letter, one lowercase letter, and one number.");
                return false;
            }

            let mail = document.forms["adminlogin-form"]["AdminEmail"].value;
            if(mail == ""){
                alert("Email and Password should not be empty.");
                return false;
            }
            let pass = document.forms["adminlogin-form"]["AdminPass"].value;

            if(pass == ""){
                alert("Email and Password should not be empty.");
                return false;
            }
        }
            </script>

</body>
</html>
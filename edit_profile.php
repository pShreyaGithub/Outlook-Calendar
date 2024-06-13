<?php
include 'dbconn.php';
?>
<?php
 session_start();
$email = $_SESSION['email'];
$sql = "SELECT gender FROM registeration_form WHERE email = '$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Assuming there's only one row for each user
    $row = mysqli_fetch_assoc($result);
    $gender = $row["gender"];
// Define default profile picture filename
$defaultProfilePic = 'default.png'; // A default profile picture for cases where gender is not specified or unknown

// Determine the profile picture based on gender
if ($gender === 'male') {
    $profilePic = 'man.svg'; // Profile picture for boys
} elseif ($gender === 'female') {
    $profilePic = 'woman.svg'; // Profile picture for girls
} else {
    $profilePic = $defaultProfilePic; // Default profile picture for unknown genders
}
}
?>
<?php
 

if(!isset($_SESSION['email'])){
  header('location: index.php');
  exit; 
}
$email = $_SESSION['email'];
$sql = "SELECT fullname, phone FROM registeration_form WHERE email = '$email'";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $userName = $row['fullname']; 
    $session_phone = $row["phone"];// User's name retrieved from the database
} else {
    $userName = "Unknown";
    $session_phone = "Unknown"; // Default value if user's name is not found
}

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="UTF-8">
  <!-- Bootstrap Link  -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
    crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
    crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

  <!-- Boxicons CDN Link -->
  <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="styles1.css">
  <link rel="stylesheet" href="style1.css">
  <link rel="stylesheet" href="navbar.css">


  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- calendar Link -->
  <!-- <link rel="stylesheet" href="caldeepak.css"> -->
  <link id="custom-css" rel="stylesheet" type="text/css" href="caldeepak.css">
  <title>Edit Profile</title>
  <style>
    body{
      background-image: url(bg.jpg);
    }
    
    .home-section1 {
    position: relative;
    background: #E4E9F7;
    min-height: 35vh;
    top: 0;
    left: 490px;
    width: 420px;
    padding:20px;
}
.sidebar.open ~ .home-section1{
  left: 250px;
  width: calc(100% - 250px);
}
.home-section1 .text{
  display: inline-block;
  color: #11101d;
  font-size: 25px;
  font-weight: 500;
  margin: 18px
}
    .container1 {
      margin-left: 89px;
      margin-top: 130px;
    min-height: 34vh;
    width: 420px;
    height:500px;
    }

    /* Modal styles */
    .btn {
      margin-right: 60%;
      width: 140px;
      height: 40px;
      font-size: 15px;
      justify-content: center;
    }
    .btn:hover {
      border: 3px solid dodgerblue;
    }


    /* Theme style*/
    .theme-switch-wrapper {
      display: flex;
      align-items: center;
      margin-right: 10px;
    }

    .theme-switch {
      display: inline-block;
      height: 22px;
      position: relative;
      width: 50px;
    }

    .theme-switch input {
      display: none;
    }

    .slider {
      background-color: #ccc;
      bottom: 0;
      cursor: pointer;
      left: 0;
      position: absolute;
      right: 0;
      top: 0;
      transition: .4s;
    }

    .slider:before {
      background-color: #fff;
      bottom: 4px;
      content: "";
      height: 14px;
      left: 4px;
      position: absolute;
      transition: .4s;
      width: 14px;
    }

    input:checked+.slider {
      background-color: #66bb6a;
    }

    input:checked+.slider:before {
      transform: translateX(26px);
    }

    .slider.round {
      border-radius: 34px;
    }

    .slider.round:before {
      border-radius: 50%;
    }

    .dark-theme {
      background-color: #333;
      color: #fff;
    }

    

    /* Transition effect */
    .in-transition {
      transition: background-color 1s;
    }

    /* CSS styles for radio buttons */
    .radio-group {
      display: flex;
      flex-direction: row;
      gap: 10px;
    }

    .radio-group label {
      display: flex;
      align-items: center;
    }

    .radio-group input[type="radio"] {
      margin-right: 5px;
      transform: scale(0.8);
      /* Adjust size of radio buttons */
    }
    .navbar-brand{
        font-size:25px;
    }
    h6{
      margin-left:864px;
    }
    
.home-section1[data-theme="sky"] {
  background-image: url(bg.jpg);
  background-repeat: no-repeat;
  background-size: cover;
  color: white;
  }
.home-section1[data-theme="pink"] {
  background-image: url(bg2.jpg);
  background-repeat: no-repeat;
  background-size: cover;
  color: white;
}


.home-section1[data-theme="blue"] {
  background-image: url(bg3.jpg);
  background-repeat: no-repeat;
  background-size: cover;
  color: white;
}
    #animal {
  position: fixed;
  z-index:9999;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  overflow: auto;
  background-color: rgba(0, 0, 0, 0.5);
  display: none;
  justify-content: center;
  align-items: center;
}

.modal-content {
  background-color: #fefefe;
  margin: auto;
  padding: 20px;
  border: 1px solid #888;
  width: 80%;
  max-width: 419px;
  border-radius: 10px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  right:440px;
  top:224px;
}

.close {
  color: #aaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: black;
  text-decoration: none;
  cursor: pointer;
}

/* .input-field {
  width: 100%;
  padding: 10px;
  margin: 5px 0;
  box-sizing: border-box;
  border: 1px solid #ccc;
  border-radius: 4px;
} */

.input-field:focus {
  outline: none;
  border-color: dodgerblue;
}

.checkbox-wrapper-54 input[type="checkbox"] {
    visibility: hidden;
    display: none;
  }

  .checkbox-wrapper-54 *,
  .checkbox-wrapper-54 ::after,
  .checkbox-wrapper-54 ::before {
    box-sizing: border-box;
  }

  /* The switch - the box around the slider */
  .checkbox-wrapper-54 .switch {
    --width-of-switch: 3.5em;
    --height-of-switch: 2em;
    /* size of sliding icon -- sun and moon */
    --size-of-icon: 1.4em;
    /* it is like a inline-padding of switch */
    --slider-offset: 0.3em;
    position: relative;
    width: var(--width-of-switch);
    height: var(--height-of-switch);
    display: inline-block;
  }

  /* The slider */
  .checkbox-wrapper-54 .slider {
    position: absolute;
    cursor: pointer;
    top: 4px;
    left: -64px;
    right: 0;
    bottom: 0;
    background-color: #f4f4f5;
    transition: .4s;
    border-radius: 30px;
    width: 48px;
    height: 26px;
    border: 1px solid black;
  }

  .checkbox-wrapper-54 .slider:before {
    position: absolute;
    content: "";
    border-radius: 20px;
    left: var(--slider-offset,0.3em);
    top: 50%;
    transform: translateY(-50%);
    background: linear-gradient(40deg,#ff0080,#ff8c00 70%);
   transition: .4s;
  }
  .checkbox-wrapper-54 .slider:after {
    position: absolute;
    content: "";
    border-radius: 20px;
    left: var(--slider-offset, 0.3em);
    top: 50%;
    transform: translateY(-35%);
    background: linear-gradient(40deg, #ff0080, #ff8c00 70%);
    transition: .4s;
    margin-block: -6px;
  }
  .checkbox-wrapper-54 input:checked + .slider {
    background-color: #303136;
    
  }

  .checkbox-wrapper-54 input:checked + .slider:before {
    /* left: calc(100% - (var(--size-of-icon,1.4em) + var(--slider-offset,0.3em))); */
    background: #303136;
    /* change the value of second inset in box-shadow to change the angle and direction of the moon  */
    box-shadow: inset -3px -2px 5px -2px #8983f7, inset -10px -4px 0 0 #a3dafb;
    margin-block: -7px;
    left: 2px;
  }
  #editprofile{
    height:400px;
  }
  </style>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
    <a class="navbar-brand">Calendar </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <sp an class="navbar-toggler-icon"></span>
    </button>
    <h6>Welcome, <?php echo $userName; ?> </h6>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">

      </ul>
      <!-- Theme -->
      <div id="button" class="checkbox-wrapper-54 theme-switch-wrapper">
  <label class="switch theme-switch" for="checkbox">
    <input type="checkbox" id="checkbox" />
    <span class="slider round"></span>
  </label>

      <div class="profile-container">
      <img src="<?php echo $profilePic; ?>" alt="Profile Picture" width="42px" height="42px">
          <div class="profile-dropdown">
          <a href="logout.php">Logout</a>
        </div>
      </div>
</div>
  </nav>
  <div class="sidebar">
    <div class="logo-details">
      <div class="logo_name">Menubar</div>
      <i class='bx bx-calendar-alt' id="btn"></i>
    </div>
    <ul class="nav-list">
      <li>
        <a href="dashboard.php">
          <i class='bx bx-grid-alt'></i>
          <span class="links_name">Dashboard</span>
        </a>
        <span class="tooltip">Dashboard</span>
      </li>
      <li>
        <a href="main.php">
        <i class="bx bx-calendar-week"></i>
        <span class="links_name">Calendar View</span>
        </a>
        <span class="tooltip">Calendar View</span>
      </li>
      <li>
        <a href="create_group.php">
          <i class='bx bx-hive'></i>
          <span class="links_name">Group Calendar</span>
        </a>
        <span class="tooltip">Group Calendar</span>
      </li>
      <li id="eventbtn">
      <a href="#"data-toggle="modal" data-target="#createEventModal" onclick="openAnimalModal()">
          <i class='bx bx-edit-alt'></i>
          <span class="links_name">Create Events </span>
        </a>
        <span class="tooltip">Create Events</span>
      </li>
      <div id="animal" class="modal">
    <div id="content" class="modal-content">
        <h5 class="head">Create Event</h5>
        <span class="close">&times;</span>
        <form method="post" action="createEventdb.php" onsubmit="addEvent('${dateKey}')">
        <input type="" id="eventDate" name="date" value="">
            <input type="text" id="title" class="input-field" name="title" placeholder="Event Title" autocomplete="off">
            <input type="text" id="description" class="input-field" name="description" placeholder="Event Description" autocomplete="off">
            <input type="time" id="start_time" class="input-field" name="start_time" placeholder="Start Time" autocomplete="off">
            <input type="time" id="end_time" class="input-field" name="end_time" placeholder="End Time" autocomplete="off">
            <input type="text" id="location" class="input-field" name="location" placeholder="Location" autocomplete="off">
            <input type="text" id="members" class="input-field" name="members" placeholder="Members" autocomplete="off">
            <button type="submit" id="add" class="btn btn" name="add">Add</button>
        </form>  
    </div>
</div>
      
      <!-- Trigger button for opening modal -->
      <li id="settingBtn">
        <a href="#">
          <i class='bx bx-cog'></i>
          <span class="links_name">Setting</span>
        </a>
        <span class="tooltip">Setting</span>
      </li>

     <!-- Modal HTML -->
<div id="settingModal" class="modal">
        <div class="modal-content">
          <span class="close">&times;</span>
          <h2>Settings</h2>
          <br>
          <h5 class="mb-4 text-2xl text-green-700 font-bold">Change Theme</h5>
          <div class="radio-group">
          <label class="radio-label"><input type="radio" name="theme" value="sky"> <span class="custom-radio"></span>Sky</label>
          <label class="radio-label"><input type="radio" name="theme" value="pink"> <span class="custom-radio"></span>Univers</label>
          <label class="radio-label"><input type="radio" name="theme" value="blue"> <span class="custom-radio"></span>Moon</label>
          </div>
          <br>
         
          <br>
          <!-- Save button to apply settings -->
          <button id="saveBtn">Save</button>
        </div>
      </div>
    </ul>
  </div>   

  <div class="container1" id="editprofile">
  <section class="home-section1">
    <form action="update_profile.php" method="POST">
      <h5 class="modal-title" id="editProfileModalLabel">Edit Profile</h5>
      <div class="user-details">
        <div class="input-field">
          <input type="text" name="fullname" value="<?php echo $userName; ?>" autocomplete="off" required>
          <label>Full Name</label>
        </div>
        <div class="input-field">
          <input type="tel" id="phone" name="phone" pattern="[6-9]\d{9}" value="<?php echo $session_phone; ?>" autocomplete="off" required>
          <label>Phone Number</label>
        </div>
        <div class="input-field signup-form">
          <input type="password" name="password" id="pass1" required autocomplete="off" />
          <img src="close.jpg" onclick="show1()" id="showimg1">
          <label for="pass1">Password</label>
        </div>
        <div class="input-field signup-form">
          <input type="password" name="confpassword" id="pass2" required autocomplete="off" />
          <img src="close.jpg" onclick="show2()" id="showimg2">
          <label for="pass2">Confirm Password</label>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" value="Update Profile" >Save Changes</button>
      </div>
    </form>
  </section>
</div>
  <script>
    //Theme Change
    document.addEventListener('DOMContentLoaded', function () {
  const checkbox = document.getElementById('checkbox');
  const sectionToChange = document.querySelector('.home-section1');

  checkbox.addEventListener('change', function() {
    sectionToChange.classList.toggle('dark-theme');
  });


// Get the modal
var modal = document.getElementById("settingModal");

// Get the button that opens the modal
var btn = document.getElementById("settingBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}

// Function to save settings and apply theme
var saveBtn = document.getElementById("saveBtn");
saveBtn.onclick = function() {
  var language = document.getElementById("language").value;
  

  // Code to save settings goes here
  console.log("Language:", language);
  
  

  // Close modal after saving
  modal.style.display = "none";
}


var radios = document.getElementsByName('theme');

Array.from(radios).forEach((el, i) => {
    el.addEventListener('change', e => {
        if (e.target.checked) {
            let value = e.target.getAttribute('value');
            document.querySelector('.home-section1').setAttribute('data-theme', value);
            document.querySelector('.home-section1').classList.add('in-transition');
            window.setTimeout(function() {
                document.querySelector('.home-section1').classList.remove('in-transition');
            }, 1000);
        }
    });
});

  

});
  </script>
  <script>
       
// Get the modal
var modal = document.getElementById("createEventModal");

// Get the button that opens the modal
var btn = document.getElementById("eventbtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close1")[0];

// When the user clicks the button, open the modal
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal1.style.display = "none";
  }
}
  </script>
  <script src="sidebar.js"></script>
<script src="Script.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>

</body>

</html>

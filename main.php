<?php
include 'dbconn.php';
session_start();
?>
<?php
$email = $_SESSION['email'];
$sql = "SELECT gender FROM registeration_form WHERE email = '$email'";
$result = mysqli_query($conn, $sql);

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
$sql = "SELECT fullname FROM registeration_form WHERE email = '$email'";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $userName = $row['fullname']; // User's name retrieved from the database
} else {
    $userName = "Unknown"; // Default value if user's name is not found
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="UTF-8">
  <title> Calendar </title>
  <!-- Bootstrap Link  -->
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<!-- Bootstrap CSS -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

<!-- Bootstrap JS bundle -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

  <!-- Boxicons CDN Link -->
  <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="styles1.css">
  <link rel="stylesheet" href="style1.css">
  <link rel="stylesheet" href="navbar.css">
<!-- <link rel="stylesheet" href="createEventStyle.css"> -->


  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- calendar Link -->
  <!-- <link rel="stylesheet" href="caldeepak.css"> -->
  <link id="custom-css" rel="stylesheet" type="text/css" href="caldeepak.css">
  <style>
    #settingModal{
     padding: 295px;
    padding-right: 680px;
    justify-items: start;
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
#displayEvent{
  
  display: none;
  position: fixed;
  z-index: 1;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  overflow: auto;
  background-color: rgba(0,0,0,0.4);

}
#add{
    width: 10%;
    margin-left: 86%;
    font-size: 19px;
    background-color: #3F4E4F;
    height: 20%;
    padding: 2px;
    margin-bottom: -94px;
    color:white;
  }
  #update{
    width: 12%;
    margin-left: 28px;
    font-size: 19px;
    background-color: #3F4E4F;
    height: 30%;
    padding: 2px;
    margin-bottom: -94px;
    color:white;

  }
  #delete{
    width: 12%;
    margin-left: 28px;
    font-size: 19px;
    background-color: #3F4E4F;;
    height: 30%;
    padding: 2px;
    margin-bottom: -94px;
    color:white;

  }
  #content{
    margin: auto;
    padding: 11px;
    border: 1px solid #888;
    width: 57%;
    height: 84%;
    margin-top: 40px;
    box-shadow: 1px 1px 29px black;
    background-color: #9a775e;
    margin-left: 25%;
  }
  #content label{
    display: inline-block;
    margin-bottom: 0.5rem;
    color: white;
    font-weight: bold;
  }
  .head{
      margin-top:5px;
      margin-bottom: 12px;
      margin-left: 39%;
    font-size: xx-large;
    color: white;
  }
  
  #eventDate, #eventDate2{
    
    width: calc(33% - -19px);
    display: inline-block;
    margin-right: 10px;
    color: #080808;
    background: white;
    padding: 15px;
    margin-left: 10px;
  }
  #name, #email {
    width: calc(33% - -19px);
    margin-right: 10px;
    color: #080808;
    background: white;
    padding: 15px;
    margin-left: 44px;
}

/* Apply styles to time fields */
#start_time, #end_time {
    width: calc(33% - -19px);
    margin-right: 10px;
    color: #080808;
    background:white;
    padding: 15px;
    margin-left: 10px;
}

/* Apply styles to location and members fields */
#description {
  width: calc(86.5% - 15px);
    margin-right: 10px;
    color: #080808;
    background:white;
    padding: 15px;
}
#title, #location{
  width: calc(33% - -19px);
    margin-right: 10px;
    color: #080808;
    background: white;
    padding: 15px;
    margin-left: 10px;
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
  position: fixed;
    left: 100px;
}

.close {
  color: white;
  float: right;
  font-size: 28px;
  font-weight: bold;
  margin-left:100%;
  margin-top:-6%;
}

.close:hover,
.close:focus {
  color: black;
  text-decoration: none;
  cursor: pointer;
}
#close {
  color: #aaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
  margin-left: 355px;
  margin-top: -0.9%;
}

#close:hover,
#close:focus {
  color: black;
  text-decoration: none;
  cursor: pointer;
}

.input-field {
  width: 100%;
  padding: 10px;
  margin: 5px 0;
  box-sizing: border-box;
  border: 1px solid #ccc;
  border-radius: 4px;
}

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
    left: -31px;
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

  /* Testing */

  
.day {
  position: relative;
  /* Other styles for day cell */
}

.has-events {
  background-color: #9f6d38 !important;
  color:white;
  cursor: pointer;
  /* Other styles for cell with events */
}
/* Style for previous month's dates */
.prev-month {
  color: #999; /* Grayish color */
}

/* Style for next month's dates */
.next-month {
  color: #999; /* Lighter grayish color */
}

.tooltiptext {
  /* visibility: hidden;
  width: auto;
  height: auto;
  background-color: #9f6d38;
  color: Black;
  text-align: left;
  padding: 5px;
  border-radius: 6px;
  position: absolute;
  z-index: 1;
  left: -145%;
  top: 50px;
  white-space: nowrap; 
  transition: visibility 0.3s ease;
  cursor: pointer;
  font-size:15px; */
/* 
  visibility: hidden;
        width: 120px;
        background-color: #555;
        color: #fff;
        text-align: center;
        border-radius: 6px;
        padding: 5px 0;
        position: absolute;
        z-index: 1;
        bottom: -120%;
        left: 50%;
        margin-left: -60px;
        opacity: 0;
        transition: opacity 0.3s;
        font-size:15px; */
        
        visibility: hidden;
    /* width: auto; */
    background-color: #555;
    color: #fff;
    text-align: justify;
    border-radius: 6px;
    padding: 8px 0;
    position: absolute;
    z-index: 1;
    bottom: -132%;
    left: 141%;
    margin-left: -46px;
    opacity: 0;
    transition: opacity 0.3s;
    font-size: 15px;
    max-width: fit-content;
}

.has-events:hover .tooltiptext {
  visibility: visible;
  

}
.day:hover .tooltiptext {
        visibility: visible;
        opacity: 1;
        width: 200px;
  height: 58px;
  overflow: auto;
  max-width:200px;
  margin-left: -315%;
    }
#myBtn{
  color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
    margin-top: -1%;
    margin-left: 97%;
}
#myBtn:hover,
#myBtn:focus {
  color: black;
  text-decoration: none;
  cursor: pointer;
}
  #eventDisplay{
    background-color: #fefefe;
    margin: 10%;
    padding: 20px;
    border: 1px solid #888;
    width: 80%;
    max-width: 600px;
    left: -2%;
  }
  /* lion */
  #lion {
  display: none;
  position: fixed;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  z-index: 1100;
  background-color: transprent;
  border: 0px;
  padding: 20px;
  width: 600px;
  height: 150px;
  margin-top: 80px;
}
#button1{
  width: 115px;
  height: 40px;
  background: #5b392c;
  margin-right: 20px;
  margin-left: 3px;
}
#button2{
  width: 115px;
  height: 40px;
  background: #5b392c;
  margin-right: 10px;
  margin-left: 0px;
}
#wrong{
  color: black;
}

/* Testttt */
.event-button {
  margin-left: 220px; 
  width:20%;
}


/* CSS for the update modal */
#update {
  display: none; 
  position: fixed; 
  z-index: 1000;
  left: 60%;
  top: 50%; 
  transform: translate(-50%, -50%); 
  width: 427px;
 height: 242px; 
  background-color: #808080; 
  border: 1px solid #888;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); 
  overflow: hidden; 
  margin-top:36px;
  border-radius: 10px;

}

#updateContent {
  background-color: #fefefe;
    margin: auto;
    padding: 20px;
    border: 1px solid #888;
    width: 100%;
    max-width: 419px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    position: fixed;
    left: 3px;
    display: flex;
}

/* Close button styling */
.close {
  color: black;
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
h2{
  color:black;
}
.modal-body{
  position: relative;
    /* -ms-flex: 1 1 auto; */
    flex: 5 6 auto;
    padding: 1rem;
    display: grid;
    row-gap: 12%;
}
.eventupdate{
  margin-left: 7%;
    height: 10%;
    font-size: 16px;
    width: 100px;
    margin-top: 3%;
}
#eventName{
  margin-top: 2%;
    margin-inline: -1%;
    width: 68%;
    background: none;
    outline: none;
    font-size: 0.95rem;
    padding: 0 15px;
    border: 1px solid #717171;
    border-radius: 3px;
    background-color: white;
    color: black;
    height: 38px;
}
.ename{
  color:black;
  margin-top: 10%;
}
.udt{
  display:flex;
}
/* Style the event data within the day elements */
.events {
  display: flex;
    flex-direction: column;
    align-items: center;
    margin-left: -200%;
    z-index: 1;
    margin-top: 21%;
  
}

.events div {
    margin: 2px 0;
    padding: 2px 5px;
    background-color: #f0f0f0;
    border-radius: 4px;
}
.events-hover {
    display: none;
    position: absolute;
    top: 46%;
    left: 60px;
    z-index: 1;
}

.day:hover .events-hover {
    display: block;
}
/* Style for the events hover effect */
.events-hover {
    position: absolute;
    background-color: rgba(0, 0, 0, 0.8);
    color: white;
    padding: 5px;
    border-radius: 5px;
    z-index: 100;
    display: none; /* Hide the events by default */
}

.day:hover .events-hover {
    display: block; /* Show the events on hover */
}

/* Tooltip style */
.tooltiptext {
  visibility: hidden;
    width: 53%;
    background-color: black;
    color: #fff;
    text-align: start;
    padding: 5px;
    border-radius: 6px;
    position: absolute;
    z-index: 1;
    display: flex;
    padding-left: 32px;
}

.day:hover .tooltiptext {
    visibility: visible;
}
.tooltiptext1 {
  
  max-height: 100px;
    font-size: 14px;
    display: flex;
    margin: 36%;
    margin-bottom: -67%;
    margin-left: -10%;
    width: 302%;
}

  </style>


</head>

<body>

  <nav class="navbar navbar-expand-lg navbar-dark fixed-top ">
    <a class="navbar-brand">Calendar </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <sp an class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <select id="view" class="select-dropdown" onchange="handleOptionChange(this)">
          <option value="year">Year</option>
          <option value="month">Month</option>
          <option value="week">Week</option>
          <option value="day">Day</option>
        </select>
       
        <div class="icon" onclick="showPreview()" id="prevButton">
        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-arrow-left-square-fill" viewBox="0 0 16 16" style="margin-top:-7px;">
  <path d="M16 14a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2zm-4.5-6.5H5.707l2.147-2.146a.5.5 0 1 0-.708-.708l-3 3a.5.5 0 0 0 0 .708l3 3a.5.5 0 0 0 .708-.708L5.707 8.5H11.5a.5.5 0 0 0 0-1"/>
</svg>
        </div>

        <select id="monthselect" class="select-dropdown1 d-none" onchange="handleMonthChange(this)">
          <option value="1">January</option>
          <option value="2">February</option>
          <option value="3">March</option>
          <option value="4">April</option>
          <option value="5">May</option>
          <option value="6">June</option>
          <option value="7">July</option>
          <option value="8">August</option>
          <option value="9">September</option>
          <option value="10">October</option>
          <option value="11">November</option>
          <option value="12">December</option>
        </select>
       
        <div class="icon" onclick="showNext()" id="nextButton">
          <!-- <img src="img/right.svg" alt="right" /> -->
          <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-arrow-right-square-fill" viewBox="0 0 16 16" style="margin-top:-7px;">
  <path d="M0 14a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2a2 2 0 0 0-2 2zm4.5-6.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5a.5.5 0 0 1 0-1"/>
</svg>
        </div>
      </ul>
      <!-- <span style=" margin-right: 250px;font-weight: bold;" id="yearContainer" class="year-container"></span> -->
      <span id="showdata" style=" margin-inline:auto;font-weight: bold; margin-left: 10px;"></span>
      <h6>Welcome, <?php echo $userName; ?> </h6>
      <br>
      <!-- Theme -->

    <div id="button" class="checkbox-wrapper-54 theme-switch-wrapper">
  <label class="switch theme-switch" for="checkbox">
    <input type="checkbox" id="checkbox" />
    <span class="slider round"></span>
  </label>
</div>
</div>
    
    <div class="profile-container">
    <img src="<?php echo $profilePic; ?>" alt="Profile Picture" width="42px" height="42px">
      <div class="profile-dropdown">
      <!-- <button class="btn btn" data-target="#updateModal" data-toggle="modal">Edit Profile</button> -->
      
      <a href="edit_profile.php">Edit profile  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
  <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
  <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
</svg></a>
        <a href="logout.php">Logout <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0z"/>
  <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z"/>
</svg></a>
      </div>
    </div>
    <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editProfileModal">
        Edit Profile
    </button> -->
    
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
       <!-- Lion Modal Content -->
<div id="lion" class="modal">
  <div class="modal-content">
    <!-- Close button -->
    <span id="wrong" class="close">&times;</span>
    
    <div class="modal-footer">
      <button id="button1">Create Event</button>
      <button id="button2">View Event</button>
    </div>
  </div>
</div>

<!-- Update modal content here -->
<div id="update" class="modal">
  <div id="updateContent" class="modal-content">
    <span class="close" onclick="closeUpdateModal()">&times;</span>
    <h2>Update Event</h2>
    <form id="updateForm">
      <label for="eventName" class="ename">Event Name:</label><br>
      <div class="udt">
      <input type="text" id="eventName" name="eventName"><br>
      
      <button type="submit" class="eventupdate">Update</button>
      </div>
    </form>
  </div>
</div>
      <div id="animal" class="modal">
    <div id="content">
        <h5 class="head">Create Event</h5>
        <span class="close">&times;</span>
        <form method="post" action="createEventdb.php" onsubmit="addEvent('${dateKey}')">
    <div>
        <label for="title">Event Title:</label>
        <input type="text" id="title" class="input-field" name="title" placeholder="Event Title" autocomplete="off">
    
        <label for="location">Location:</label>
        <input type="text" id="location" class="input-field" name="location" placeholder="Location" autocomplete="off">
    </div>
    <div>
        <label for="eventDate">Start Date:</label>
        <input type="date" id="eventDate" class="input-field" name="Startdate" value="" placeholder="Start Date">
        <label for="eventDate2">End Date:</label>
        <input type="date" id="eventDate2" class="input-field" name="Enddate"  value="" placeholder="EndDate">
    </div>
    <div>
        <label for="start_time">Start Time:</label>
        <input type="time" id="start_time" class="input-field" name="start_time" placeholder="Start Time" autocomplete="off">
        <label for="end_time">End Time:</label>
        <input type="time" id="end_time" class="input-field" name="end_time" placeholder="End Time" autocomplete="off">
    </div>
    <div>
        <label for="name">Name:</label>
        <input type="text" id="name" class="input-field" name="attendeeName"  placeholder="Attendees Name">
        <label for="email">Email:</label>
        <input type="text" id="email" class="input-field" name="attendeeEmail" placeholder="Attendees Email">
    </div>
    <div>
        <label for="description">Description:</label>
        <input type="text" id="description" class="input-field" name="description" placeholder="Event Description" autocomplete="off">
    </div>
    <button type="submit" id="add" class="btn btn" name="add">Add</button>
    <button type="submit" id="update" class="btn btn" name="update">Update</button>
</form>

    </div>
</div>
<!-- The Modal -->
<div id="displayEvent" class="modal">
  <!-- Modal content -->
  <div class="modal-content" id="eventDisplay">
    <!-- Modal header -->
    <span class="close" id="myBtn">&times;</span>
    <div class="modal-header">
      <h2>Events for Selected Date</h2>
    </div>
    <!-- Modal body -->
    <div id="modal-body" class="modal-body"></div>
  </div>
</div>
      <li>
        <a href="notification1.php">
          <i class='bx bx-bell'></i>
          <span class="links_name">Notification</span>
        </a>
        <span class="tooltip">Notification</span>
      </li>
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
        <div id="settingModalContent" class="modal-content">
        <span class="close" style=" margin-left: 97%;margin-top: 1%;">&times;</span>
        <h2>Settings  <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-gear" viewBox="0 0 16 16">
  <path d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492M5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0"/>
  <path d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291A1.873 1.873 0 0 0 1.945 8.93l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094A1.873 1.873 0 0 0 3.06 4.377l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.292.159a1.873 1.873 0 0 0 2.692-1.115z"/>
</svg></h2>
          <br>
          <h5 class="mb-4 text-2xl text-green-700 font-bold">Change Theme</h5>
          <div class="radio-group">
          <label class="radio-label"><input type="radio" name="theme" value="sky"> <span class="custom-radio"></span>Sky</label>
          <label class="radio-label"><input type="radio" name="theme" value="pink"> <span class="custom-radio"></span>Univers</label>
          <label class="radio-label"><input type="radio" name="theme" value="blue"> <span class="custom-radio"></span>Moon</label>
          </div>
          <br>
          <div>
            <a href="edit_profile.php">
              <button>Edit Profile  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
  <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
  <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
</svg></button></a>
          </div>
          <br>
          <!-- Save button to apply settings -->
          <button id="saveBtn" style="display:none;"></button>
        </div>
      </div>
    </ul>
  </div>      
  
  <section class="home-section">
    <div class="calendar-container" id="calendarContainer">
      <div class="year" id="yearlyCalendar"></div>

      <!-- Calendar content will be loaded here dynamically -->
    </div>

  </section>
  
   <script src="calenderrender.js"></script>
   <script>
    
// Get the modal
var modal = document.getElementById("createEventModal");

// Get the button that opens the modal
var btn = document.getElementById("eventbtn");

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
    modal1.style.display = "none";
  }
}
  </script>
  
  <script>
    // generateDayView()
    function generateDayView() {
      var html = '<table id="dayCalendar">';
      html += '<thead>';
      html += '<tr>';
      // Current date
      var currentDate = new Date();
      var options = { weekday: 'long', day: 'numeric' };
      html += '<th class="time-column" id="currentDate">' + currentDate.toLocaleDateString('en-US', options) + '</th>';
      html += '<th colspan="4">Today</th>'; // Adjust the colspan according to the number of time slots
      html += '</tr>';
      html += '</thead>';
      html += '<tbody>';

      // Define hours
      var hours = [
        '1 AM', '2 AM', '3 AM', '4 AM',
        '5 AM', '6 AM', '7 AM', '8 AM',
        '9 AM', '10 AM', '11 AM', '12 PM',
        '1 PM', '2 PM', '3 PM', '4 PM',
        '5 PM', '6 PM', '7 PM', '8 PM',
        '9 PM', '10 PM', '11 PM', '12 AM'
      ];

      // Create rows for each hour
      hours.forEach(function (hour) {
        html += '<tr>';
        html += "<td class='time-column'>" + hour + "</td>";
        html += "<td colspan='4'></td>"; // Adjust the colspan according to the number of time slots
        html += '</tr>';
      });

      // Close the table structure
      html += '</tbody>';
      html += '</table>';

      // Return the generated HTML
      return html;
    }
    //Theme Change
    document.addEventListener('DOMContentLoaded', function () {
  const checkbox = document.getElementById('checkbox');
  const sectionToChange = document.querySelector('.home-section');

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
            document.querySelector('.home-section').setAttribute('data-theme', value);
            document.querySelector('.home-section').classList.add('in-transition');
            window.setTimeout(function() {
                document.querySelector('.home-section').classList.remove('in-transition');
            }, 1000);
        }
    });
});

  

});

  </script>
  <script>
    // Get the modal
// Get the modal
var modal = document.getElementById("displayEvent");

// Get the close button inside the modal
var closeBtn = document.querySelector("#myBtn");


// When the user clicks on the close button, close the modal
closeBtn.onclick = function() {
  modal.style.display = "none";
};

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
};

  </script>
  
  <!-- <script>
        // Get the modal
        var modal = document.getElementById("updateModal");

        // Function to open the modal
        function openModal() {
            modal.style.display = "block";
        }

        // Function to close the modal
        function closeModal() {
            modal.style.display = "none";
        }

        // Close the modal when clicking outside of it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
  </script> -->
<!-- <script>
const closeButton = document.querySelector("#animal .close");
closeButton.addEventListener("click", closeModal);

// Event listener for clicking outside the modal
window.addEventListener("click", function(event) {
    const animalModal = document.getElementById("animal");
    if (event.target == animalModal) {
        closeModal();
    }
});

// Function to close the modal
function closeModal() {
    const animalModal = document.getElementById("animal");
    animalModal.style.display = "none";
}

// Function to open the modal with the clicked date or blank input field
function openAnimalModal(date = '') {
    const animalModal = document.getElementById("animal");
    const eventDateInput = document.getElementById("eventDate");

    // Set the input field value to the clicked date
    eventDateInput.value = date;

    // Display the modal
    animalModal.style.display = "block";
}

// Event listener for clicking on a date
document.addEventListener("click", function(event) {
    if (event.target.classList.contains("day")) {
        const date = event.target.dataset.date;
        openAnimalModal(date);
    }
});

// Event listener for form submission
const eventForm = document.getElementById("eventForm");
eventForm.addEventListener("submit", function(event) {
    event.preventDefault(); // Prevent default form submission

    // Create FormData object from the form
    const formData = new FormData(eventForm);

    // Make AJAX request to add the event
    fetch("createEventdb.php", {
            method: "POST",
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Close modal after successful addition
                closeModal();

                // Update UI with added event
                const eventData = data.event;
                const dateKey = eventData.date;
                const dayElement = document.querySelector(`.day[data-date="${dateKey}"]`);
                if (dayElement) {
                    dayElement.innerHTML += `<br><span class="tooltiptext">${eventData.title}</span>`;
                    dayElement.classList.add("green");
                }
            } else {
                console.error("Error:", data.message);
                // Handle error, display error message to user, etc.
            }
        })
        .catch(error => {
            console.error("Error:", error);
            // Handle network error or other exceptions
        });
});
</script> -->
  <script src="Script.js"></script>

  <script src="sidebar.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
    crossorigin="anonymous"></script>

</body>

</html>
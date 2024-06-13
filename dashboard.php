
<?php
include 'dbconn.php';
session_start();
?>

<?php
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
$sql = "SELECT fullname, email FROM registeration_form WHERE email = '$email'";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $userName = $row['fullname']; // User's name retrieved from the database
    $Email = $row['email']; // User's email retrieved from the database
  
} else {
    $userName = "Unknown"; // Default value if user's name is not found
    $Email = "Unknown" ;// Default value if user's email is not found
 


}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard</title>
 <!-- Bootstrap CSS -->
 <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<!-- Bootstrap JS bundle -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


<!-- Bootstrap JS bundle -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

  <!-- Boxicons CDN Link -->
  <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<link rel="stylesheet" href="styles1.css">
  <link rel="stylesheet" href="style1.css">
  <link rel="stylesheet" href="navbar.css">
<link rel="stylesheet" href="dashboard.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark fixed-top ">
    <a class="navbar-brand">Calendar </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto"> 
      </ul>
      <span style=" margin-right: 250px;font-weight: bold;" id="yearContainer" class="year-container"></span>
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
      
      <a href="edit_profile.php">Edit profile   <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
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
      <!-- <li id="eventbtn">
      <a href="#"data-toggle="modal" data-target="#createEventModal" onclick="openAnimalModal()">        <a href="#">
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
</div> -->
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
      <li>
        <a href="notification1.php">
          <i class='bx bx-bell'></i>
          <span class="links_name">Notification</span>
        </a>
        <span class="tooltip">Notification</span>
      </li> -->
      <!-- Trigger button for opening modal
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
          <span class="close" style="margin-inline: 95%;">&times;</span>
            <h3>Settings <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-gear" viewBox="0 0 16 16">
    <path d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492M5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0"/>
    <path d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291A1.873 1.873 0 0 0 1.945 8.93l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094A1.873 1.873 0 0 0 3.06 4.377l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.292.159a1.873 1.873 0 0 0 2.692-1.115z"/>
  </svg></h3>
          <br>
          <h5 class="mb-4 text-2xl text-green-700 font-bold">Chnage Theme</h5>
          <div class="radio-group">
          <label class="radio-label"><input type="radio" name="theme" value="sky"> <span class="custom-radio"></span>Sky</label>
          <label class="radio-label"><input type="radio" name="theme" value="pink"> <span class="custom-radio"></span>Univers</label>
          <label class="radio-label"><input type="radio" name="theme" value="blue"> <span class="custom-radio"></span>Moon</label>
          </div>
          <br>
          <div>
            <a href="edit_profile.php">
              <button>Edit Profile <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
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
    </ul>
  </div>
  <section class="home-section1">
<div class="container">
    <div class="user-info">
    <img src="<?php echo $profilePic; ?>" alt="Profile Picture">
        <h2><?php echo $userName; ?></h2>
        <p><?php echo $Email; ?></p>
    </div>
    <div class="grid-container">
        <div class="grid-item1">
        <button class="btn" onclick="openTodoModal1()" style="color:black;text-decoration:none;margin-left: -11px;">Create Calendar <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-file-plus" viewBox="0 0 16 16">
  <path d="M8.5 6a.5.5 0 0 0-1 0v1.5H6a.5.5 0 0 0 0 1h1.5V10a.5.5 0 0 0 1 0V8.5H10a.5.5 0 0 0 0-1H8.5z"/>
  <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2zm10-1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1"/>
</svg></button>
        <!-- Modal for entering calendar name -->
        <div class="modal" id="createcalendarModal">
          <div class="modal-content">
            <form action="createCalendardb.php" method="POST">
            <span class="close" onclick="closeTodoModal1()">&times;</span>
            CalendarName:
            <input type="text" id="calendarName" name="calendarname" placeholder="Enter calendar name" autocomplete="off"><br>
            <button id="confirmBtn" name="create" onclick="createCalendar()" class="button-31" role="button">Create</button>
          
            </form>
          </div>

</div>

</div>
<button class="btn lists" id="listButton">Lists <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-list-task" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M2 2.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5V3a.5.5 0 0 0-.5-.5zM3 3H2v1h1z"/>
  <path d="M5 3.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5M5.5 7a.5.5 0 0 0 0 1h9a.5.5 0 0 0 0-1zm0 4a.5.5 0 0 0 0 1h9a.5.5 0 0 0 0-1z"/>
  <path fill-rule="evenodd" d="M1.5 7a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H2a.5.5 0 0 1-.5-.5zM2 7h1v1H2zm0 3.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zm1 .5H2v1h1z"/>
</svg></button>
<div id="listOptions" style="display: none;">
  <div class="grid-item2">
      <button class="btn"><a href="list_calendar.php" style="color:black;text-decoration:none;margin-left: -12px;">List Calendar</a></button>
  </div>
  <div class="grid-item3">
      <button class="btn"><a href="list_events.php" style="color:black;text-decoration:none;margin-left: -5px;">List Events</a></button>
  </div>
    <div class="grid-item4">
        <button class="btn"><a href="list_group.php" style="color:black;text-decoration:none;margin-left: -14px;">List Group Calendar</a></button>
    </div>
</div>

    </div>
</div>
</section>
<div id="todoModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeTodoModal()">&times;</span>
        <h2>To-Do List</h2>
        <div class="task-form">
            <input type="text" id="taskName" placeholder="Enter task name...">
            <input type="datetime-local" id="taskDateTime">
            <button onclick="addTask()">Add Task</button>
        </div>
    </div>
</div>

<!-- <script>
function openTodoModal() {
    document.getElementById('todoModal').style.display = 'block';
}

function closeTodoModal() {
    document.getElementById('todoModal').style.display = 'none';
}

function addTask() {
    var taskName = document.getElementById('taskName').value;
    var taskDateTime = document.getElementById('taskDateTime').value;

    // Code to add task to list and display goes here
    console.log("Task Name:", taskName);
    console.log("Task Date & Time:", taskDateTime);

    // Clear input fields
    document.getElementById('taskName').value = '';
    document.getElementById('taskDateTime').value = '';

    // Close modal after adding task
    closeTodoModal();
}
</script> -->

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
  var theme = document.getElementById("theme").value; // Assuming you have an element with id "theme" for theme selection

  // Code to save settings goes here
  console.log("Language:", language);
  console.log("Theme:", theme);
  
  // Disable the save button after it's clicked
  saveBtn.disabled = true;
  
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
    //createcalendar Modal
  function openTodoModal1() {
    document.getElementById('createcalendarModal').style.display = 'block';
  }
  function closeTodoModal1() {
    document.getElementById('createcalendarModal').style.display = 'none';
  }
  

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
  <script>
    document.getElementById('listButton').addEventListener('click', function() {
  var listOptions = document.getElementById('listOptions');
  if (listOptions.style.display === "none") {
    listOptions.style.display = "block";
  } else {
    listOptions.style.display = "none";
  }
});

document.querySelectorAll('#listOptions .btn').forEach(item => {
  item.addEventListener('click', event => {
    // Redirect to the specific page
    window.location.href = event.target.querySelector('a').href;
  });
});

  </script>
<script src="sidebar.js"></script>
</body>
</html>

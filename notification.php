<?php
include 'dbconn.php';
session_start();
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
if (isset($_POST['email'])) {
  $email = $_POST['email'];
  $sql = "DELETE FROM created_event_details WHERE email = '$email'";
  $result = mysqli_query($conn, $sql);
  if ($result) {
      ?>
      <script>alert(sucess);</script>
      <?php
  } else {
      echo 'error';
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendar Notifications</title>
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

    <style>
        body {
            font-family:"Open Sans";
            margin: 0;
            padding: 90px;
            text-align: center;
        }
        .notification {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 10px;
        }
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

.modal-content {
  background-color: #fefefe;
  margin: auto;
  padding: 20px;
  border: 1px solid #888;
  width: 80%;
  max-width: 419px;
  border-radius: 10px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
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
input a{
  width:10px;
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
.btn i{
  background: red;  
  width: 45px;
    height: 30px;
    font-size: 18px;
    justify-content: center;
    font-weight: bold;
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
  
    </style>
      <!-- <link rel="stylesheet" href="styles1.css"> -->
  <link rel="stylesheet" href="style1.css">
  <link rel="stylesheet" href="navbar.css">
<link rel="stylesheet" href="notification.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">


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
      
      <a href="edit_profile.php">Edit profile</a>
        <a href="logout.php">Logout</a>
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
      <li>
        <a href="#">
          <i class='bx bx-pie-chart-alt-2'></i>
          <span class="links_name"> Events Analytics</span>
        </a>
        <span class="tooltip">Events Analytics</span>
      </li>
      <li>
        <a href="#">
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
        <div class="modal-content">
          <span class="close">&times;</span>
          <h3>Settings</h3>
          <br>
          <h5 class="mb-4 text-2xl text-green-700 font-bold">chnage theme</h5>
          <div class="radio-group">
          <label class="radio-label"><input type="radio" name="theme" value="sky"> <span class="custom-radio"></span>Sky</label>
          <label class="radio-label"><input type="radio" name="theme" value="pink"> <span class="custom-radio"></span>Univers</label>
          <label class="radio-label"><input type="radio" name="theme" value="blue"> <span class="custom-radio"></span>Moon</label>
          </div>
          <br>
          <div>
            <a href="edit_profile.php">
              <button>Edit Profile</button></a>
          </div>
          <br>
          <!-- Save button to apply settings -->
          <button id="saveBtn">Save</button>
        </div>
      </div>
    </ul>
  </div>      
    </ul>
  </div>
  <section class="home-section1">
  <form action="#" method="POST">
  <h1>Calendar Notifications</h1>
  <?php 
                       
                       $register = "SELECT * FROM created_event_details WHERE email = '$email'";
                       $register_run=mysqli_query($conn,$register);
                       if (mysqli_num_rows($register_run)> 0) 
                       {
  
                           ?>   
<table id="example" class="display" style="width:100%">
    <thead>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Discription</th>
            <th>Date</th>
            <th>Start_time</th>
            <th>End_time</th>
            <th>Guest</th>
            <th>Location</th>
            <th>Delete</th>
          
        </tr>
    </thead>
    <tbody>
    <?php
     $counter = 1;
    while($reg_row = mysqli_fetch_array($register_run))
    {
    ?>
                                  
        <tr>
        <td><?php echo $counter; ?></td>
        <?php  $counter++; ?>
       <!-- <th><?php echo $_SESSION['status']; ?></th> -->
            <td><?php echo $reg_row['title']; ?></td>
            <td><?php echo $reg_row['description']; ?></td>
            <td><?php echo $reg_row['date']; ?></td>
            <td><?php echo $reg_row['start_time']; ?></td>
            <td><?php echo $reg_row['end_time']; ?></td>
            <td><?php echo $reg_row['guest']; ?></td>
            <td><?php echo $reg_row['location']; ?></td>

        <td>
            <input type="hidden" class="delete_id_value" value="<?php echo $reg_row['email']; ?>">
            <a href="javascript:void(0)"  class="delete_btn_ajex "><i name="clear" class='bx bx-x '></i></a>
</td>                    
        </tr>
       
        <?php } ?>
    </tbody>
</table>
<?php
                        }else{
                            echo "No notification";
                           
                        }
                        ?>
                 
                          </form>

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

<script>
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
</script>
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
    </section>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#example').DataTable();
    });
</script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
    crossorigin="anonymous"></script>
<script src="sidebar.js"></script>
    
</body>
</html>

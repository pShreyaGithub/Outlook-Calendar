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

// Check if user is logged in
if(!isset($_SESSION['email'])){
    header('location: index.php');
    exit; 
}

// Retrieve user's name from the database
$email = $_SESSION['email'];
$sql = "SELECT fullname FROM registeration_form WHERE email = '$email'";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $userName = $row['fullname'];
} else {
    $userName = "Unknown";

}
date_default_timezone_set('Asia/Kolkata');

// Determine the current hour
$hour = date("H");

// Initialize greeting variable
$greeting = "";

// Determine greeting based on current hour in Indian time
if ($hour < 4) {
    $greeting = "Good Night";
} elseif ($hour < 12) {
    $greeting = "Good Morning";
} elseif ($hour < 17) {
    $greeting = "Good Afternoon";
} elseif ($hour < 20) {
    $greeting = "Good Evening";
} else {
    $greeting = "Good Night";
}

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="UTF-8">
  <title>Group Calendar</title>
  <!-- Bootstrap CSS -->
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
  <link rel="stylesheet" href="groupcalendar.css">
<!-- <link rel="stylesheet" href="navbar.css"> -->

  <!-- Custom CSS -->
  <style>
     body {
      font-family: 'Open Sans', sans-serif;
      box-sizing: border-box;
    }
    .group-container {
  margin-bottom: 20px; /* Adjust margin as needed */
  left:1%;
}

@media (min-width: 768px) {
  .group-container {
    flex: 0 0 25%; /* Each group container takes 25% width on medium devices */
  }
}
@media (min-width: 768px)
.col-md-3 {
    -ms-flex: 0 0 25%;
    flex: 0 0 25%;
    max-width: 25%;
}
  .group-header {
    background-color: #A27B5C;
    color: white;
    padding: 10px;
    border-radius: 5px 5px 0 0;
  }

  .group-body {
    padding: 20px;
    border: 1px solid #ccc;
    border-top: none;
    border-radius: 0 0 5px 5px;
    background: #f8eeee;
  }

  .add-member-section {
    text-align: center;
  }

  /* Custom color for the Add Member button */
  .add-member-btn {
    background-color: #28a745;
    /* Green color */
    border-color: #28a745;
    /* Green color */
  }

  /* Style for label */
  .add-member-label {
    color: #28a745;
    /* Green color */
    font-weight: bold;
  }

  /* Custom color for the Add Member button after clicked */
  .add-member-btn.clicked {
    background-color: #dc3545;
    /* Red color */
    border-color: #dc3545;
    /* Red color */
  }
 .close {
    color: #000000;
    float: right;
    font-size: 28px;
    font-weight: bold;
    margin-right: 34px;
    margin-inline: 94%;
}
.close:hover,
.close:focus {
color: black;
text-decoration: none;
cursor: pointer;
}
   h6 {
    margin-inline: 35px;
    margin-top: 8px;
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
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: white;
    transition: .4s;
    border-radius: 30px;
    width: 100%;
    height: 100%;
}

.checkbox-wrapper-54 .slider:before {
  position: absolute;
    content: "";
    height: var(--size-of-icon, 1.4em);
    width: var(--size-of-icon, 1.4em);
    border-radius: 20px;
    left: var(--slider-offset, 0.3em);
    top: 50%;
    transform: translateY(-50%);
    background: linear-gradient(40deg, #ff0080, #ff8c00 70%);
    transition: .4s;
    width: 30%;
    height: 50%;
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
    /* left: calc(100% -(var(--size-of-icon, 1.4em) + var(--slider-offset, 0.3em))); */
    background: #303136;
    box-shadow: inset -3px -2px 5px -2px #8983f7, inset -10px -4px 0 0 #a3dafb;
    margin-block: -7px;
    left: 32px;
    top: 69%;
}
 /* #member{
  background-color: #fefefe;
    margin: auto;
    padding: 20px;
    border: 1px solid #888;
    width: 88%;
    max-width: 403px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    top: 293px;
    text-align: justify;
    right: 30%;
 } */
  </style>

  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-dark fixed-top ">
  <a class="navbar-brand">Calendar </a>
   
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
      </ul>
      <span style=" margin-right: 250px;font-weight: bold;" id="yearContainer" class="year-container"></span>
      <h6>Welcome, <?php echo $userName; ?> </h6>
      <br>
      <!-- Theme -->
   
     
</div>
      <div class="profile-container">
      <img src="<?php echo $profilePic; ?>" alt="Profile Picture" width="42px" height="42px">
        <!-- Profile dropdown -->
        <div class="profile-dropdown">
          <a href="logout.php">Logout <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0z"/>
  <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z"/>
</svg></a>
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
          <!-- Modal HTML -->
      <div id="settingModal" class="modal">
        <div class="modal-content">
        <span class="close" style=" margin-left: 93%;margin-top: 1%;">&times;</span>
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

  <section class="home-section1">
    <div id="createGroupContainer" class="container">
    <?php echo "<h1>$greeting, $userName!</h1>"; ?>
      <button type="button" class="btn btn buttons" id="createGroupBtn">
        Create Group
      </button>
    </div>

    <div id="groupDisplay" class="row">
      <!-- Group display will be populated dynamically -->
    </div>
  </section>

  <!-- Create Group Modal -->
  <form method="post" action="gdb.php">
  <div class="modal" id="createGroupModal">
    <div class="modal-dialog">
      <div class="modal-content" style="left: 84%;margin-top: 46%;">
        <div class="modal-header">
          <h5 class="modal-title">Create Group</h5>
          <button type="button" class="close" id="closeCreateModal" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <input type="text" name="groupNameInput" id="groupNameInput" class="form-control" placeholder="Group Name"><br>
          <input type="text" name="groupDescriptionInput" id="groupDescriptionInput" class="form-control" placeholder="Group Description"><br>
          <div id="membersContainer">
            <input type="text" class="form-control member-input" name="memberNameInput[]" placeholder="Member Name">
          </div>
          <button type="button" id="addMemberBtn" class="btn btn-secondary mt-2">+</button>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Discard</button>
          <button type="submit" name="create" id="createBtn" class="btn btn-primary">Create</button>
        </div>
      </div>
    </div>
  </div>
</form>
<?php

// SQL query to fetch groups and their members
$sql = "SELECT cg.group_id, cg.group_name, cg.group_description, gm.member_name
        FROM created_group_calendars cg
        LEFT JOIN group_members gm ON cg.group_id = gm.group_id
        ORDER BY cg.group_name";

$result = $conn->query($sql);

// Array to store group details
$groups = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $group_id = $row["group_id"];
        // If group does not exist in array, create a new entry
        if (!isset($groups[$group_id])) {
            $groups[$group_id] = array(
                "group_name" => $row["group_name"],
                "group_description" => $row["group_description"],
                "members" => array()
            );
        }
        // Add member to the group
        if (!empty($row["member_name"])) {
            $groups[$group_id]["members"][] = $row["member_name"];
        }
    }
}

// Container to display groups
echo '<div class="container1" style="margin-top: -3%;    margin-left: 6%;">';

// Counter to keep track of the number of groups
$group_count = 0;

// Display group names and create modals
foreach ($groups as $group_id => $group) {
    // If it's the start of a new row, open a new row div
    if ($group_count % 4 == 0) {
        echo '<div class="row" style="margin-top: 20px;">'; // Start a new row
    }

    // Group container with appropriate size
    echo '<div class="col-md-3" >';
    // Start a new container for each group
    echo '<div class="group-container" >';

    // Group name
    echo '<div class="group-names" style="background-color: #A27B5C; color: white;padding-bottom: 1%;border: 1px solid black;width: 90%;">';
    echo '<h6 style="width: 81%;    margin-left: 1.2%;">Group Name: ' . $group["group_name"] . '</h6>';
    echo '<button class="view-btn" data-toggle="modal" style="margin-left: 82%; position: relative; margin-bottom: 1%;display: flex;margin-top: -9%; background-color: #A27B5C;" data-target="#groupModal' . $group_id . '"><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-card-checklist" viewBox="0 0 16 16">
    <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2z"/>
    <path d="M7 5.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0M7 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 0 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0"/>
  </svg></button>';

    echo '</div>';

    // Close the group container
    echo '</div>';
    echo '</div>'; // Close the column

    // If it's the end of a row, close the row div
    if (($group_count + 1) % 4 == 0 || $group_count == count($groups) - 1) {
        echo '</div>'; // Close the row
    }

    // Modal for displaying group details and members
    echo '<div class="modal fade" id="groupModal' . $group_id . '" tabindex="-1" role="dialog" aria-labelledby="groupModalLabel' . $group_id . '" aria-hidden="true">';
    echo '<div class="modal-dialog" role="document">';
    echo '<div class="modal-content">';
    echo '<div class="modal-header">';
    echo '<h5 class="modal-title" id="groupModalLabel' . $group_id . '">Group Details</h5>';
    echo '<button type="button" class="close" data-dismiss="modal" aria-label="Close">';
    echo '<span aria-hidden="true">&times;</span>';
    echo '</button>';
    echo '</div>';
    echo '<div class="modal-body">';
    echo '<h4>Group Name: ' . $group["group_name"] . '</h4>';
    echo '<h4>Group Description:</h4>';
    echo '<p>' . $group["group_description"] . '</p>';
    echo '<h4>Group Members:</h4>';
    echo '<ul>';
    foreach ($group["members"] as $member) {
        echo '<li>' . $member . '</li>';
    }
    echo '</ul>';
    echo '</div>';
    echo '<div class="modal-footer">';
    echo '<button type="button" class="btn btn-danger">Delete</button>';
    echo '<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
    echo '</div>';

    $group_count++;
}

echo '</div>'; // Close the container div

$conn->close();
?>




  <!-- JavaScript -->
  <!-- JavaScript -->
<script>
$(document).ready(function() {
  // Open Create Group Modal
  $('#createGroupBtn').on('click', function() {
    $('#createGroupModal').modal('show');
  });

  // Close Create Group Modal
  $('#myBtn').on('click', function() {
    $('#createGroupModal').modal('hide');
  });

  // Submit the form when Create button is clicked
  $('#createBtn').click(function() {
    $('form').submit();
  });
});

</script>


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
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
<script>
  $(document).ready(function() {
    // Add member input field
    $('#addMemberBtn').click(function() {
      $('#membersContainer').append('<input type="text" class="form-control member-input" name="memberNameInput[]" placeholder="Member Name">');
    });
  });
</script>
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

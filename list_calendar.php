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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>list calendar</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
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
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
     <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    
  <!-- Boxicons CDN Link -->
  <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="style1.css">
  <link rel="stylesheet" href="navbar.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- calendar Link -->
  <!-- <link rel="stylesheet" href="caldeepak.css"> -->
  <link id="custom-css" rel="stylesheet" type="text/css" href="caldeepak.css">
<style>
  @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');
*{
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family:"Open Sans";
}
     body{
      /* background-image: url(bg.jpg); */
      margin-top:75px;
      width: 1500px;
        margin-left:10px;
    }
    .home-section1 {
      position: relative;
    background: #E4E9F7;
    min-height: 35vh;
    top: 0;
    left: 20%;
    width: 70%;
    padding: 20px;
    padding-top: 1px;
    padding-bottom: 1px;
}
.dataTables_wrapper .dataTables_paginate .paginate_button {
    box-sizing: border-box;
    display: inline-block;
    min-width: 1.5em;
    padding: -0.5em 1em;
    margin-left: 2px;
    text-align: center;
    text-decoration: none !important;
    cursor: pointer;
    color: #333 !important;
    border: 1px solid transparent;
    border-radius: 2px;
    font-size: 12px;
}
.dataTables_wrapper .dataTables_paginate .paginate_button.disabled, .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:hover, .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:active {
    cursor: default;
    color: #666 !important;
    border: 1px solid transparent;
    background: transparent;
    box-shadow: none;
    font-size: 16px;
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
      margin-left:956px;
    }
    
.home-section1[data-theme="sky"] {
  background-image: url(bg.jpg);
  background-repeat: no-repeat;
  background-size: cover;
  color: black;
  }
.home-section1[data-theme="pink"] {
  background-image: url(bg2.jpg);
  background-repeat: no-repeat;
  background-size: cover;
  color: black;
}


.home-section1[data-theme="blue"] {
  background-image: url(bg3.jpg);
  background-repeat: no-repeat;
  background-size: cover;
  color: black;
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
    top: 320px;
    right: 66%;
    position: fixed;
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

@media (max-width: 768px) {
    .container1 {
        width: 80%;
    }

    .theme-switch-wrapper {
        margin-right: 5px;
    }

    .theme-switch {
        width: 40px;
    }

    .slider {
        height: 18px;
    }

    .slider:before {
        width: 10px;
        height: 10px;
        bottom: 3px;
        left: 3px;
    }

    .radio-group input[type="radio"] {
        transform: scale(0.7);
    }

    .modal-content {
        width: 90%;
    }
}

@media (max-width: 576px) {
    .container1 {
        width: 95%;
    }

    .theme-switch {
        width: 30px;
    }

    .slider {
        height: 16px;
    }

    .slider:before {
        width: 8px;
        height: 8px;
        bottom: 2px;
        left: 2px;
    }

    .radio-group input[type="radio"] {
        transform: scale(0.6);
    }

    .modal-content {
        width: 95%;
    }
}
.button-31 {
    background-color: #222;
    border-radius: 4px;
    border-style: none;
    box-sizing: border-box;
    color: #fff;
    cursor: pointer;
    display: inline-block;
    font-family: "Farfetch Basis", "Helvetica Neue", Arial, sans-serif;
    font-size: 16px;
    font-weight: 700;
    line-height: 1.5;
    margin: 0;
    max-width: 100px;
    min-height: 44px;
    min-width: 10px;
    outline: none;
    overflow: hidden;
    padding: 9px 20px 8px;
    position: relative;
    text-align: center;
    text-transform: none;
    user-select: none;
    -webkit-user-select: none;
    touch-action: manipulation;
    width: 100%;
    margin-left: 116px;
    margin-top: 25px;
  }
  
  .button-31:hover,
  .button-31:focus {
    opacity: .75;
  }
  .canme{
    text-decoration:none;
    color:black;
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
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <h6>Welcome, <?php echo $userName; ?> </h6>

      <ul class="navbar-nav mr-auto">

      </ul>
</div>

      <div class="profile-container">
      <img src="<?php echo $profilePic; ?>" alt="Profile Picture" width="42px" height="42px">
          <div class="profile-dropdown">
          <a href="logout.php">Logout <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0z"/>
  <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z"/>
</svg></a>
          </div>
    </ul>
    
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
     
      <li>
        <a href="notification1.php">
          <i class='bx bx-bell'></i>
          <span class="links_name">Notification</span>
        </a>
        <span class="tooltip">Notification</span>
      </li>
      <!-- Trigger button for opening modal -->
      

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

  <section class="home-section1">
    <h3 style="margin-left:37%;  font-weight: bold;">List Calendar</h3>
  <form action="#" method="POST">

  <?php 
                       $register = "SELECT * FROM created_calendar_details WHERE email='$email' ";
                       $register_run=mysqli_query($conn,$register);
                       if (mysqli_num_rows($register_run)> 0) 
                       {
                           ?>   
<table id="example" class="display" style="width:100%">
    <thead>
        <tr>
            <th>ID</th>
            <th><center>CalendarName</center></th>
            <th><center>Action</center></th>
          
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
      
            <td ><a href="events.php?id=<?php echo $reg_row['id']; ?>" class="canme"><?php echo $reg_row['calendarName']; ?></a></td>
            <td style="display:flex; gap:45%; margin-inline: 35%;">
<!-- Inside the while loop -->
          <a href="#" onclick="openUpdateModal('<?php echo $reg_row['id']; ?>', '<?php echo $reg_row['calendarName']; ?>')" ><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
  <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
  <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
</svg>
</a>
          
        <form action="#" method="POST">
    <input type="hidden" class="delete_id_value" name="delete_id" value="<?php echo $reg_row['id']; ?>">
    <button type="submit" class="delete_btn_ajex " name="register_delete_btn"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
  <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5"/>
</svg></button>
</form>
</td>                    
        </tr>
       
        <?php } ?>
       

                  </tbody>
              </table>
              <?php
    }else{
                            echo "Empty";
                           
                        }
                        ?>



<!-- Update Modal -->
<div id="updateModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeUpdateModal()">&times;</span>
        <h3 style="margin-top:-9%; margin-bottom: 10%;">Update Calendar</h3>
        <form action="#" id="updateForm" method="POST">
            <input type="hidden" name="id" id="updateId">
            <label for="calendarName">Calendar Name:</label>
            <input type="text" id="calendarName" name="calendarName" placeholder="Enter calendar name">
            <button type="submit" class="button-31" name="register_update_btn" style="margin-top: 5%;margin-inline: 30%;">Update</button>

          </form>


    </div>
</div>
 </form>
  </section>
            <?php
          if(isset($_POST['register_update_btn'])) {
            $id = $_POST['id'];
            $calendarName = $_POST['calendarName'];

            $update_sql = "UPDATE created_calendar_details SET calendarName='$calendarName' WHERE id='$id'";
            if(mysqli_query($conn, $update_sql)) {
                ?>
            <script>
              alert("Calendar Updated Successfully");
                location.replace("list_calendar.php");
            </script>
                <?php
            } else {
                echo "Error updating calendar: " . mysqli_error($conn);
            }
          } 
                    ?>
                    <?php
if(isset($_POST['register_delete_btn'])) {
    $delete_id = $_POST['delete_id'];

    // Perform the deletion query
    $query_delete = "DELETE FROM created_calendar_details WHERE id='$delete_id'";
    $delete_query_run = mysqli_query($conn, $query_delete);

    // Check if the deletion was successful
    if($delete_query_run) {
        ?>
        <script>
            alert("Calendar Deleted Successfully");
            window.location.replace("list_calendar.php");
        </script>
        <?php
    } else {
        ?>
        <script>
            alert("Calendar Deletion Failed");
            window.location.replace("list_calendar.php");
        </script>
        <?php
    }
}
?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#example').DataTable();
    });
</script>

<script>
    function openUpdateModal(id, calendarName) {
        document.getElementById('updateId').value = id;
        document.getElementById('calendarName').value = calendarName;
        document.getElementById('updateModal').style.display = 'block';
    }

    function closeUpdateModal() {
        document.getElementById('updateModal').style.display = 'none';
    }
</script>

<!-- <script>
    function submitUpdateForm() {
        var id = document.getElementById('updateId').value;
        var calendarName = document.getElementById('calendarName').value;
        var formData = new FormData();
        formData.append('id', id);
        formData.append('calendarName', calendarName);

        fetch('update_calendar.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(result => {
            console.log(result);
            // You can add further handling here, such as showing a success message or refreshing the page
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }
</script> -->


<script>


    //Theme Change
    document.addEventListener("DOMContentLoaded", function() {
    var modal = document.getElementById("settingModal");
    var btn = document.getElementById("settingBtn");
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

    // Close modal after saving
    var saveButton = document.getElementById("saveButton");
    saveButton.onclick = function() {
        modal.style.display = "none";
    };
});



  </script>
   <script>
    //createcalendar Modal
  // Updated JavaScript function
function openTodoModal1(id) {
  document.getElementById('update_' + id).style.display = 'block';
}

  function closeTodoModal1() {
    document.getElementById('update').style.display = 'none';
  }
  

  </script>
   <script>
    // Function to handle storing calendarName in local storage
    function storeCalendarName(calendarName) {
        localStorage.setItem('calendarName', calendarName);
        console.log('Calendar name stored in local storage:', calendarName);
        let calander_name=localStorage.getItem('calendarName');
        console.log("the Calander_name",calander_name);
    }

    // Event listener for the "View" button clicks
    $(document).on('click', '.delete_btn_ajex', function() {
        // Get the calendarName from the button's data attribute
        var calendarName = $(this).closest('tr').find('td:eq(1)').text();
        // Call the function to store the calendarName in local storage
        console.log(storeCalendarName(calendarName));
        console.log("the stored Calander_name",calanderName);

    });

    // Function to fetch and display the stored calendarName
    function displayStoredCalendarName() {
        var storedCalendarName = localStorage.getItem('calendarName');
        if (storedCalendarName) {
            // Update the DOM element with id "storedCalendarName" to display the value
            document.getElementById('storedCalendarName').textContent = storedCalendarName;
            console.log('Displaying stored calendar name:', storedCalendarName);
            console.log("the Calander_name",storedCalendarName);
        } else {
            // Handle the case where the value is not found in localStorage
            console.error('Calendar name not found in localStorage.');
        }
    }

    // Call the displayStoredCalendarName function when the page loads
    document.addEventListener('DOMContentLoaded', function() {
        console.log('Page loaded');
        displayStoredCalendarName();
    });

    // Event listener for changes in localStorage
    window.addEventListener('storage', function(e) {
        console.log('Storage event triggered:', e);
        // Check if the changed key is 'calendarName'
        if (e.key === 'calendarName') {
            // Call the function to update the displayed value
            displayStoredCalendarName();
        }
    });
</script>
<script src="sidebar.js"></script>
<script>
    // Close the modal when clicking outside of it
    $(document).on('click', function(event) {
        if ($(event.target).closest('.modal').length === 0) {
            $('.modal').modal('hide');
        }
    });
</script>

<!-- <div>
    <p>Stored Calendar Name:</p>
    <p id="storedCalendarName"></p>
</div> -->
</body>
</html>


<!-- <?php
if(!isset($_SESSION['email'])){
  header( "Location: C:\k\xampp\htdocs\calendarnew\index.php" );
}
?> -->
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="UTF-8">
  <title> Calendar </title>
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
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

  <!-- Boxicons CDN Link -->
  <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="styles.css">
  <link rel="stylesheet" href="style.css">


  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- calendar Link -->
  <!-- <link rel="stylesheet" href="caldeepak.css"> -->
  <link id="custom-css" rel="stylesheet" type="text/css" href="caldeepak.css">
  <script src="calendar.js"></script>
  <style>
    .year {
      margin-top:58px;
    }

    .day:hover {
      background-color: #2b78e3ee;
      color: #fff;
    }

    /* Theme style*/
   .theme-switch-wrapper {
  display: flex;
  align-items: center;
  margin-right:10px;
}

.theme-switch {
  display: inline-block;
  height: 22px;
  position: relative;
  width: 50px;
}

.theme-switch input {
  display:none;
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

input:checked + .slider {
  background-color: #66bb6a;
}

input:checked + .slider:before {
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

/* Modal Styles */
.modal {
  display: none;
  position: fixed;
  z-index: 1;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  overflow: auto;
  background-color: rgba(0, 0, 0, 0.4);
}

.modal-content {
  background-color: #fefefe;
  margin: 10% auto;
  padding: 20px;
  border: 1px solid #888;
  width: 80%;
}

.close {
  color: #aaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
  margin-left:95%;
}

.close:hover,
.close:focus {
  color: black;
  text-decoration: none;
  cursor: pointer;
}



/* styles.css */

/* Pink Theme */
.home-section[data-theme="pink"] {
  /* background:  rgb(#1fa2ff, #12d8fa, #a6ffcb); */
  background: linear-gradient(#1fa2ff,  #12d8fa 23%, #a6ffcb 95%);

    color:black;
}

/* Blue Theme */
.home-section[data-theme="blue"] {
  background:rgb(168, 252, 165) ;
  color:black;
}

/* Yellow Theme */
.home-section[data-theme="yellow"] {
    background:  rgb(255, 51, 153);
    color:black;
}
/* Green Theme */
.home-section[data-theme="green"] {
    background: rgb(102, 0, 102);
    color:black;
}


/* Transition effect */
.in-transition {
    transition: background-color 1s;
}

  </style>


</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark fixed-top "
    style="background:linear-gradient(to bottom, #5f2c84 23%, #4b2958 95% );">
    <a class="navbar-brand" href="#">Calendar </a>
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
        <button onclick="showPreview()">preview</button>
        <button onclick="showNext()">next</button>
      </ul>
      <!-- Theme -->
      <div id="button" class="theme-switch-wrapper">
  <label class="theme-switch" for="checkbox">
    <input type="checkbox" id="checkbox" />
    <div class="slider round"></div>
    </div>
    
    <div class="profile-container">
      <img class="profile-image" src="user.png" alt="Profile Picture" width="42px" height="42px">
      <div class="profile-dropdown">
        <a href="#">Edit Profile</a>
        <a href="#">Settings</a>
        <a href="#">Logout</a>
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
        <a href="#">
          <i class='bx bx-grid-alt'></i>
          <span class="links_name">Dashboard</span>
        </a>
        <span class="tooltip">Dashboard</span>
      </li>
      <li>
        <a href="#">
          <i class='bx bx-hive'></i>
          <span class="links_name">Group Calendar</span>
        </a>
        <span class="tooltip">Group Calendar</span>
      </li>
      <li>
        <a href="#">
          <i class='bx bx-edit-alt'></i>
          <span class="links_name">Create Events </span>
        </a>
        <span class="tooltip">Create Events</span>
      </li>
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
    <h2>Settings</h2>
    <label for="language">Select Language:</label>
    <select id="language">
      <option value="en">English</option>
      <option value="fr">French</option>
      <!-- Add more language options as needed -->
    </select>
    <br>
    <h4 class="radio">Select Theme</h4>
    <input type="radio" name="theme" value="pink" > Pink 
    <input type="radio" name="theme" value="blue"> Blue
    <input type="radio" name="theme" value="yellow"> Yellow
    <input type="radio" name="theme" value="green"> Green
    

    <br>
    
    <!-- Save button to apply settings -->
    <button id="saveBtn">Save</button>
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

  <script src="script.js"></script>

  <script src="sidebar.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>

<!DOCTYPE html>
<!-- Created by CodingLab |www.youtube.com/CodingLabYT-->
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title> Calendar admin</title>
    <!-- Bootstrap Link  -->
    <link rel="stylesheet" href="admin_style.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <!-- <link rel="stylesheet" href="style.css"> -->
    <link rel="stylesheet" href="admin_changepass.css">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
<body>
  <nav class="navbar navbar-expand-lg navbar-dark fixed-top " style="background-color: #DCD7C9;">
      <a class="navbar-brand "style="color:black" href="admin_dashboard.php">Admin Panel </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto"> 
        </ul>
      </div> 
      
      <div class="profile-container">
        <img class="profile-image" src="img1.webp" alt="Profile Picture" width="42px" height="42px">
        <div class="profile-dropdown">
          
          <a href="logout_admin.php">Logout</a>
        </div>
      </div>

    </nav>
 
  <div class="sidebar">
    <div class="logo-details">
      <!-- <i class='bx bxl-c-plus-plus icon'></i> -->
        <div class="logo_name">Menubar</div>
        <i class='bx bx-calendar-alt' id="btn" ></i>
    </div>
    <ul class="nav-list">
      <li>
        <a href="http://localhost/new/admin/admin_dashboard.php">
          <i class='bx bx-grid-alt'></i>
          <span class="links_name">Dashboard</span>
        </a>
         <span class="tooltip">Dashboard</span>
      </li>
      <li>
       <a href="http://localhost/new/admin/create_admin.php">
         <i class='bx bx-male' ></i>
         <span class="links_name">Create Admin</span>
       </a>
       <span class="tooltip">Create Admin</span>
     </li>
      <li>
       <a href="http://localhost/new/admin/admin_user_permissions.php">
         <i class='bx bx-group' ></i>
         <span class="links_name">Create User</span>
       </a>
       <span class="tooltip">Create User</span>
     </li>
     <li>
       <a href="http://localhost/new/admin/calendar/main1.php">
         <i class='bx bx-calendar-week' ></i>
         <span class="links_name">Calendar View</span>
       </a>
       <span class="tooltip">Calendar View</span>
     </li>
     <li>
      <a href="http://localhost/new/admin/admin_changepass.php">
        <i class='bx bx-key' ></i>
        <span class="links_name">Change Password </span>
      </a>
      <span class="tooltip">Change Password </span>
    </li>
     <!-- <li>
       <a href="#">
         <i class='bx bx-bell' ></i>
         <span class="links_name">Notification</span>
       </a>
       <span class="tooltip">Notification</span>
     </li> -->
    <!-- <li>
      <a href="admin_how_to_use.php">
        <i class='bx bx-navigation' ></i>
        <span class="links_name"></span>
      </a>
      <span class="tooltip"></span>
    </li> -->
   
    </ul>
  </div>
    <section>

    </section> 
 
  <script href="script.js"></script>
  <script>
  let sidebar = document.querySelector(".sidebar");
  let closeBtn = document.querySelector("#btn");
  let searchBtn = document.querySelector(".bx-search");

  closeBtn.addEventListener("click", ()=>{
    sidebar.classList.toggle("open");
    menuBtnChange();//calling the function(optional)
  });

  searchBtn.addEventListener("click", ()=>{ // Sidebar open when you click on the search iocn
    sidebar.classList.toggle("open");
    menuBtnChange(); //calling the function(optional)
  });

  // following are the code to change sidebar button(optional)
  function menuBtnChange() {
   if(sidebar.classList.contains("open")){
     closeBtn.classList.replace("bx-menu", "bx-menu-alt-right");//replacing the iocns class
   }else {
     closeBtn.classList.replace("bx-menu-alt-right","bx-menu");//replacing the iocns class
   }
  }
  </script>
</body>
</html>
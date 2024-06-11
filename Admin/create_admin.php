
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Include DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/2.0.5/css/dataTables.dataTables.min.css">
    <link rel="stylesheet" href="admin_user.css">
    
    <title>admin Page</title>
    <style>
        /* Add your CSS styles here */
       /* Button Styles */
.button-container {
    margin-bottom: 20px;
}

.button1 {
    background-color: #4caf50;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    margin-right: 10px;
}

.button1:hover {
    background-color: #45a049;
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
    margin: auto;
    padding: 20px;
    border-radius: 10px;
    width: 60%;
    max-width: 400px;
    margin-top: 40px;
}

.close {
    color: #aaa;
    position: absolute;
    top: 10px;
    right: 10px;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
}

/* Form Styles */
form {
    margin-top: 20px;
}

label {
    display: inline-block;
    width: 30%;
    margin-bottom: 5px;
}

input[type="text"],
input[type="email"],
input[type="password"],
select {
    flex: 1;
    padding: 8px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}

/* Adjust padding for gender and password fields */
#userGender,
#userPassword {
    padding: 8px;
}

input[type="submit"] {
    background-color: #4caf50;
    color: white;
    padding: 15px 20px;
    border: none;
    border-radius: 10px;
    cursor: pointer;
    margin: 10px auto;
    display: block;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

input[type="submit"]:hover {
    background-color: #45a049;
}

    </style>
</head>
<body>
    <!-- Include Navbar -->
    <?php include 'admin_index.php'; ?>
    <!-- Main Content Section -->
    <section class="main-section">
        <div class="first_user">
            <div class="container1">
                <div class="user button-container">
                    <h3>Admin List</h3>
                    <button class="button1" id="createUserBtn"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill-gear" viewBox="0 0 16 16">
  <path d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0m-9 8c0 1 1 1 1 1h5.256A4.5 4.5 0 0 1 8 12.5a4.5 4.5 0 0 1 1.544-3.393Q8.844 9.002 8 9c-5 0-6 3-6 4m9.886-3.54c.18-.613 1.048-.613 1.229 0l.043.148a.64.64 0 0 0 .921.382l.136-.074c.561-.306 1.175.308.87.869l-.075.136a.64.64 0 0 0 .382.92l.149.045c.612.18.612 1.048 0 1.229l-.15.043a.64.64 0 0 0-.38.921l.074.136c.305.561-.309 1.175-.87.87l-.136-.075a.64.64 0 0 0-.92.382l-.045.149c-.18.612-1.048.612-1.229 0l-.043-.15a.64.64 0 0 0-.921-.38l-.136.074c-.561.305-1.175-.309-.87-.87l.075-.136a.64.64 0 0 0-.382-.92l-.148-.045c-.613-.18-.613-1.048 0-1.229l.148-.043a.64.64 0 0 0 .382-.921l-.074-.136c-.306-.561.308-1.175.869-.87l.136.075a.64.64 0 0 0 .92-.382zM14 12.5a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0"/>
</svg></i></button>
                    <!-- <button class="button1" id="createAdminBtn">Create Admin</button> -->
                </div>
                <table id="userTable" data-tooltip="Delete"class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Sr.no</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone No</th>
                            <th>Gender</th>
                            <th>Edit</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        require_once 'admin_insert.php';
                        include "admin_connect.php";
                        
                        $sql = "SELECT * FROM admin_list";
                        $result = $conn->query($sql);
                        $no = 0;
                        while($user = $result->fetch_assoc()){
                            $no++;
                            ?>
                            <tr>
                                <td><?php echo $no?></td>
                                <td><?php echo ucwords($user["fullname"]) ?></td>
                                <td><?php echo $user["email"] ?></td>
                                <td><?php echo $user["phone"] ?></td>
                                <td><?php echo ucfirst($user["gender"]) ?></td>
                                <td>
                                    <button class="btn-update btn"data-tooltip="Update" data-userid="<?php echo $user["id"]; ?>"><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
  <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
  <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
</svg></button>
                                    <button class="btn-delete btn-d"data-tooltip="Delete" data-userid="<?php echo $user['id']; ?>"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
  <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5"/>
</svg></button>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <!-- Modal for User Operations -->
    <div id="userModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <form id="userForm" method="post">
                <input type="hidden" id="userId" name="id">
                <label for="userName">Name</label>
                <input type="text" id="userName" name="fullname"><br>
                
                <label for="userEmail">Email</label>
                <input type="email" id="userEmail" name="email">
                
                <label for="userPhone">PhoneNumber</label>
                <input type="text" id="userPhone" name="phone">
                
                <label for="userGender">Gender</label>
                <select id="userGender" name="gender">
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Other</option>
                </select><br>
                
                <label for="userPassword">Password</label>
                <input type="password" id="userPassword" name="password"><br>
                
                <input type="submit" id="submitButton" value="Submit">
            </form>
        </div>
    </div>

    <script src="//cdn.datatables.net/2.0.5/js/dataTables.min.js"></script>
    <script>
       // Get the modal and form
var modal = document.getElementById("userModal");
var form = document.getElementById("userForm");

// Get the button that opens the modal for creating new users
var createUserBtn = document.getElementById("createUserBtn");

// Get the close button inside the modal
var closeButton = document.querySelector('.close');

// Function to close the modal
function closeModal() {
    modal.style.display = "none";
}

// When the user clicks on the "Create User" button, open the modal
createUserBtn.addEventListener('click', function() {
    // Clear the form fields before opening the modal
    form.reset();
    // Set action attribute for creating new user
    form.action = "admin_insert.php";
    modal.style.display = "block";
});

// When the user clicks on the close button, close the modal
closeButton.addEventListener('click', closeModal);

// When the user clicks anywhere outside of the modal, close it
window.addEventListener('click', function(event) {
    if (event.target == modal) {
        closeModal();
    }
});
// Handle form submission for both create and update
form.addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent default form submission

    var formData = new FormData(form);

    fetch(form.action, {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        console.log(data); // Handle success response
        closeModal(); // Close the modal after successful submission

        // Optional: Redirect to another page after successful form submission
        window.location.href = "create_admin.php";
    })
    .catch(error => console.error('Error:', error));
});

// JavaScript code to handle opening the modal for update
var updateButtons = document.querySelectorAll('.btn-update');

updateButtons.forEach(function(button) {
    button.addEventListener('click', function() {
        var userId = this.getAttribute('data-userid');
        var name = this.parentNode.parentNode.children[1].textContent;
        var email = this.parentNode.parentNode.children[2].textContent;
        var phone = this.parentNode.parentNode.children[3].textContent;
        var gender = this.parentNode.parentNode.children[4].textContent;

        document.getElementById('userId').value = userId;
        document.getElementById('userName').value = name;
        document.getElementById('userEmail').value = email;
        document.getElementById('userPhone').value = phone;
        document.getElementById('userGender').value = gender;
        // Set action attribute for updating existing user
        form.action = "admin_update.php";
        modal.style.display = "block";
    });
});

// JavaScript code to handle deletion of user records
var deleteButtons = document.querySelectorAll('.btn-delete');

deleteButtons.forEach(function(button) {
    button.addEventListener('click', function() {
        var userId = this.getAttribute('data-userid');
        var confirmDelete = confirm("Are you sure you want to delete this user?");

        if (confirmDelete) {
            fetch('admin_delete.php?id=' + userId, {
                method: 'DELETE'
            })
            .then(response => {
                if (response.ok) {
                    location.reload(); // Reload the page after successful deletion
                } else {
                    console.error('Error deleting user record');
                }
            })
            .catch(error => console.error('Error:', error));
        }
    });
});

$(document).ready(function() {
    $('#userTable').DataTable();
});

</script>
</body>
</html>

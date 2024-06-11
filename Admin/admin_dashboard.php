<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Icon link  -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- <link rel="stylesheet" href="style.css"> -->
    <link rel="stylesheet" href="admin_dashbord.css">
    <title>User Page</title>
</head>
<style>

</style>
<body>
<!-- Include Navbar -->
<?php include 'admin_index.php';?>
<?php include 'admin_get_counts.php'; ?>
<!-- Main Content Section -->
<section class="main-section">
    <div class="profile-container1">
        <div class="profile-pic1">
            <img src="img1.webp" alt="Profile Picture">
        </div>
       
        <?php
      $servername = "localhost"; // Change if your database is on a different server
      $username = "root";
      $password = "";
      $database = "calendar";

      $conn = new mysqli($servername, $username, $password, $database);

      // Check connection
      if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
      }


        // Fetch admin details from database
        $sql = "SELECT * FROM administrator WHERE username='Rushvik patel'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc(); // Fetch the row once
            echo '<div class="names">';
            echo "<h5>" . ucwords($row['username']) . "</h5>";
            echo '</div>';
        } else {
            echo "Admin details not found.";
        }

        $conn->close();
        ?>
        
    </div>

    <div class="main">
        <!-- <div class="data1">
            <span>Admin Details</span>
            <hr>
            <table class="table table-bordered">
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        echo "<tr>";
                        echo "<td>Name</td>";
                        echo "<td>" . ucwords($row['username']) . "</td>";
                        echo "</tr>";
                        echo "<tr>";
                        echo "<td>Email</td>";
                        echo "<td>" . $row['email'] . "</td>";
                        echo "</tr>";
                        echo "<tr>";
                        echo "<td>Phone No.</td>";
                        echo "<td>" . $row['phone'] . "</td>";
                        echo "</tr>";
                        echo "<tr>";
                        echo "<td>Gender</td>";
                        echo "<td>" . $row['gender'] . "</td>";
                        echo "</tr>";
                        echo "<tr>";
                        echo "<td>Role</td>";
                        echo "<td>Admin</td>";
                        echo "</tr>";
                    } else {
                        echo "Admin details not found.";
                    }
                    ?>
                </tbody>
            </table>
        </div> -->
        <div class="data1">
    <span>Admin Details</span>
    <hr>
    <table class="table table-bordered admin-details-table">
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                echo "<tr>";
                echo "<td>Name</td>";
                echo "<td>" . ucwords($row['username']) . "</td>";
                echo "</tr>";
                echo "<tr>";
                echo "<td>Email</td>";
                echo "<td>" . $row['email'] . "</td>";
                echo "</tr>";
                echo "<tr>";
                echo "<td>Phone No.</td>";
                echo "<td>" . $row['phone'] . "</td>";
                echo "</tr>";
                echo "<tr>";
                echo "<td>Gender</td>";
                echo "<td>" . $row['gender'] . "</td>";
                echo "</tr>";
                echo "<tr>";
                echo "<td>Role</td>";
                echo "<td class='admin-role'><i class='bx bxs-user'></i> " . ($row['role'] == 'Admin' ? '<span class="highlight">' . $row['role'] . '</span>' : $row['role']) . "</td>";
                echo "</tr>";
                
                
            } else {
                echo "Admin details not found.";
            }
            ?>
        </tbody>
    </table>
</div>

        <div class="data2">
            <span>Activity</span><hr>
            <!-- <hr style="border: 0; height: 1px; background-color: blue;">  -->
            <!-- <h3>Activity Log</h3> -->
            <div class="mini_data">
                <p>Total User </p><hr>
                <h1><?php echo $total_users; ?></h1>
            </div>
            <div class="mini_data1">
                <p>Total Events </p><hr>
                <h1><?php echo $total_events; ?></h1>
            </div>
        </div>
    </div>
</section>


<script src="script.js"></script>
</body>
</html>

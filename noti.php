<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Notification System</title>
<style>
    body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
}

.container {
    max-width: 600px;
    margin: 50px auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h2 {
    text-align: center;
}

.notifications {
    margin-bottom: 20px;
}

.notification {
    padding: 10px;
    background-color: #f0f0f0;
    border-radius: 5px;
    margin-bottom: 10px;
}

.clear-btn {
    display: block;
    margin: 0 auto;
    padding: 10px 20px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.clear-btn:hover {
    background-color: #0056b3;
}

</style>
</head>
<body>
<div class="container">
    <h2>Notification System</h2>
    <div class="notifications">
        <?php include 'noti1.php'; ?>
    </div>
    <form action="clear_notifications.php" method="post">
        <button type="submit" class="clear-btn">Clear Notifications</button>
    </form>
</div>
</body>
</html>

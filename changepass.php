<?php include('dbconn.php') ?>

<html>
<head>
<title>Change Password</title>
<!-- <link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/form.css" /> -->
</head>

<body>
    <div class="phppot-container tile-container">
        <form name="frmChange" method="post" action="" onSubmit="return validatePassword()">

            <div class="validation-message text-center"></div>
            <h2 class="text-center">Change Password</h2>
            <div>
                <div class="row">
                    <label class="inline-block">Current Password</label>
                    <span id="currentPassword"
                        class="validation-message"></span> <input
                        type="password" name="currentPassword"
                        class="full-width">

                </div>
                <div class="row">
                    <label class="inline-block">New Password</label> <span
                        id="newPassword" class="validation-message"></span><input
                        type="password" name="newPassword"
                        class="full-width">

                </div>
                <div class="row">
                    <label class="inline-block">Confirm Password</label>
                    <span id="confirmPassword"
                        class="validation-message"></span><input
                        type="password" name="confirmPassword"
                        class="full-width">

                </div>
                <div class="row">
                    <input type="submit" name="submit" value="Submit"
                        class="full-width">
                </div>
            </div>

        </form>
    </div>
</body>
</html>
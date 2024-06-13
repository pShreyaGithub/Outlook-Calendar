<script>
    // Function to send emails
function sendEmails() {
    if (emails.length === 0) {
        alert("Please add at least one member's email address.");
        return;
    }
    
    // Convert array of emails to comma-separated string
    var emailAddresses = emails.join(",");
    
    // Here you can implement your email sending logic using AJAX or fetch API
    // For demonstration purposes, we'll just log the email addresses
    console.log("Sending emails to:", emailAddresses);
    
    // Clear the email array after sending emails
    emails = [];
    
    // Show notification
    showNotification();
}

// Function to display notification
function showNotification() {
    // Check if the browser supports notifications
    if (!("Notification" in window)) {
        alert("This browser does not support desktop notification");
    } else if (Notification.permission === "granted") {
        // If permission is already granted, show the notification
        var notification = new Notification("Event created successfully!", {
            body: "Notifications sent to all attendees.",
            icon: "user.png" // You can replace this with your own icon
        });
    } else if (Notification.permission !== "denied") {
        // Request permission from the user to display notifications
        Notification.requestPermission().then(function (permission) {
            // If permission is granted, show the notification
            if (permission === "granted") {
                var notification = new Notification("Event created successfully!", {
                    body: "Notifications sent to all attendees.",
                    icon: "user.png" // You can replace this with your own icon
                });
            }
        });
    }
}

// Call sendEmails function when Send Emails button is clicked
document.querySelector("button").addEventListener("click", sendEmails);

</script>
<?php
echo "Hello";
?>
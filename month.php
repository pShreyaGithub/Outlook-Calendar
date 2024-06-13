<?php
if(isset($_GET['month'])) {
  $selectedMonth = $_GET['month'];
  
  // Call the function to generate the calendar HTML for the selected month
  echo generateCalendar($selectedMonth);
}

function generateCalendar($selectedMonth) {
  // Generate the calendar HTML for the selected month (e.g., using the provided renderMonthView function)
  // You can include your existing PHP code here to generate the calendar HTML
  
  // For demonstration purposes, let's return a sample HTML
  $html = "<h2>Calendar for Month $selectedMonth</h2>";
  $html .= "<div class='month-calendar'>"; // Add your calendar HTML here
  $html .= "</div>";
  
  return $html;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Month Calendar Navigation</title>
<style>
    /* CSS styles */
body {
  font-family: Arial, sans-serif;
  margin: 0;
  padding: 20px;
}

nav {
  background-color: #f4f4f4;
  padding: 10px 20px;
  text-align: center;
}

form {
  display: inline-block;
}

label, select, button {
  margin-right: 10px;
}

#calendarContainer {
  margin-top: 20px;
}

</style>
</head>
<body>
  <nav>
    <h1>Month Calendar Navigation</h1>
    <form id="monthForm" method="GET">
      <label for="monthSelect">Select Month:</label>
      <select id="monthSelect">
        <option value="1">January</option>
        <option value="2">February</option>
        <option value="3">March</option>
        <option value="4">April</option>
        <option value="5">May</option>
        <option value="6">June</option>
        <option value="7">July</option>
        <option value="8">August</option>
        <option value="9">September</option>
        <option value="10">October</option>
        <option value="11">November</option>
        <option value="12">December</option>
      </select>
      <button type="submit">Go</button>
    </form>
  </nav>
  <div id="calendarContainer"></div>

  <script>
// JavaScript code
document.getElementById("monthForm").addEventListener("submit", function(event) {
  event.preventDefault(); // Prevent form submission
  
  const selectedMonth = document.getElementById("monthSelect").value;
  const calendarUrl = `Calendar.php?month=${selectedMonth}`;
  
  console.log("Fetching calendar data from:", calendarUrl); // Log the URL being fetched
  
  // Fetch calendar data and display it in calendarContainer
  fetch(calendarUrl)
    .then(response => {
      if (!response.ok) {
        throw new Error('Network response was not ok');
      }
      return response.text();
    })
    .then(data => {
      console.log("Calendar data fetched successfully:", data); // Log the fetched calendar data
      document.getElementById("calendarContainer").innerHTML = data;
    })
    .catch(error => {
      console.error('Error fetching calendar data:', error); // Log any fetch errors
    });
});

  </script>
</body>
</html>

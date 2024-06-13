const yearlyCalendar = document.getElementById("yearlyCalendar");
const viewSelect = document.getElementById("view");
const notesContainer = document.getElementById("books");
const monthrender = document.getElementById("monthselect");
var tooltipElements = document.querySelectorAll('.tooltiptext1');
let currentYear = new Date().getFullYear();
let currentMonth = new Date().getMonth() + 1;
renderCalendar();

function showNext() {
  const selectedView = viewSelect.value;
  switch (selectedView) {
    case "year":
      currentYear++;
      break;
    case "month":
      currentMonth++;
      if (currentMonth > 12) {
        currentMonth = 1;
        currentYear++;
      }
      break;
    case "week":
      updateWeekView(1);
      break;
    case "day":
      updateDayView(1);
      break;
    default:
      break;
  }
updateMonthSelect();
  renderCalendar();
  handleOptionChange();
}
function showPreview() {
  const selectedView = viewSelect.value;

  switch (selectedView) {
    case "year":
      currentYear--;
      break;
    case "month":
      currentMonth--;
      if (currentMonth < 1) {
        currentMonth = 12;
        currentYear--;
      }
      break;
    case "week":
      updateWeekView(-1);
      break;
    case "day":
      updateDayView(-1);
      break;
    default:
      break;
  }
  updateMonthSelect();
  renderCalendar();
  handleOptionChange();
}
function handleOptionChange() {
  renderCalendar();
  const days = document.getElementById("days");
  const month = document.getElementById("month");
  var cssFile = "";
  if (viewSelect.value === "year") {
    cssFile = "caldeepak.css";
  }
  if (viewSelect.value === "month") {
    console.log("Months option is select");
    monthrender.classList.remove("d-none");
    month.classList.add("w-100");
    days.classList.add("h-100");
  } else {
    monthrender.classList.add("d-none");
  }
  document.getElementById("custom-css").setAttribute("href", cssFile);
}

function renderCalendar() {
  let html = "";
  const selectedView = viewSelect.value;

  switch (selectedView) {
    case "month":
      html = renderMonthView(currentYear, currentMonth);
      break;
    case "year":
      html = renderYearView(currentYear);
      break;
    case "week":
      html = updateWeekView(0);
      break;
    case "day":
      html = updateDayView(0);
      break;
    default:
      break;
  }

  yearlyCalendar.innerHTML = html;
}

function renderYearView(year) {
  let html = "";
  for (let month = 0; month < 12; month++) {
    html += renderMonthView(year, month + 1);
  }

  const yearContainer = document.getElementById("yearContainer");
  if (yearContainer) {
    yearContainer.innerHTML = year;
  }
  return html;
}

function renderMonthView(year, month) {
  const daysInMonth = new Date(year, month, 0).getDate();
  const prevMonthDays = new Date(year, month - 1, 0).getDate();
  const monthName = new Date(year, month - 1, 1).toLocaleString("default", {
      month: "long",
  });

  let html = `<div class="month" id="month">`;
  document.getElementById("showdata").innerHTML=`${year} ${monthName}`;

  let dayLabels = [
      "Sunday",
      "Monday",
      "Tuesday",
      "Wednesday",
      "Thursday",
      "Friday",
      "Saturday",
  ];

  if (viewSelect.value) {
      document.getElementById("showdata").innerHTML = `${year} ${monthName}`;
  }
  if (viewSelect.value === "year") {
      dayLabels = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];
      document.getElementById("showdata").innerHTML = year;
      html += `<div class="month-name d-flex justify-content-center">${monthName} </div>`;
  }

  html += `<div class="days" id="days">`;

  // Add day labels
  for (let i = 0; i < 7; i++) {
      html += `<div class="day label">${dayLabels[i]}</div>`;
  }

  // Calculate the first day of the month and the last day of the previous month
  const firstDayOfMonth = new Date(year, month - 1, 1).getDay();
  const lastDayOfPrevMonth = new Date(year, month - 1, 0).getDate();

  // Add empty cells for days before the first day of the month
  for (let i = 0; i < firstDayOfMonth; i++) {
      const prevMonthDay = prevMonthDays - firstDayOfMonth + i + 1;
      html += `<div class="day prev-month">${prevMonthDay}</div>`;
  }

  // Add cells for each day in the month
  for (let day = 1; day <= daysInMonth; day++) {
    const dateKey = `${year}-${month.toString().padStart(2, "0")}-${day.toString().padStart(2, "0")}`;
    const storedNotes = JSON.parse(localStorage.getItem("books")) || {};
    const eventsForDay = storedNotes[dateKey] || []; // Assuming events are stored as an array
    const hasEvents = eventsForDay.length > 0;
    const currentDate = new Date();
    const isCurrentDate =
        year === currentDate.getFullYear() &&
        month === currentDate.getMonth() + 1 &&
        day === currentDate.getDate();
    
    let dayClass = `day ${hasEvents ? "has-events" : ""} ${isCurrentDate ? "current-date" : ""}`;
    let innerHTML = `${day}`;
    
    // Include event data directly in the day element if events exist
    if (hasEvents) {
      let innerHTML = `<div class="events-hover">`;
      eventsForDay.forEach(event => {
          innerHTML += `<div>${event}</div>`;
      });
      innerHTML += `</div>`;
  }
    
    // const tooltipText = hasEvents ? `<span class="tooltiptext">${getFormattedEvents(eventsForDay)}</span>` : "";
    const tooltipClass = viewSelect.value === 'year' ? 'tooltiptext' : 'tooltiptext1';
    const tooltipText = hasEvents ? `<span class="${tooltipClass}">${getFormattedEvents(eventsForDay)}</span>` : "";
    var tooltipCount = tooltipElements.length;
    console.log("Tooltip1 class ke elements ka count: " + tooltipCount);
    html += `<div class="${dayClass}" data-date="${dateKey}" ondblclick="openEventModal('${dateKey}')">${innerHTML || ''}${tooltipText}</div>`;
}


  // Add empty cells for days after the last day of the month to complete the grid
  const lastDayOfMonth = new Date(year, month, 0).getDay();
  const totalCellsAfterLastDay = 7 - ((lastDayOfMonth + 1) % 7);
  for (let i = 0; i < totalCellsAfterLastDay; i++) {
      const nextMonthDay = i + 1;
      html += `<div class="day next-month">${nextMonthDay}</div>`;
  }

  // Check if we need to add an additional row to ensure 6 rows in total
  const totalCells = firstDayOfMonth + daysInMonth + totalCellsAfterLastDay;
  const remainingCells = 42 - totalCells;
  for (let i = 0; i < remainingCells; i++) {
      const nextMonthDay = totalCellsAfterLastDay + i + 1;
      html += `<div class="day next-month">${nextMonthDay}</div>`;
  }

  html += `</div></div>`; // Close month div and calendar div

  return html;
}


function getFormattedEvents(events) {
  let formatted = "";
  events.forEach((event, index) => {
    formatted += `${index + 1}. ${event}<br>`;
  });
  return formatted;
}
document.addEventListener("DOMContentLoaded", function() {
  // Get the current month
  var currentMonth = new Date().getMonth() + 1;
  // Set the value of the month selection element to the current month
  monthrender.value = currentMonth;
  // Call the renderCalendar and handleOptionChange functions
  renderCalendar();
  handleOptionChange();
});
// function openEventModal(dateKey) {
//   const storedNotes = JSON.parse(localStorage.getItem("notes")) || {};
//   const eventsForDay = storedNotes[dateKey] || [];
//   const modalBody = document.getElementById("modal-body");
//   modalBody.innerHTML = ""; // Clear previous content
//   if (eventsForDay.length > 0) {
//     eventsForDay.forEach(function(event) {
//       const eventElement = document.createElement("div");
//       eventElement.textContent = event;
//       modalBody.appendChild(eventElement);
//     });
//   } else {
//     modalBody.textContent = "No events for this date";
//   }
//   const modal = document.getElementById("displayEvent");
//   modal.style.display = "block";
// }

// Event listener for clicking on a date
let clickedDateKey = ''; // Variable to store the clicked date key

// Event listener for clicking on a date for month and year view
document.addEventListener("click", function(event) {
  if (event.target.classList.contains("day")) {
    clickedDateKey = event.target.dataset.date; // Store the clicked date key
    openLionModal(clickedDateKey);
  }
});




// Function to open the lion modal with the clicked date
function openLionModal(date = '') {
  const lionModal = document.getElementById("lion");
  lionModal.style.display = "block"; // Show the lion modal
  lionModal.style.width = "600px"; // Set the desired width
  lionModal.style.zIndex = "1100"; // Ensure it's on top

  // You can add additional actions or data for the lion modal here
}

// Event listener for closing the lion modal
const closebutton = document.querySelector("#lion .close");
closebutton.addEventListener("click", closeLionModal);

// Function to close the lion modal
function closeLionModal() {
  const lionModal = document.getElementById("lion");
  lionModal.style.display = "none"; // Hide the lion modal
}

document.getElementById("button1").addEventListener("click", function() {
  const lionModal = document.getElementById("lion");
  const animalModal = document.getElementById("animal");

  // Close the lion modal
  lionModal.style.display = "none";

  // Open the animal modal
  animalModal.style.display = "block";
  animalModal.style.zIndex = "1200"; // Set a higher z-index for the animal modal
});

function openAnimalModal(date = '') {
  const animalModal = document.getElementById("animal");
  const eventDateInput = document.getElementById("eventDate");

  // Set the input field value to the clicked date
  eventDateInput.value = date;

  // Display the modal with a higher z-index
  animalModal.style.display = "block";
  animalModal.style.zIndex = "1200"; // Set a higher z-index for the animal modal
}

// Event listener for clicking on button 2 in the lion modal
document.getElementById("button2").addEventListener("click", function() {
  openEventModal(clickedDateKey); // Pass the clicked date key to openEventModal
  closeLionModal(); // Close the lion modal
});

function closeAnimalModal() {
  const animalModal = document.getElementById("animal");
  animalModal.style.display = "none"; // Hide the animal modal
}

// Event listener for clicking on the close button of the animal modal
const animalCloseButton = document.querySelector("#animal .close");
animalCloseButton.addEventListener("click", closeAnimalModal);

// Function to open the event modal
function openEventModal(dateKey) {
  const storedNotes = JSON.parse(localStorage.getItem("books")) || {};
  const eventsForDay = storedNotes[dateKey] || [];
  const modalBody = document.getElementById("modal-body");
  modalBody.innerHTML = ""; // Clear previous content

  if (eventsForDay.length > 0) {
    eventsForDay.forEach(function(event, index) {
      const eventContainer = document.createElement("div");

      // Create event title element
      const eventElement = document.createElement("div");
      eventElement.textContent = event;
      eventElement.style.marginBottom = "-4%";
      

      // Create update button
      const updateButton = document.createElement("button");
      updateButton.textContent = "Update";
      updateButton.className = "event-button" ; // Assign a class for styling
      updateButton.addEventListener("click", function() {
        // Open the update modal
        openUpdateModal(event);
      });

      // Create delete button
      const deleteButton = document.createElement("button");
      deleteButton.textContent = "Delete";
      deleteButton.className = "event-button"; // Assign a class for styling
      deleteButton.setAttribute("name", "deleteButton");
      deleteButton.addEventListener("click", function() {
        // Add functionality for deleting event here
        console.log("Delete button clicked for event:", event);
      });
      
      deleteButton.style.marginLeft = "10%";
      

      // Append event element, update button, and delete button to event container
      eventContainer.appendChild(eventElement);
      eventContainer.appendChild(updateButton);
      eventContainer.appendChild(deleteButton);

      // Append event container to modal body
      modalBody.appendChild(eventContainer);
    });
  } else {
    modalBody.textContent = "No events for this date";
  }

  const modal = document.getElementById("displayEvent");
  modal.style.display = "block";
}

// Function to open the update modal
function openUpdateModal(event) {
  
  // Show the update modal
  const updateModal = document.getElementById("update");
  updateModal.style.display = "block";

  // Pass event data to the update modal if needed
  document.getElementById("eventTitle").textContent = event;
}

// Function to close the update modal
function closeUpdateModal() {
  // Hide the update modal
  const updateModal = document.getElementById("update");
  updateModal.style.display = "none";
}

// Add an event listener for the update button click event
document.getElementById("updateButton").addEventListener("click", function() {
  // Get the event title or any relevant data
  const event = "Event title"; // Replace this with the actual event data
  openUpdateModal(event);
});

// function renderMonthView(year, month) {
//   const daysInMonth = new Date(year, month, 0).getDate();
//   const monthName = new Date(year, month - 1, 1).toLocaleString("default", {
//     month: "long",
//   });

//   let html = `<div class="month" id="month">
//                     <div class="month-name d-flex justify-content-center">${monthName} ${year}</div>
//                     <div class="days" id="days">`;

//   // Add day labels
//   const dayLabels = [
//     "Sunday",
//     "Monday",
//     "Tuesday",
//     "Wednesday",
//     "Thursday",
//     "Friday",
//     "Saturday",
//   ];

//   for (let i = 0; i < 7; i++) {
//     html += <div class="day label">${dayLabels[i]}</div>;
//   }

//   // Calculate the first day of the month and the last day of the previous month
//   const firstDayOfMonth = new Date(year, month - 1, 1).getDay();
//   const lastDayOfPrevMonth = new Date(year, month - 1, 0).getDate();

//   // Add empty cells for days before the first day of the month
//   for (let i = 0; i < firstDayOfMonth; i++) {
//     const prevMonthDay = lastDayOfPrevMonth - firstDayOfMonth + i + 1;
//     html += <div class="day non">${prevMonthDay}</div>;
//   }

//   // Add cells for each day in the month
//   for (let day = 1; day <= daysInMonth; day++) {
//     const dateKey =   `${year}-${month}-${day}`;
//     const storedNotes = JSON.parse(localStorage.getItem("notes")) || {};
//     const note = storedNotes[dateKey] || "";

//     // Highlight the current date
//     const currentDate = new Date();
//     const isCurrentDate = year === currentDate.getFullYear() && month === currentDate.getMonth() + 1 && day === currentDate.getDate();
    
//     html += `<div class="day tit ${
//       note ? "green " : ""
//     } ${isCurrentDate ? "current-date " : ""}" data-date="${dateKey}" onclick="addNotePrompt('${dateKey}')">${day}<br><span class="${
//       note ? "tooltiptext" : "d-none"
//     }">${note}</span></div>`;
//   }

//   // Calculate the last day of the month
//   const lastDayOfMonth = new Date(year, month, 0).getDay();

//   // Add empty cells for days after the last day of the month to complete the grid
//   for (let i = lastDayOfMonth + 1; i < 7; i++) {
//     const nextMonthDay = i - lastDayOfMonth;
//     html += <div class="day non">${nextMonthDay}</div>;
//   }

//   html += `</div>
//               </div>`; // Close month div

//   return html;
// }

var currentWeekOffset = 0;

// Function to generate week view with a given offset
function generateWeekView(weekOffset) {
  // Define hours
  var hours = [
    "",
    "1 AM",
    "2 AM",
    "3 AM",
    "4 AM",
    "5 AM",
    "6 AM",
    "7 AM",
    "8 AM",
    "9 AM",
    "10 AM",
    "11 AM",
    "12 PM",
    "1 PM",
    "2 PM",
    "3 PM",
    "4 PM",
    "5 PM",
    "6 PM",
    "7 PM",
    "8 PM",
    "9 PM",
    "10 PM",
    "11 PM",
    "12 AM",
  ];

  // Define days
  var days = [
    "Sunday",
    "Monday",
    "Tuesday",
    "Wednesday",
    "Thursday",
    "Friday",
    "Saturday",
  ];

  // Get the current date
  var currentDate = new Date();
  currentDate.setDate(currentDate.getDate() + weekOffset * 7); // Adjust date based on week offset

  var html = "<div >";
  html += "</div>";

  html += "<table id='calendar'>";
  html += "<thead>";
  html += "<tr>";
  html += "<th class='time-column'" + (days.length + 1) + "'>" + getMonthName(currentDate) + "" + currentDate.getFullYear() + "</th>";
  
  days.forEach(function (day) {
    html += "<th>" + day + "</th>";
  });
  html += "</tr>";
  html += "</thead>";
  html += "<tbody>";

  // Create rows
  hours.forEach(function (hour, index) {
    html += "<tr>";
    if(index == 0){
    html += "<td class='time-column' rowspan=''>" + hour + "</td>";
    }else{
      html += "<td class='time-column'>" + hour + "</td>";
    }
    days.forEach(function (day, dayIndex) {
      html += "<td>";
      if (index === 0) {
        var diff = dayIndex - currentDate.getDay();
        var date = new Date(currentDate);
        date.setDate(currentDate.getDate() + diff);
        html += date.getDate();
      }
      html += "</td>";
    });
    html += "</tr>";
  });

  html += "</tbody>";
  html += "</table>";

  return html;
}

function getWeekNumber(date) {
  var onejan = new Date(date.getFullYear(), 0, 1);
  var millisecsInDay = 86400000;
  return Math.ceil(
    ((date - onejan) / millisecsInDay + onejan.getDay() + 1) / 7
  );
}

function getMonthName(date) {
  var months = [
    "January",
    "February",
    "March",
    "April",
    "May",
    "June",
    "July",
    "August",
    "September",
    "October",
    "November",
    "December",
  ];
  return months[date.getMonth()];
}

// Function to update week view
function updateWeekView(offset) {
  currentWeekOffset += offset;
  var weekViewHtml = generateWeekView(currentWeekOffset);
  return weekViewHtml;
}

// Function to update day view
function updateDayView(offset) {
  var dayViewHtml = generateDayView(offset);
  return dayViewHtml;
}

// =============== Day ================

function generateDayView(dayOffset) {
  // Define hours
  var hours = [
    "12 AM",
    "1 AM",
    "2 AM",
    "3 AM",
    "4 AM",
    "5 AM",
    "6 AM",
    "7 AM",
    "8 AM",
    "9 AM",
    "10 AM",
    "11 AM",
    "12 PM",
    "1 PM",
    "2 PM",
    "3 PM",
    "4 PM",
    "5 PM",
    "6 PM",
    "7 PM",
    "8 PM",
    "9 PM",
    "10 PM",
    "11 PM",
  ];

  var options = { weekday: "long", month: "long", day: "numeric" };
  var formattedDate = currentDate.toLocaleDateString("en-US", options);
handleMonthChange
  // Format day
  var day = currentDate.toLocaleDateString("en-US", { weekday: "long" });

  document.getElementById("currentDate").innerHTML =
    formattedDate + " (" + day + ")";

  var html = '<table id="dayCalendar">';
  html += "<thead>";
  html += "<tr>";
  // Current date
  html +=
    '<th class="time-column" id="currentDate">' + formattedDate + " (" + day + ")" + "</th>";
  html += '<th colspan="4">Today</th>'; // Adjust the colspan according to the number of time slots
  html += "</tr>";
  html += "</thead>";
  html += "<tbody>";

  // Create rows for each hour
  hours.forEach(function (hour) {
    html += "<tr>";
    html += "<td class='time-column'>" + hour + "</td>";
    html += "<td colspan='4'></td>"; // Adjust the colspan according to the number of time slots
    html += "</tr>";
  });

  // Close the table structure
  html += "</tbody>";
  html += "</table>";

  return html;
}
document.addEventListener("DOMContentLoaded", function() {
  // Get the current month
  var currentMonth = new Date().getMonth() + 1;
  // Set the value of the month selection element to the current month
  monthrender.value = currentMonth;
  // Call the renderCalendar and handleOptionChange functions
  renderCalendar();
  handleOptionChange();
});

function updateMonthSelect() { 
  monthselect.value = currentMonth;
 }
function handleMonthChange() {
  currentMonth = monthrender.value;
  renderCalendar();
  handleOptionChange();
}
// Function to open the modal with the clicked date or blank input field
// Function to open the modal with the clicked date or blank input field
const closeButton = document.querySelector("#animal .close");
closeButton.addEventListener("click", closeModal);

// Event listener for clicking outside the modal
window.addEventListener("click", function(event) {
    const animalModal = document.getElementById("animal");
    if (event.target == animalModal) {
        closeModal();
    }
});

// Function to close the modal
function closeModal() {
    const animalModal = document.getElementById("animal");
    animalModal.style.display = "none";
}

// Function to open the modal with the clicked date or blank input field
function openAnimalModal(date = '') {
    const animalModal = document.getElementById("animal");
    const eventDateInput = document.getElementById("eventDate");

    // Set the input field value to the clicked date
    eventDateInput.value = date;

    // Display the modal
    animalModal.style.display = "block";
}

// Event listener for clicking on a date
document.addEventListener("click", function(event) {
    if (event.target.classList.contains("day")) {
        const date = event.target.dataset.date;
        openAnimalModal(date);
    }
});

// Event listener for form submission
const eventForm = document.getElementById("eventForm");
eventForm.addEventListener("submit", function(event) {
    event.preventDefault(); // Prevent default form submission

    // Create FormData object from the form
    const formData = new FormData(eventForm);

    // Make AJAX request to add the event
    fetch("createEventdb.php", {
            method: "POST",
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Close modal after successful addition
                closeModal();

                // Update UI with added event
                const eventData = data.event;
                const dateKey = eventData.date;
                const dayElement = document.querySelector(`.day[data-date="${dateKey}"]`);
                if (dayElement) {
                    dayElement.innerHTML += `<br><span class="tooltiptext">${eventData.title}</span>`;
                    dayElement.classList.add("green");
                }
            } else {
                console.error("Error:", data.message);
                // Handle error, display error message to user, etc.
            }
        })
        .catch(error => {
            console.error("Error:", error);
            // Handle network error or other exceptions
        });
});

function closeModal() {
  const eventModal = document.getElementById("animal");
  eventModal.style.display = "none";
}


// Tooltip1 class ke elements ko select karein
var tooltipElements = document.querySelectorAll('.tooltiptext1');

// Tooltip1 class ke elements ka count nikalein
var tooltipCount = tooltipElements.length;

// Tooltip1 class ke elements ka count console mein dikhayein
console.log("Tooltip1 class ke elements ka count: " + tooltipCount);
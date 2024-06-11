const yearlyCalendar = document.getElementById("yearlyCalendar");
const viewSelect = document.getElementById("view");
const notesContainer = document.getElementById("notes");
const monthrender = document.getElementById("monthselect");
let currentYear = new Date().getFullYear();
let currentMonth = new Date().getMonth() + 1;
renderCalendar();
console.log("yess");

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
    case "year":
      html = renderYearView(currentYear);
      break;
    case "month":
      html = renderMonthView(currentYear, currentMonth);
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
  return html;
}

// function renderMonthView(year, month) {
//   const daysInMonth = new Date(year, month, 0).getDate();
//   const monthName = new Date(year, month - 1, 1).toLocaleString("default", {
//     month: "long",
//   });

//   let html = `<div class="month" id="month">
//                     <div class="month-name d-flex justify-content-center">${monthName} ${year}</div>
//                     <div class="days" id="days">`;

//   // Add day labels
//   // const dayLabels = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];

//   if (viewSelect.value) {
//     dayLabels = [
//       "Sunday",
//       "Monday",
//       "Tuesday",
//       "Wednesday",
//       "Thursday",
//       "Friday",
//       "Saturday",
//     ];
//   }
//   if (viewSelect.value === "year") {
//     dayLabels = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];
//   }

//   for (let i = 0; i < 7; i++) {
//     html += `<div class="day label">${dayLabels[i]}</div>`;
//   }

//   // Calculate the first day of the month and the last day of the previous month
//   const firstDayOfMonth = new Date(year, month - 1, 1).getDay();
//   const lastDayOfPrevMonth = new Date(year, month - 1, 0).getDate();

//   // Add empty cells for days before the first day of the month
//   for (let i = 0; i < firstDayOfMonth; i++) {
//     const prevMonthDay = lastDayOfPrevMonth - firstDayOfMonth + i + 1;
//     html += `<div class="day non">${prevMonthDay}</div>`; // Add class "non" to represent days of the previous month
//   }

//   // Add cells for each day in the month
//   for (let day = 1; day <= daysInMonth; day++) {
//     const dateKey = `${year}-${month}-${day}`;
//     const storedNotes = JSON.parse(localStorage.getItem("notes")) || {};
//     const note = storedNotes[dateKey] || "";
//     const currentDate = new Date();
//     const isCurrentDate = year === currentDate.getFullYear() && month === currentDate.getMonth() + 1 && day === currentDate.getDate();
//     html += `<div class="day tit ${
//       note ? "green " : ""}${isCurrentDate ? "current-date": ""}" data-date="${dateKey}" onclick="addNotePrompt('${dateKey}')" >${day}<br><span class="${
//       note ? "tooltiptext" : "d-none"
//     }">${note}</span></div>`;
//   }

//   // Calculate the last day of the month
//   const lastDayOfMonth = new Date(year, month, 0).getDay();

//   // Add empty cells for days after the last day of the month to complete the grid
//   for (let i = lastDayOfMonth + 1; i < 7; i++) {
//     const nextMonthDay = i - lastDayOfMonth;
//     html += `<div class="day non">${nextMonthDay}</div>`; // Add class "non" to represent days of the next month
//   }

//   html += `</div>
//               </div>`; // Close month div

//   return html;
// }
function renderMonthView(year, month) {
  const daysInMonth = new Date(year, month, 0).getDate();
  const monthName = new Date(year, month - 1, 1).toLocaleString("default", {
    month: "long",
  });

  let html = `<div class="month" id="month">
                    <div class="month-name d-flex justify-content-center">${monthName} ${year}</div>
                    <div class="days" id="days">`;

  // Add day labels
  const dayLabels = [
    "Sunday",
    "Monday",
    "Tuesday",
    "Wednesday",
    "Thursday",
    "Friday",
    "Saturday",
  ];

  for (let i = 0; i < 7; i++) {
    html += <div class="day label">${dayLabels[i]}</div>;
  }

  // Calculate the first day of the month and the last day of the previous month
  const firstDayOfMonth = new Date(year, month - 1, 1).getDay();
  const lastDayOfPrevMonth = new Date(year, month - 1, 0).getDate();

  // Add empty cells for days before the first day of the month
  for (let i = 0; i < firstDayOfMonth; i++) {
    const prevMonthDay = lastDayOfPrevMonth - firstDayOfMonth + i + 1;
    html += <div class="day non">${prevMonthDay}</div>;
  }

  // Add cells for each day in the month
  for (let day = 1; day <= daysInMonth; day++) {
    const dateKey =   `${year}-${month}-${day}`;
    const storedNotes = JSON.parse(localStorage.getItem("notes")) || {};
    const note = storedNotes[dateKey] || "";

    // Highlight the current date
    const currentDate = new Date();
    const isCurrentDate = year === currentDate.getFullYear() && month === currentDate.getMonth() + 1 && day === currentDate.getDate();
    
    html += `<div class="day tit ${
      note ? "green " : ""
    } ${isCurrentDate ? "current-date " : ""}" data-date="${dateKey}" onclick="addNotePrompt('${dateKey}')">${day}<br><span class="${
      note ? "tooltiptext" : "d-none"
    }">${note}</span></div>`;
  }

  // Calculate the last day of the month
  const lastDayOfMonth = new Date(year, month, 0).getDay();

  // Add empty cells for days after the last day of the month to complete the grid
  for (let i = lastDayOfMonth + 1; i < 7; i++) {
    const nextMonthDay = i - lastDayOfMonth;
    html += <div class="day non">${nextMonthDay}</div>;
  }

  html += `</div>
              </div>`; // Close month div

  return html;
}

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

  var html = "<div class='week-info month-name d-flex justify-content-center fs-2'>";
  html +=
    "<p>Week <span class='weeknum'> " +
    getWeekNumber(currentDate) +
    "</span> of " +
    getMonthName(currentDate) +
    "</p>";
  html += "</div>";

  html += "<table id='calendar'>";
  html += "<thead>";
  html += "<tr>";
  html += "<th class='time-column'></th>";
  days.forEach(function (day) {
    html += "<th>" + day + "</th>";
  });
  html += "</tr>";
  html += "</thead>";
  html += "<tbody>";

  // Create rows
  hours.forEach(function (hour, index) {
    html += "<tr>";
    html += "<td class='time-column'>" + hour + "</td>";
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

  // Format day
  var day = currentDate.toLocaleDateString("en-US", { weekday: "long" });

  document.getElementById("currentDate").innerHTML =
    formattedDate + " (" + day + ")";

  var html = '<table id="dayCalendar">';
  html += "<thead>";
  html += "<tr>";
  // Current date
  html +=
    '<th class="time-column" id="currentDate">' +
    formattedDate +
    " (" +
    day +
    ")" +
    "</th>";
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
function handleMonthChange() {
  currentMonth = monthrender.value;
  renderCalendar();
  handleOptionChange();
}

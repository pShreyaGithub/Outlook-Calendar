
// // document.addEventListener("DOMContentLoaded", function() {
// //     // Get current date
// //     var currentDate = new Date();
// //     var currentYear = currentDate.getFullYear();
// //     var currentMonth = currentDate.getMonth();

// //     // Display current month and year
// //     document.getElementById("currentMonth").innerText = currentYear + "-" + (currentMonth + 1);

// //     // Add event listener to previous button
// //     document.getElementById("prevBtn").addEventListener("click", function(e) {
// //         e.preventDefault();
// //         currentMonth--;
// //         if (currentMonth < 0) {
// //             currentMonth = 11;
// //             currentYear--;
// //         }
// //         updateCalendar(currentYear, currentMonth);
// //     });

// //     // Add event listener to next button
// //     document.getElementById("nextBtn").addEventListener("click", function(e) {
// //         e.preventDefault();
// //         currentMonth++;
// //         if (currentMonth > 11) {
// //             currentMonth = 0;
// //             currentYear++;
// //         }
// //         updateCalendar(currentYear, currentMonth);
// //     });

// //     // Function to update the calendar
// //     function updateCalendar(year, month) {
// //         var xhttp = new XMLHttpRequest();
// //         xhttp.onreadystatechange = function() {
// //             if (this.readyState == 4 && this.status == 200) {
// //                 document.querySelector(".calendar").innerHTML = this.responseText;
// //             }
// //         };
// //         xhttp.open("GET", "render_calendar.php?year=" + year + "&month=" + month, true);
// //         xhttp.send();
// //     }
// // });


// //gaurav
// document.addEventListener("DOMContentLoaded", function() {
//     var currentDate = new Date();
//     var currentYear = currentDate.getFullYear();
//     var currentMonth = currentDate.getMonth();

//     // Display current month and year
//     document.getElementById("currentMonth").innerText = currentYear + "-" + (currentMonth + 1);

//     document.getElementById("prevBtn").addEventListener("click", function(e) {
//         e.preventDefault();
//         currentMonth--;
//         if (currentMonth < 0) {
//             currentMonth = 11;
//             currentYear--;
//         }
//         updateCalendar(currentYear, currentMonth);
//     });

//     document.getElementById("nextBtn").addEventListener("click", function(e) {
//         e.preventDefault();
//         currentMonth++;
//         if (currentMonth > 11) {
//             currentMonth = 0;
//             currentYear++;
//         }
//         updateCalendar(currentYear, currentMonth);
//     });

//     function updateCalendar(year, month) {
//         var xhttp = new XMLHttpRequest();
//         xhttp.onreadystatechange = function() {
//             if (this.readyState == 4 && this.status == 200) {
//                 document.querySelector(".calendar").innerHTML = this.responseText;
//                 document.getElementById("currentMonth").innerText = year + "-" + (month + 1);
//             }
//         };
//         xhttp.open("GET", "render_calendar.php?year=" + year + "&month=" + month, true);
//         xhttp.send();
//     }
// });
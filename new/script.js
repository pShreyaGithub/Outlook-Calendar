// document.addEventListener("DOMContentLoaded", function() {
//     const prevButton = document.getElementById("prevButton");
//     const nextButton = document.getElementById("nextButton");
//     const currentMonthElement = document.getElementById("currentMonth");

//     prevButton.addEventListener("click", function() {
//         navigateMonth(-1);
//     });

//     nextButton.addEventListener("click", function() {
//         navigateMonth(1);
//     });

//     function navigateMonth(direction) {
//         const currentYear = parseInt(currentMonthElement.innerText.split(' ')[1]);
//         let currentMonth = parseInt(currentMonthElement.getAttribute("data-month")) + direction;

//         if (currentMonth === 0) {
//             currentMonth = 12;
//         } else if (currentMonth === 13) {
//             currentMonth = 1;
//         }

//         window.location.href = `?year=${currentYear}&month=${currentMonth}`;
//     }
// });

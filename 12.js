function renderMonthView(year, month) {
    const daysInMonth = new Date(year, month, 0).getDate();
    const prevMonthDays = new Date(year, month - 1, 0).getDate();
    const monthName = new Date(year, month - 1, 1).toLocaleString("default", {
        month: "long",
    });
  
    let html = `<div class="month ${viewSelect.value === 'year' ? 'year-view' : ''}" id="month">`;
    document.getElementById("showdata").innerHTML = `${year} ${monthName}`;
  
    let dayLabels = [
        "Sunday",
        "Monday",
        "Tuesday",
        "Wednesday",
        "Thursday",
        "Friday",
        "Saturday",
    ];
  
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
      const storedNotes = JSON.parse(localStorage.getItem("notes")) || {};
      const eventsForDay = storedNotes[dateKey] || [];
      const hasEvents = eventsForDay.length > 0;
      const currentDate = new Date();
      const isCurrentDate =
        year === currentDate.getFullYear() &&
        month === currentDate.getMonth() + 1 &&
        day === currentDate.getDate();
      
      let htmlContent = "";
      let tooltipText = "";
      if (hasEvents && viewSelect.value !== "year") {
        htmlContent += `<div class="event">${eventsForDay[0]}</div>`;
        
        if (eventsForDay.length > 1) {
          const eventCount = eventsForDay.length - 1;
          htmlContent += `<div class="event-count">+${eventCount}</div>`;
        }
      
        tooltipText = `<span class="tooltiptext">${getFormattedEvents(eventsForDay)}</span>`;
      }
      
      html += `<div class="day ${hasEvents ? "has-events" : ""} ${isCurrentDate ? "current-date" : ""}`";
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
    if (events.length > 0) {
      // Display the title of the first event
      formatted += 1. `${events[0]}<br>`;
      
      // If there are more than 1 event, display count for subsequent events
      if (events.length > 1) {
        for (let i = 1; i < events.length; i++) {
          formatted += `+${i + 1} (${events[i]})<br>`;
        }
      }
    }
    return formatted;
  }
  
  
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
    const storedNotes = JSON.parse(localStorage.getItem("notes")) || {};
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
        updateButton.className = "event-button"; // Assign a class for styling
        updateButton.addEventListener("click", function() {
          // Open the update modal
          window.location.href = "list_events.php?event=" + event;
          openUpdateModal(event);
        });
  
        // Create delete button
        const deleteButton = document.createElement("button");
        deleteButton.textContent = "Delete";
        deleteButton.className = "event-button"; // Assign a class for styling
        deleteButton.setAttribute("name", "deleteButton");
        deleteButton.addEventListener("click", function() {
          // Redirect to list_event.php for delete functionality
          window.location.href = "list_events.php?event=" + event;
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
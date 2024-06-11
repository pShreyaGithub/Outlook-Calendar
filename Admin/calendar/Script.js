const navbarMenu = document.querySelector(".navbar .links");
const hamburgerBtn = document.querySelector(".hamburger-btn");
const hideMenuBtn = navbarMenu.querySelector(".close-btn");

// Show mobile menu
hamburgerBtn.addEventListener("click", () => {
    navbarMenu.classList.toggle("show-menu");
});

// Hide mobile menu
hideMenuBtn.addEventListener("click", () =>  hamburgerBtn.click());



var lastScrollTop = 0;
var navbar = document.getElementById("navbar");

window.addEventListener("scroll", function() {
    var currentScroll = window.pageYOffset || document.documentElement.scrollTop;
    
    if (currentScroll > lastScrollTop) {
        // Scroll down
        navbar.classList.add("scrolled");
    } else {
        // Scroll up
        navbar.classList.remove("scrolled");
    }
    lastScrollTop = currentScroll <= 0 ? 0 : currentScroll;
}, false);


function formvalid() {
    var vaildpass = document.getElementById("pass").value;
  
    if (vaildpass.length <= 8 || vaildpass.length >= 20) {
      document.getElementById("vaild-pass").innerHTML = "Minimum 8 characters";
      return false;
    } else {
      document.getElementById("vaild-pass").innerHTML = "";
    }
  }
  
  function show() {
    var x = document.getElementById("pass");
    if (x.type === "password") {
      x.type = "text";
      document.getElementById("showimg").src =
        "open.jpg";
    } else {
      x.type = "password";
      document.getElementById("showimg").src =
        "close.jpg";
    }
  }
  function show1() {
    var x = document.getElementById("pass1");
    if (x.type === "password") {
      x.type = "text";
      document.getElementById("showimg1").src =
        "open.jpg";
    } else {
      x.type = "password";
      document.getElementById("showimg1").src =
        "close.jpg";
    }
  }
  function formvalid1() {
    var vaildpass = document.getElementById("pass1").value;
  
    if (vaildpass.length <= 8 || vaildpass.length >= 20) {
      document.getElementById("vaild-pass1").innerHTML = "Minimum 8 characters";
      return false;
    } else {
      document.getElementById("vaild-pass1").innerHTML = "";
    }
  }
  function show2() {
    var x = document.getElementById("pass2");
    if (x.type === "password") {
      x.type = "text";
      document.getElementById("showimg2").src =
        "open.jpg";
    } else {
      x.type = "password";
      document.getElementById("showimg2").src =
        "close.jpg";
    }
  }
  function formvalid2() {
    var vaildpass = document.getElementById("pass2").value;
  
    if (vaildpass.length <= 8 || vaildpass.length >= 20) {
      document.getElementById("vaild-pass2").innerHTML = "Minimum 8 characters";
      return false;
    } else {
      document.getElementById("vaild-pass2").innerHTML = "";
    }
  }
  function valid(){
//   document.addEventListener('DOMContentLoaded', function () {
//     const phoneNumberForm = document.getElementsByClassName('signup-form');
  
//     phoneNumberForm.addEventListener('register', function (event) {
//         event.preventDefault();
  
//         const phoneNumberInput = document.getElementsByClassName('signup-form');
//         const phoneNumberValue = phoneNumberInput.value;
  
//         if (valid(phoneNumberValue)) {
//             alert('Form has been submitted.');
//         } else {
//             alert('Invalid phone number. Please enter a valid phone number starting with 6, 7, 8, or 9.');
//         }
//     });
  
//     function valid(phoneNumber) {
//         const phoneRegex = /^[6-9]\d{9}$/;
        
//         return phoneRegex.test(phoneNumber);
//     }
//   });
// 
document.getElementById("phoneNumberForm").addEventListener("register", function(event) {
  event.preventDefault(); // Prevent form submission

  var phoneNumber = document.getElementById("phoneNumber").value;
  var regex = /^[6-9]\d{9}$/;

  if (regex.test(phoneNumber)) {
      alert("Valid phone number");
  } else {
      alert("Invalid phone number");
  }
});
}
var myModal = document.getElementById('myModal')
var myInput = document.getElementById('myInput')

// myModal.addEventListener('shown.bs.modal', function () {
//   myInput.focus()
// });

function valid(){
  var mail  = document.getElementById("email").value;
  var validreg = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
  
  if(!validreg.test(mail)){
    alert("invalid email");
    return false;
  }
  }
  document.addEventListener('DOMContentLoaded', function () {
    const phoneNumberForm = document.getElementById('phoneNumberForm');
  
    // phoneNumberForm.addEventListener('submit', function (event) {
    //     event.preventDefault();
  
    //     const phoneNumberInput = document.getElementById('phoneNumber');
    //     const phoneNumberValue = phoneNumberInput.value;
  
    //     if (valid(phoneNumberValue)) {
    //         alert('Form has been submitted.');
    //     } else {
    //         alert('Invalid phone number. Please enter a valid phone number starting with 6, 7, 8, or 9.');
    //     }
    // });
  
    function valid(phoneNumber) {
        const phoneRegex = /^[6-9]\d{9}$/;
        
        return phoneRegex.test(phoneNumber);
    }
  });
  
  function login(){
    var email = $("email").val();
    var password= $("#pass").val();

    $.ajax({
      type: "POST",
      url: "index.php",
      data: {email: email, password:pass },
      success: function (response) { 
        if(response === "success"){
          console.log();
            window.location.href = "month.php";
        } else {
            $("#error").text("Invalid username or password.");
        }
    },
    error: function (error) {
        console.log("Error:", error);
    }
});
}


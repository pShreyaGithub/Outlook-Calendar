<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="UTF-8">
  <title>Preloader Animation</title>
  <!-- Custom CSS -->
  <style>
    body{background:#ECF0F1}

    .load{position:absolute;top:50%;left:50%;transform:translate(-50%, -50%);
      /*change these sizes to fit into your project*/
      width:100px;
      height:100px;
    }
    .load hr{border:0;margin:0;width:40%;height:40%;position:absolute;border-radius:50%;animation:spin 2s ease infinite}

    .load :first-child{background:#19A68C;animation-delay:-1.5s}
    .load :nth-child(2){background:#F63D3A;animation-delay:-1s}
    .load :nth-child(3){background:#FDA543;animation-delay:-0.5s}
    .load :last-child{background:#193B48}

    @keyframes spin{
      0%,100%{transform:translate(0)}
      25%{transform:translate(160%)}
      50%{transform:translate(160%, 160%)}
      75%{transform:translate(0, 160%)}
    }
  </style>
</head>

<body>
  <!-- Your website content goes here -->
  <div class="load">
    <hr/><hr/><hr/><hr/>
  </div>

  <script>
    // Redirect to another page after preloader animation
    setTimeout(function() {
      window.location.href = 'index.php';
    }, 3000); // Adjust delay as needed (in milliseconds)
  </script>
</body>

</html>

<?php
$connection = mysqli_connect('localhost', 'root', '', 'databox');
session_start();

if(isset($_SESSION['validregistration'])){   
  echo $_SESSION['validregistration'];
  unset($_SESSION['validregistration']);
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>DataBox | Registration</title>
    <link rel="stylesheet" href="css/registration.css" type="text/css" />
    <link rel="shortcut icon" href="svg/icon.svg" type="image/x-icon">
    <!-- <link rel="stylesheet" href="css/data_page.css" type="text/css" /> -->
  </head>
  <body>
    <main>
      <div class="glass_box">
        <div class="registration_box">
          <form action="registration_handler.php" method="POST" enctype="multipart/form-data">
            <h1>Sign Up</h1>
            <h3>Hello!</h3>
            <span>Please insert your data to register</span>
            <section class="field_box">
              <input
                type="text"
                name="username"
                id="username"
                placeholder="Username"
              />
              <input
                type="password"
                name="password"
                id="password"
                placeholder="Password"
              />
              <input
                type="email"
                name="email"
                id="email"
                placeholder="example@gmail.com"
              />

              <img
              id="target"
              height="100"
              width="100"
              class="uploaded_image gen_box_shadow"
              /> 

              <input type="file" name="image" id="file" onchange="putImage()" /> 

              <input type="submit" class="submit_button" value="Sign Up" name="submit"/>
            </section>
            <p class="bottom_text">
              Already have an account? <a href="login.php"> Sign in</a>
            </p>
          </form>
        </div>
      </div>
    </main>

    <script src="js/generic.js"></script>
  </body>
</html>

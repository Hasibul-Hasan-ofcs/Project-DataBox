<?php

    if(isset($_POST['submit'])){
        $connection = mysqli_connect('localhost', 'root', '', 'databox');

        $username = mysqli_real_escape_string($connection, $_POST['username']);
        $password = md5($_POST['password']);

        $selectQuery = "SELECT * FROM users WHERE username='{$username}'";
        $result = mysqli_query($connection, $selectQuery);

        if(mysqli_num_rows($result)>0){
          while($row = mysqli_fetch_assoc($result)){
            if(!empty($row['password']) && $row['password']==$password){

              session_start();

              $_SESSION['username'] = $_POST['username'];
              $_SESSION['image'] = $row['image'];

              header("Location: data_page.php");
            }else{
              echo(
                  "<h2 style='display: block; padding: 1rem 3rem; text-align: center; width: fit-content;
                  background-color: #ffe3e3; border: #fa5252 1px solid; color: #fa5252;
                  position: absolute; top: 2%; left: 50%; transform: translateX(-50%); border-radius: 2px;'>
                  Username or password is incorrect.</h2>"
              );
            }
          }
        }else{
          echo(
            "<h3 style='display: block; padding: 1rem 3rem; text-align: center; width: fit-content;
            background-color: #ffe3e3; border: #fa5252 1px solid; color: #fa5252;
            position: absolute; top: 2%; left: 50%; transform: translateX(-50%); border-radius: 2px;'>
            User doesn't exist.</h3>"
        );
        }

        mysqli_close($connection);
    }

?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>DataBox | Sign In</title>
    <link rel="stylesheet" href="css/login.css" type="text/css" />
    <link rel="shortcut icon" href="svg/icon.svg" type="image/x-icon">
  </head>
  <body>
    <main>
      <div class="glass_box">
        <div class="login_box">
          <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
            <h1>Sign In</h1>
            <h3>Welcome Back!</h3>
            <span>Please login to your account</span>
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
              <input type="submit" class="submit_button" value="Log In" name="submit"/>
            </section>
            <!-- <p><a href="#">Forgot password?</a></p> -->
            <p class="bottom_text">
              Don't have an account? <a href="registration.php"> Sign up</a>
            </p>
          </form>
        </div>
      </div>
    </main>
  </body>
</html>

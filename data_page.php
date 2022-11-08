<?php

  $connection = mysqli_connect('localhost', 'root', '', 'databox');
  session_start();

  if(isset($_SESSION['status'])){   
    echo $_SESSION['status'];
    unset($_SESSION['status']);
  }

  // Table creation operation if doesn't already exist
  $createTable = mysqli_query($connection,"CREATE TABLE IF NOT EXISTS usersdata(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    username varchar(20), 
    phone varchar(500),
    email varchar(30), 
    age INT,
    image varchar(200),
    creatorid INT
    )");


  if(!isset($_SESSION['username'])){   
    header("Location: login.php");
  }

  $creatorname = $_SESSION['username'];
  $creatordata = mysqli_query($connection,"SELECT * FROM users WHERE username='{$creatorname}'");
  $creatorid;
  while($row = mysqli_fetch_assoc($creatordata)){
      $creatorid = $row['id'];
  }

?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>DataBox | Data Page</title>
    <link rel="stylesheet" href="css/data_page.css" type="text/css" />
    <link rel="shortcut icon" href="svg/icon.svg" type="image/x-icon">
  </head>
  <body>
    <header>
      <div class="logo">
        <h2 class="Website_name">Data<span>Box</span></h2>
      </div>
      <div class="user_profile">
        <?php 
          if(isset($_SESSION['username'])){         
          ?>

        <img src="server_images/<?php echo $_SESSION['image'] ?>" alt="user_img" height="40" width="40" />
        <span class="username_p" style="font-weight: 700; padding-right: 1rem;"><?php echo $_SESSION['username'] ?></span>
        
        <?php } ?>

        <div class="floating_box">
          <ul>
            <!-- <li><a>Visit Profile</a></li> -->
            <li><a href="logout_controller.php">Logout</a></li>
          </ul>
        </div>
      </div>
    </header>

    <main>
      <h1>Please fillup all the fields in order to add new data to the list</h1>


      <form action="data_page_handler.php" method="POST" enctype="multipart/form-data">
        <input
          type="text"
          required name="username"
          id="username"
          placeholder="username"
          <?php 
          if(isset($_SESSION['editname'])){         
            echo "value='{$_SESSION["editname"]}'";
          }
          unset($_SESSION['editname']);
          ?>
        />
        <input type="number" required name="phone" id="phone" placeholder="phone no." <?php 
          if(isset($_SESSION['editphone'])){         
            echo "value='{$_SESSION["editphone"]}'";
          }
          unset($_SESSION['editphone']);
          ?>/>
        <input type="email" required name="email" id="email" placeholder="email" <?php 
          if(isset($_SESSION['editemail'])){         
            echo "value='{$_SESSION["editemail"]}'";
          }
          unset($_SESSION['editemail']);
          ?>/>
        <input type="number" required name="age" id="age" placeholder="age" <?php 
          if(isset($_SESSION['editage'])){         
            echo "value='{$_SESSION["editage"]}'";
          }
          unset($_SESSION['editage']);
          ?>/>

        <img
          id="target"
          height="100"
          width="100"
          class="uploaded_image gen_box_shadow"
        />

        <input type="file" required name="image" id="file" onchange="putImage()" <?php 
          if(isset($_SESSION['editimg'])){         
            echo "value='{$_SESSION["editimg"]}'";
          }
          unset($_SESSION['editimg']);
          ?>/>
        <button type="submit" class="submit_button"
        <?php 
          if(isset($_SESSION['idupdate'])){         
            echo "name='update'";
          }else{
            echo "name='submit'";
          }
          unset($_SESSION['editimg']);
          ?>  
        >
          Enter &nbsp;&nbsp;<img
            src="svg/send.svg"
            alt=""
            height="30"
            width="30"
          />
        </button>
      </form>
      <table>
        <caption>
          All Data
        </caption>
        <thead>
          <tr>
            <th>name</th>
            <th>phone no.</th>
            <th>email</th>
            <th>age</th>
            <th>action</th>
          </tr>
        </thead>
        <tbody>
          <?php 
            $selectDataQuery = "SELECT * FROM usersdata WHERE creatorid={$creatorid}";
            $result = mysqli_query($connection, $selectDataQuery);

            while($row = mysqli_fetch_assoc($result)){
          ?>
          <tr>
            <td class="dataimg">
              <div class="dataimg_block">
                <img
                  src="server_images/<?php echo $row['image'] ?>"
                  alt="dataimg"
                  height="30"
                  width="30"
                />
                <span><?php echo $row['username'] ?></span>
              </div>
            </td>
            <td><?php echo $row['phone'] ?></td>
            <td><?php echo $row['email'] ?></td>
            <td><?php echo $row['age'] ?></td>
            <td class="table_action">
              <a href="data_page_edit.php?id=<?php echo $row["id"]?>"
                ><img src="svg/edit2.svg" alt="edit" height="20" width="20" />
              </a>
              <a href="data_page_delete.php?id=<?php echo $row["id"]?>"
                ><img
                  src="svg/delete2.svg"
                  alt="delete"
                  height="20"
                  width="20"
                />
              </a>
            </td>
          </tr>

          <?php } ?>
        </tbody>
      </table>
    </main>

    <footer>
      <p>Copyright &copy; MD. Hasibul 201311067</p>
    </footer>

    <!-- scripts -->
    <script src="js/generic.js"></script>
  </body>
</html>

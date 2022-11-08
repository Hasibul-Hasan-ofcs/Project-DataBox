<?php

    $connection = mysqli_connect('localhost', 'root', '', 'databox');
    session_start();
    // edit inline portion
    $editid = $_GET['id'];
    $sqldelete = "SELECT * FROM usersdata WHERE id={$editid}";
    $result = mysqli_query($connection,$sqldelete) or die("query failed");

    if(mysqli_num_rows($result)>0){
        while($row=mysqli_fetch_assoc($result)){
            $_SESSION['idupdate'] = $row['id'];
            $_SESSION['editname'] = $row['username'];
            $_SESSION['editphone'] = $row['phone'];
            $_SESSION['editemail'] = $row['email'];
            $_SESSION['editage'] = $row['age'];
            $_SESSION['editimg'] = $row['image'];
        }
    }

    header("Location: data_page.php");


?>
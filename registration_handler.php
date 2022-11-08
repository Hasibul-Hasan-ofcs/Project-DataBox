<?php

    if(isset($_POST['submit'])){
        $connection = mysqli_connect('localhost', 'root', '', 'databox');
        session_start();

        // Table creation operation if doesn't already exist
        $createTable = mysqli_query($connection,"CREATE TABLE IF NOT EXISTS users(
            id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
            username varchar(20), 
            email varchar(30), 
            password varchar(500),
            image varchar(200)
            )");

        if(strlen($_POST['username'])<3){
            $_SESSION['validregistration'] = 
                "<h3 style='display: block; padding: 1rem 3rem; text-align: center; width: fit-content;
                background-color: #ffe3e3; border: #fa5252 1px solid; color: #fa5252;
                position: absolute; top: 2%; left: 50%; transform: translateX(-50%); border-radius: 2px;'>
                Username needs to be atleast of 3 characters.</h3>";

            header("Location: registration.php");
            die();
        }
        if(strlen($_POST['password'])<5){
            $_SESSION['validregistration'] = 
                "<h3 style='display: block; padding: 1rem 3rem; text-align: center; width: fit-content;
                background-color: #ffe3e3; border: #fa5252 1px solid; color: #fa5252;
                position: absolute; top: 2%; left: 50%; transform: translateX(-50%); border-radius: 2px;'>
                Password should be atleast of 5 characters.</h3>";

            header("Location: registration.php");
            die();
        }

        $username = mysqli_real_escape_string($connection, $_POST['username']);
        $email = mysqli_real_escape_string($connection, $_POST['email']);
        $password = md5($_POST['password']);
        
        // image upload portion
        $fileName = $_FILES["image"]["name"];
        $fileType = $_FILES["image"]["type"];
        $fileTmp_Name = $_FILES["image"]["tmp_name"];
        $fileSize = $_FILES["image"]["size"];

        $insertDataQuery = "INSERT INTO users(username, email, password, image) VALUES('{$username}', '{$email}', '{$password}', '{$fileName}')";
        $result = mysqli_query($connection, $insertDataQuery);

        move_uploaded_file($fileTmp_Name, "server_images/". $fileName);

        if(!$result){
            header("Location: registration.php");
        }else{
            header("Location: login.php");
        }

        mysqli_close($connection);
        die();
    }

?>
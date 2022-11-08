<?php
    $connection = mysqli_connect('localhost', 'root', '', 'databox');
    session_start();

if(isset($_POST['submit'])){

    $username = $_POST['username'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $image = $_FILES["image"]["name"];
    $age = $_POST['age'];

    $fileTmp_Name = $_FILES["image"]["tmp_name"];

    $creatorname = $_SESSION['username'];
    $creatordata = mysqli_query($connection,"SELECT * FROM users WHERE username='{$creatorname}'");
    $creatorid;
    while($row = mysqli_fetch_assoc($creatordata)){
        $creatorid = $row['id'];
    }

    $insertDataQuery = "INSERT INTO usersdata(username, phone, email, age, image, creatorid) VALUES('{$username}',
                         '{$phone}', '{$email}', {$age}, '{$image}', {$creatorid})";
    $result = mysqli_query($connection, $insertDataQuery);

    move_uploaded_file($fileTmp_Name, "server_images/". $image);

    if(!$result){
        echo "error occured";
    }

    $_SESSION['status'] = "<h2 style='display: block; padding: 1rem 3rem; text-align: center; width: fit-content;
    background-color: #c5f7cf; border: #05cf31 1px solid; color: #05cf31;
    position: absolute; top: 2%; left: 50%; transform: translateX(-50%); border-radius: 2px;'>
    Data added successfully.</h2>";
    

}else if(isset($_POST['update'])){

    $username = $_POST['username'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $image = $_FILES["image"]["name"];
    $age = $_POST['age'];

    $fileTmp_Name = $_FILES["image"]["tmp_name"];

    $creatorname = $_SESSION['username'];
    $creatordata = mysqli_query($connection,"SELECT * FROM users WHERE username='{$creatorname}'");
    $creatorid;
    while($row = mysqli_fetch_assoc($creatordata)){
        $creatorid = $row['id'];
    }

    $idupdate = $_SESSION['idupdate'];

    $updateDataQuery = "UPDATE usersdata SET username='{$username}',
    phone='{$phone}', email='{$email}', age={$age}, image='{$image}', creatorid={$creatorid} WHERE id={$idupdate}";
    $result = mysqli_query($connection, $updateDataQuery);

    move_uploaded_file($fileTmp_Name, "server_images/". $image);

    if(!$result){
        echo "error occured";
    }
    
    $_SESSION['status'] = "<h2 style='display: block; padding: 1rem 3rem; text-align: center; width: fit-content;
    background-color: #c5f7cf; border: #05cf31 1px solid; color: #05cf31;
    position: absolute; top: 2%; left: 50%; transform: translateX(-50%); border-radius: 2px;'>
    Data updated successfully.</h2>";
}

    mysqli_close($connection);

    header("Location: data_page.php");
?>
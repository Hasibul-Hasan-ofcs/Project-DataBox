<?php

    $connection = mysqli_connect('localhost', 'root', '', 'databox');
    session_start();
    // delete inline portion
    $deleteid = $_GET['id'];
    $sqlfind = "SELECT * FROM usersdata WHERE id={$deleteid}";
    $resultfind = mysqli_query($connection,$sqlfind) or die("query failed");
    $image;

    if(mysqli_num_rows($resultfind)>0){
        while($row=mysqli_fetch_assoc($resultfind)){
            $image = $row['image'];
        }
    }

    $sqldelete = "DELETE FROM usersdata WHERE id={$deleteid}";
    $result = mysqli_query($connection,$sqldelete) or die("query failed");

    // deleting server image
    $imagedelete = 'server_images/'.$image;
    unlink($imagedelete);

    $_SESSION['status'] = "<h2 style='display: block; padding: 1rem 3rem; text-align: center; width: fit-content;
    background-color: #ffe3e3; border: #fa5252 1px solid; color: #fa5252;
    position: absolute; top: 2%; left: 50%; transform: translateX(-50%); border-radius: 2px;'>
    Data deleted successfully.</h2>";

    header("Location: data_page.php");
?>
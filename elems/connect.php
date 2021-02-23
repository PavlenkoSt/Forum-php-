<?php
    session_start();
    $host = 'localhost';
    $user = 'root';
    $password = '';
    $dbName = 'Forum';

    $link = mysqli_connect($host, $user, $password, $dbName) or die(mysqli_error($link));
    mysqli_query($link, 'SET_Names "utf8"');
    
    $id = $_SESSION['id'];
?>
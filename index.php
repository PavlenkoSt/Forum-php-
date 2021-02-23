<?php
    include 'elems/connect.php';
    if(isset($_SESSION['auth'])){
        $content = '';
    }else{
        header('Location: /login.php'); die();
    }
    $title = 'Главная';
    include 'elems/layout.php';
?>
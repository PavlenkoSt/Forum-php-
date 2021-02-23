<?php
    include 'elems/connect.php';

    $getQuery = "SELECT * from users";
    $result = mysqli_query($link, $getQuery) or die(mysqli_error($link));
    for($data = []; $row = mysqli_fetch_assoc($result);$data[] = $row);
    
    $title = 'Все люди';

    ob_start();
    include 'elems/users-list.php';
    $content = ob_get_clean();

    include 'elems/layout.php';
?>
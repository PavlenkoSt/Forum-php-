<?php
    include 'elems/connect.php';

    if(isset($_GET['id'])){
        $getQuery = "SELECT * from users WHERE id='{$_GET['id']}'";
    }else{
        $getQuery = "SELECT * from users WHERE id='$id'";
    }
        $result = mysqli_query($link, $getQuery) or die(mysqli_error($link));
        $result = mysqli_fetch_assoc($result);
        $title = $result['login'];
        $content = "<div>Логин: {$result['login']} <br>
            Дата рождения: {$result['dateBirth']}";
            if($result['id'] == $id){
                $content .= '<br><br><a href="personalArea.php">Редактировать профиль</a></div>';
            }else{
                $content .= '</div>';
            }
    include 'elems/layout.php';
?>
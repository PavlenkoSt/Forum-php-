<?php
    include 'elems/connect.php';

    if(!empty($_SESSION['auth'])){

        $getQuery = "SELECT * from users WHERE id='$id'";
        $result = mysqli_query($link, $getQuery) or die(mysqli_error($link));
        $result = mysqli_fetch_assoc($result);
        $hash = $result['password'];
        if(!empty($_POST['pass'])){
            if(password_verify($_POST['pass'], $hash)){
                $removeQuery = "DELETE FROM users WHERE id='$id'";
                mysqli_query($link, $removeQuery) or die(mysqli_error($link));
                $_SESSION['mess'] = [
                    'text' => "Аккаунт успешно удален!",
                    'status' => 'ok'
                ];
                $_SESSION['auth'] = null;
            }else{
                $_SESSION['mess'] = [
                    'text' => "Пароль введен неверно!",
                    'status' => 'err'
                ];
            }
        }
        $title = 'Удалить профиль';

        ob_start();
        include 'elems/delProf-form.php';
        $content = ob_get_clean();
    
        include 'elems/layout.php';
    }else{
        header('Location: /login.php'); die(); 
    }
?>
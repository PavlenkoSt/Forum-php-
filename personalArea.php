<?php
    include 'elems/connect.php';

    if(!empty($_SESSION['auth'])){
        if(!empty($_POST['login']) && !empty($_POST['email']) && !empty($_POST['date'])){
            $login = $_POST['login'];
            $email = $_POST['email'];
            $date = $_POST['date'];
            $id = $_SESSION['id'];

            $updateQuery = "UPDATE users SET login='$login', email='$email', dateBirth='$date' WHERE id='$id'";
            mysqli_query($link, $updateQuery) or die(mysqli_error($link));

            $_SESSION['mess'] = [
                'text' => "Данные успешно редактированы!",
                'status' => 'ok'
            ];
        }
        $getQuery = "SELECT * from users WHERE id='$id'";
        $result = mysqli_query($link, $getQuery) or die(mysqli_error($link));
        $result = mysqli_fetch_assoc($result);
    }else{
        header('Location: /login.php'); die();
    }
    $title = 'Редактировать профиль';
    
    ob_start();
    include 'elems/edit-form.php';
    $content = ob_get_clean();

    include 'elems/layout.php';
?>

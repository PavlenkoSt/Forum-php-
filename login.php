<?php 
    include 'elems/connect.php';

    if(!empty($_POST['login']) && !empty($_POST['pass'])){
        $login = $_POST['login'];

        $getQuery = "SELECT * from statuses
            LEFT JOIN users ON users.status_id=statuses.id WHERE login='$login'";
        // $getQuery = "SELECT *, statuses.status as status from users
        //     LEFT JOIN statuses ON users.status_id=statuses.id WHERE login='$login'";
        $get = mysqli_query($link, $getQuery) or die(mysqli_error($link));
        $user = mysqli_fetch_assoc($get);
        if(!empty($user)){
            $hash = $user['password'];
            if(password_verify($_POST['pass'], $hash)){
                $getQuery = "SELECT * from statuses
                    LEFT JOIN users ON users.status_id=statuses.id WHERE login='$login' AND password='$hash'";
                // $getQuery = "SELECT *, statuses.status as status from users
                //     LEFT JOIN statuses ON users.status_id=statuses.id WHERE login='$login' AND password='$hash'";
                $result = mysqli_query($link, $getQuery) or die(mysqli_error($link));
                $result = mysqli_fetch_assoc($result);
            }else{
                $_SESSION['mess'] = [
                    'text' => 'Пара логин-пароль не подходит!',
                    'status' => 'err'
                ];
            }
        }else{
            $_SESSION['mess'] = [
                'text' => 'Пользователя с таким логином нет!',
                'status' => 'err'
            ];
        }
    }
    if(!empty($result)){
        if($result['banned']==0){
            $_SESSION['auth'] = $result['login'];
            $_SESSION['mess'] = [
                'text' => "Вы вошли как {$_SESSION['auth']}",
                'status' => 'ok'
            ];
            $_SESSION['id'] = $result['id'];
            $_SESSION['status'] = $result['status'];
            header('Location: /'); die();
        }else{
            $_SESSION['mess'] = [
                'text' => 'Вы забанены!',
                'status' => 'err'
            ];
        }
        $content = '';
    }else{
        ob_start();
        include 'elems/login.php';
        $content = ob_get_clean();

        if(isset($login) && isset($password)){
            $_SESSION['mess'] = [
                'text' => 'Неверное имя пользователя или пароль!',
                'status' => 'err'
            ];
        }
    }
    $title = 'Войти';
    include 'elems/layout.php';
?>
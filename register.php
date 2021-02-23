<?php 
    include 'elems/connect.php';

    if(!empty($_POST['login']) && !empty($_POST['pass']) && !empty($_POST['email']) && !empty($_POST['dateBirth'])){
        $login = $_POST['login'];
       
        $password = $_POST['pass'];
        $confirm =$_POST['confirm'];
        $dateBirth = $_POST['dateBirth'];
        $email = $_POST['email'];
        $regDate = date('Y-m-d');

        if(preg_match('#\w{4,12}#', $login) && preg_match('#.{4,12}#', $password) && $password == $confirm && isLogin($login, $link)){
            $password = password_hash($password, PASSWORD_DEFAULT);

            $setQuery = "INSERT INTO users SET login='$login', password='$password', email='$email', dateBirth='$dateBirth', registrationDate='$regDate', status_id='1', banned='0'";
            mysqli_query($link, $setQuery) or die(mysqli_error($link));

            $_SESSION['auth'] = $login;
            $_SESSION['mess'] = [
                'text' => "Вы вошли как {$_SESSION['auth']}",
                'status' => 'ok'
            ];

            // $getQuery = "SELECT id, statuses.status as status from users 
            //     LEFT JOIN statuses ON statuses.id=users.status_id WHERE login='$login'";
            $getQuery = "SELECT * from statuses
                LEFT JOIN users ON users.status_id=statuses.id WHERE login='$login'";
            $result = mysqli_query($link, $getQuery) or die(mysqli_error($link));
            $result = mysqli_fetch_assoc($result);

            $_SESSION['id'] = $result['id'];
            $_SESSION['status'] = $result['status'];
            header('Location: /'); die();
        }

    }else{
        $login = '';
        $dateBirth = '';
        $email = '';
        $regDate = '';
        $password = '';
        $confirm = '';
    }
    function isLogin($login, $link){
        $getQuery = "SELECT * FROM users WHERE login='$login'";
        $result = mysqli_query($link, $getQuery) or die(mysqli_error($link));
        $user = mysqli_fetch_assoc($result);
        if(empty($user)){
            return true;
        }else{
            return false;
        }
    }
    include 'elems/register.php';
?>


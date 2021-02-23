<?php
    include 'elems/connect.php';

    if(!empty($_SESSION['auth'])){
        $getQuery = "SELECT * from users WHERE id='$id'";
        $result = mysqli_query($link, $getQuery) or die(mysqli_error($link));
        $result = mysqli_fetch_assoc($result);

        $hash = $result['password'];
        if(!empty($_POST['old']) && !empty($_POST['new']) && !empty($_POST['confirm'])){
            if(password_verify($_POST['old'], $hash)){
                if(preg_match('#.{4,12}#', $_POST['new'])){
                    if($_POST['new'] == $_POST['confirm']){
                        $newPass = password_hash($_POST['new'], PASSWORD_DEFAULT);
                        $updateQuery = "UPDATE users SET password='$newPass' WHERE id='$id'";
                        mysqli_query($link, $updateQuery) or die(mysqli_error($link));

                        $_SESSION['mess'] = [
                            'text' => "Пароль успешно изменен!",
                            'status' => 'ok'
                        ];

                    }else{
                        $_SESSION['mess'] = [
                            'text' => "Пароли не совпадают!",
                            'status' => 'err'
                        ];
                    }
                }else{
                    $_SESSION['mess'] = [
                        'text' => "Пароль должен содержать от 4 до 12 символов!",
                        'status' => 'err'
                    ];
                }
            }else{
                $_SESSION['mess'] = [
                    'text' => "Старый пароль введен неверно!",
                    'status' => 'err'
                ];
            }
        }
    }else{
        header('Location: /login.php'); die();
    }
    $title = 'Изменить пароль';

    ob_start();
    include 'elems/password-form.php';
    $content = ob_get_clean();

    include 'elems/layout.php';
?>

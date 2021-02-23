<?php
    session_start();
    $_SESSION['auth'] = null;
    $_SESSION['id'] = null;
    $_SESSION['status'] = null;
    $_SESSION['mess'] = [
        'text' => 'Вы успешно вышли!',
        'status' => 'ok'
    ];
    header('Location: index.php');
?>
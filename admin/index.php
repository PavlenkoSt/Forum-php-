<?php
    include '../elems/connect.php';
    if(!empty($_SESSION['auth']) && $_SESSION['status'] == 'admin'){
        function deleleUser($link){
            if(!empty($_GET['del'])){
                $deleteQuery = "DELETE from users WHERE id={$_GET['del']}";
                mysqli_query($link, $deleteQuery) or die(mysqli_error($link));
                $_SESSION['mess'] = [
                    'text' => "Пользователь успешно удален",
                    'status' => 'ok'
                ];
            }
        }
        function changeStatus($link){
            if(!empty($_GET['chg'])){
                $getQuery = "SELECT status_id from users WHERE id='{$_GET['chg']}'";
                $result = mysqli_query($link, $getQuery) or die(mysqli_error($link));
                $result = mysqli_fetch_assoc($result);
    
                if($result['status_id'] == 1){
                    $newStatus = 2;
                }elseif($result['status_id'] == 2){
                    $newStatus = 1;
                }
    
                $updateQuery = "UPDATE users SET status_id='$newStatus' WHERE id={$_GET['chg']}";
                mysqli_query($link, $updateQuery) or die(mysqli_error($link));
    
                $_SESSION['mess'] = [
                    'text' => "Статус пользователя успешно изменен",
                    'status' => 'ok'
                ];
            }
        }
        function banned($link){
            if(!empty($_GET['ban'])){
                $getQuery = "SELECT banned from users WHERE id='{$_GET['ban']}'";
                $result = mysqli_query($link, $getQuery) or die(mysqli_error($link));
                $banned = mysqli_fetch_assoc($result);
                if($banned['banned'] == 0){
                    $ban = 1;
                    $_SESSION['mess'] = [
                        'text' => "Пользователь забанен",
                        'status' => 'ok'
                    ];
                }else{
                    $ban = 0;
                    $_SESSION['mess'] = [
                        'text' => "Пользователь разбанен",
                        'status' => 'ok'
                    ];
                }
                $updateQuery = "UPDATE users SET banned='$ban' WHERE id='{$_GET['ban']}'";
                mysqli_query($link, $updateQuery) or die(mysqli_error($link));
            }
        }
      
        deleleUser($link);
        changeStatus($link);
        banned($link);

        $getQuery = "SELECT *, users.id as usersId, statuses.status as status from users 
            LEFT JOIN statuses ON users.status_id=statuses.id";
        $result = mysqli_query($link, $getQuery) or die(mysqli_error($link));
        for($data = []; $row = mysqli_fetch_assoc($result);$data[] = $row);

        ob_start();
        include 'elems/users-table.php';
        $content = ob_get_clean();

        include 'elems/layout.php';
    }
?>
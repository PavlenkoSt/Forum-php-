<?php
    include 'elems/connect.php';
    if(isset($_SESSION['auth'])){
        if(!empty($_GET['page'])){
            function addMessage($link) {
                if(!empty($_POST['message'])){
                    $setQuery = "INSERT INTO messages SET message='{$_POST['message']}'";
                    mysqli_query($link, $setQuery) or die(mysqli_error($link));
    
                    $getQuery = "SELECT MAX(id) as maxId FROM messages";
                    $result = mysqli_query($link, $getQuery) or die(mysqli_error($link));
                    $maxId = mysqli_fetch_assoc($result)['maxId'];
                    $date = date('Y-m-d');
    
                    $setQuery = "INSERT INTO mess_of_diss (diss_id, mess_id, author_id, date) 
                    VALUES ('{$_GET['page']}', '$maxId', '{$_SESSION['id']}', '$date')";
                    mysqli_query($link, $setQuery) or die(mysqli_error($link));
    
                    $_SESSION['mess'] = [
                        'text' => 'Сообщение успешно добавлено!',
                        'status' => 'ok'
                    ];
                }
            }
            function deleteMessage($link){
                if(!empty($_POST['delete'])){
                    $getQuery = "SELECT mess_id FROM mess_of_diss WHERE id='{$_POST['delete']}'";
                    $result = mysqli_query($link, $getQuery) or die(mysqli_error($link));
                    $idMessage = mysqli_fetch_assoc($result)['mess_id'];

                    $deleteQuery = "DELETE FROM messages WHERE id='$idMessage'";
                    mysqli_query($link, $deleteQuery) or die(mysqli_error($link));
                    $deleteQuery = "DELETE FROM mess_of_diss WHERE id='{$_POST['delete']}'";
                    mysqli_query($link, $deleteQuery) or die(mysqli_error($link));

                    $_SESSION['mess'] = [
                        'text' => 'Сообщение успешно удалено!',
                        'status' => 'ok'
                    ];
                }
            }
            deleteMessage($link);
            addMessage($link);

            $getQuery = "SELECT mess_of_diss.id as mesID, users.login, mess_of_diss.date, messages.message, discusses.discuss, users.status_id FROM mess_of_diss
            LEFT JOIN messages ON mess_of_diss.mess_id=messages.id
            LEFT JOIN users ON mess_of_diss.author_id=users.id
            LEFT JOIN discusses ON mess_of_diss.diss_id=discusses.id
            WHERE mess_of_diss.diss_id='{$_GET['page']}' GROUP BY mess_of_diss.id";
            $result = mysqli_query($link, $getQuery) or die(mysqli_error($link));
            for($data = []; $row = mysqli_fetch_assoc($result);$data[] = $row);

            ob_start();
            include 'elems/discuss-page.php';
            $content = ob_get_clean();

            ob_start();
            include 'elems/add-mess.php';
            $content .= ob_get_clean();
        }else{
            header('Location: /discusses.php'); die();
        }
    }else{
        header('Location: /login.php'); die();
    }
    $title = 'Обсуждение';
    include 'elems/layout.php';
?>
<?php
    include '../elems/connect.php';    
    if(!empty($_SESSION['auth']) && $_SESSION['status'] == 'admin'){
        function addDiscuss($link){
            if(!empty($_GET['add'])){
                $updateQuery = "UPDATE discusses SET admin_true='1' WHERE id='{$_GET['add']}'";
                mysqli_query($link, $updateQuery) or die(mysqli_error($link));
                
                $_SESSION['mess'] = [
                    'text' => 'Обсуждение успешно добавлено на форум!',
                    'status' => 'ok'
                ];
            }
        }
        function deleteDiscuss($link){
            if(!empty($_GET['del'])){
                $getQuery = "SELECT *, discusses.id as disID, mess_of_diss.id as messOfDisId, messages.id as messId FROM discusses 
                    LEFT JOIN mess_of_diss ON discusses.id=mess_of_diss.diss_id
                    LEFT JOIN messages ON mess_of_diss.mess_id=messages.id WHERE discusses.id='{$_GET['del']}'";
                $result = mysqli_query($link, $getQuery) or die(mysqli_error($link));
                $result = mysqli_fetch_assoc($result);

                $disID = $result['disID'];
                $messOfDisId = $result['messOfDisId'];
                $messId = $result['messId'];

                $deleteQuery = "DELETE FROM discusses WHERE id='$disID'";
                mysqli_query($link, $deleteQuery) or die(mysqli_error($link));

                $deleteQuery = "DELETE FROM mess_of_diss WHERE id='$messOfDisId'";
                mysqli_query($link, $deleteQuery) or die(mysqli_error($link));
                
                $deleteQuery = "DELETE FROM messages WHERE id='$messId'";
                mysqli_query($link, $deleteQuery) or die(mysqli_error($link));

                $_SESSION['mess'] = [
                    'text' => 'Обсуждение успешно удалено!',
                    'status' => 'ok'
                ];
            }
        }
        addDiscuss($link);
        deleteDiscuss($link);

        $getQuery = "SELECT *, discusses.date as dissDate, discusses.id as disID FROM discusses 
            LEFT JOIN users ON discusses.author_id=users.id
            LEFT JOIN categories ON discusses.category_id=categories.id 
            LEFT JOIN mess_of_diss ON discusses.id=mess_of_diss.diss_id
            LEFT JOIN messages ON mess_of_diss.mess_id=messages.id
            WHERE admin_true='0'";
        $result = mysqli_query($link, $getQuery) or die(mysqli_error($link));
        for($data = []; $row = mysqli_fetch_assoc($result);$data[] = $row);

        $title = 'ADMIN | Обсуждения';

        ob_start();
        include 'elems/discuss-table.php';
        $content = ob_get_clean();

        include 'elems/layout.php';
    }
?>
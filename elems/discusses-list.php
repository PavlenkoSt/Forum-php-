<?php
    if($_SESSION['status'] == 'admin'){
        function deleteDiscuss($link){
            if(!empty($_GET['del'])){

                $getQuery = "SELECT *, discusses.id as disId, mess_of_diss.diss_id as messOfDisId, messages.id as messId FROM discusses 
                    LEFT JOIN mess_of_diss ON discusses.id=mess_of_diss.diss_id
                    LEFT JOIN messages ON mess_of_diss.mess_id=messages.id WHERE discusses.id='{$_GET['del']}'";
                $result = mysqli_query($link, $getQuery) or die(mysqli_error($link));
                for($data = []; $row = mysqli_fetch_assoc($result);$data[] = $row);

                foreach($data as $delInfo){
                    $deleteQuery = "DELETE FROM discusses WHERE id='{$delInfo['disId']}'";
                    mysqli_query($link, $deleteQuery) or die(mysqli_error($link));

                    $deleteQuery = "DELETE FROM mess_of_diss WHERE diss_id='{$delInfo['messOfDisId']}'";
                    mysqli_query($link, $deleteQuery) or die(mysqli_error($link));
                    
                    $deleteQuery = "DELETE FROM messages WHERE id='{$delInfo['messId']}'";
                    mysqli_query($link, $deleteQuery) or die(mysqli_error($link));
                }
            }
        }
        deleteDiscuss($link);
    }

    $getQuery = "SELECT *, discusses.date as dissDate, discusses.id as disID FROM discusses
        LEFT JOIN categories ON categories.id=discusses.category_id
        LEFT JOIN users ON users.id=discusses.author_id";
    $result = mysqli_query($link, $getQuery) or die(mysqli_error($link));
    for($data = []; $row = mysqli_fetch_assoc($result);$data[] = $row);
?>
<h2 class="mt-3">Последние обсуждения</h2>
<div class="list-group mt-3 mb-5">
    <?php
        foreach($data as $disc):

            $getQuery = "SELECT MAX(mess_of_diss.id) as lastIter FROM mess_of_diss 
                LEFT JOIN messages ON mess_of_diss.mess_id=messages.id WHERE mess_of_diss.diss_id={$disc['disID']}";
            $result = mysqli_query($link, $getQuery) or die(mysqli_error($link));
            $lastIter = mysqli_fetch_assoc($result)['lastIter'];

            $getQuery = "SELECT * FROM mess_of_diss 
                LEFT JOIN messages ON mess_of_diss.mess_id=messages.id 
                LEFT JOIN users ON mess_of_diss.author_id=users.id
                WHERE mess_of_diss.id='$lastIter'";
            $result = mysqli_query($link, $getQuery) or die(mysqli_error($link));
            $mess = mysqli_fetch_assoc($result);
    ?>
        <a href="/discussPage.php?page=<?=$disc['disID']?>" class="list-group-item list-group-item-action" aria-current="true">
            <div class="d-flex w-100 justify-content-between">
            <h5 class="mb-1"><?=$disc['discuss']?></h5>
            <small>от <?=$disc['dissDate']?></small>
            </div>
            <p class="mb-1">Категория: <?=$disc['category']?></p>
            <small>Последний ответ от <?=$mess['login']?>: <?=$mess['message']?></small>
            <?php
                if($_SESSION['status'] == 'admin'){
                    ?>
                    <a href="?del=<?=$disc['mesID']?>" class="btn btn-danger">Удалить</a>
                    <?php
                }
            ?>
        </a>
    <?php
        endforeach;
    ?>
</div>
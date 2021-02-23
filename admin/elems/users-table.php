<table class="table caption-top">
    <caption>Все пользователи</caption>
    <thead>
        <tr class="fw-bold">
            <td>Логин</td>
            <td>Статус</td>
            <td>Забанен</td>
            <td>Бан</td>
            <td>Изменить права</td>
            <td>Удалить</td>
        </tr>
    </thead> 
    <?php
        foreach($data as $user):
    ?>
    <tr
        <?php
            if($user['status'] == 'admin'){
                $class = 'table-primary';
            }else{
                $class = 'table-light';
            }
            if($user['banned']=='1'){
                $class = 'table-danger';
            }
            echo "class=\"$class\"";
        ?>
    >
        <td><?=$user['login']?></td>
        <td><?=$user['status']?></td>
        <td>
            <?php
                if($user['banned']=='1'){
                    echo 'Да';
                }else{
                    echo 'Нет';
                }
            ?>
        </td>
        <td><a href="?ban=<?=$user['usersId']?>">
            <?php
                if($user['banned']=='1'){
                    echo 'Разбанить';
                }else{
                    echo 'Забанить';
                }
            ?>
        </a></td>
        <td><a href="?chg=<?=$user['usersId']?>">
            <?php
                if($user['status']=='admin'){
                    echo "Сделать юзером";
                }elseif($user['status']=='user'){
                    echo "Сделать админом";
                }
                
            ?>
        </a></td>
        <td><a href="?del=<?=$user['usersId']?>">Удалить</a></td>
    </tr>
    <?php
        endforeach;
    ?>
</table>
<?php
    if(!empty($data)){
?>
<table class="table caption-top table-bordered">
    <caption>Запросы на обсуждения</caption>
    <thead>
        <tr class="fw-bold">
            <td>Тема</td>
            <td>Категория</td>
            <td>Автор</td>
            <td>Дата</td>
            <td>Сообщение</td>
            <td>Одобрить</td>
            <td>Удалить</td>
        </tr>
    </thead> 
    <?php
        foreach($data as $discuss):
    ?>
    <tr>
        <td class='align-middle'><?=$discuss['discuss']?></td>
        <td class='align-middle'><?=$discuss['category']?></td>
        <td class='align-middle'><?=$discuss['login']?></td>
        <td class='align-middle'><?=$discuss['dissDate']?></td>
        <td class='align-middle'><?=$discuss['message']?></td>
        <td class='align-middle'><a href="?add=<?=$discuss['disID']?>" class="btn btn-success">Одобрить</a></td>
        <td class='align-middle'><a href="?del=<?=$discuss['disID']?>" class="btn btn-danger">Удалить</a></td>
    </tr>
    <?php
        endforeach;
    ?>
</table>
<?php
    }else{
        echo '<p>Запросов на обсуждения пока нет.</p>';
    }
?>
<?php
    foreach($data as $user):
?>
    <a href="profile.php?id=<?=$user['id']?>"><?=$user['login']?></a><br>
<?php
    endforeach;
?>  
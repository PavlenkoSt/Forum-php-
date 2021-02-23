<?php
    if(!empty($_SESSION['auth'])){
        $getQuery = "SELECT *, statuses.status as status from users 
            LEFT JOIN statuses ON statuses.id=users.status_id WHERE users.id='$id'";
        $result = mysqli_query($link, $getQuery) or die(mysqli_error($link));
        $result = mysqli_fetch_assoc($result);
        
        $login = $result['login'];
        $status = $result['status'];
?>
    <div class="col-4 row justify-content-start">
        <div class="col text-white text-center">Логин: <?=$login?></div>
        <div class="col text-white text-center">Статус: <?=$status?></div>
        <?php
            if($_SESSION['status'] == 'admin'){
                ?>
                    <div class="col nav-item dropdown text-center">
                        <a class="nav-link dropdown-toggle link-warning" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Админ-панель
                        </a>
                        <ul class="dropdown-menu w-100" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="/admin">Пользователи</a></li>
                            <li><a class="dropdown-item" href="/admin/discusses.php">Обсуждения</a></li>
                        </ul>
                    </div>
                <?php
            }
        ?>
    </div>
    <nav class="col-8 navbar justify-content-end fw-bold">
        <a class="nav-link link-warning" href="/discusses.php">Обсуждения</a><br>
        <a class="nav-link link-warning" href="/users.php">Все люди</a><br>
        <a class="nav-link link-warning" href="/profile.php?id=<?=$_SESSION['id']?>">Профиль</a><br>
        <a class="nav-link link-warning" href="/logout.php">Выйти</a><br>
    </nav>
<?php
        }
?>

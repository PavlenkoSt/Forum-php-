<form action="" method="POST">
    <h2>Регистрация:</h2>
    <?php
        if(!preg_match('#\w{4,12}#', $login) && !empty($_POST['login'])) echo 'Логин должен содержать только латинские буквы и цифры, от 4 до 12 символов<br>';
        if(!isLogin($login, $link) && !empty($_POST['login'])) echo 'Логин занят<br>';
    ?>
    <div class="form-floating mb-3">
            <input type="text" value="<?=$login?>" name="login" class="form-control" id="floatingInput">
            <label for="floatingInput">Логин:</label>
    </div>
    <?php
        if(!preg_match('#.{4,12}#', $password) && !empty($_POST['pass'])) echo 'Пароль должен содержать от 4 до 12 символов<br>';
        if(($password != $confirm) && !empty($_POST['pass']) && !empty($_POST['confirm'])) echo 'Пароли не совпадают<br>';
    ?> 
    <div class="form-floating mb-3">
            <input type="password" name="pass" class="form-control" id="floatingInput">
            <label for="floatingInput">Пароль:</label>
    </div>
    <div class="form-floating mb-3">
            <input type="password" name="confirm" class="form-control" id="floatingInput">
            <label for="floatingInput">Подтвердите пароль:</label>
    </div>
    <div class="form-floating mb-3">
            <input type="email" value="<?=$email?>" name="email" class="form-control" id="floatingInput">
            <label for="floatingInput">E-mail:</label>
    </div>
    <div class="form-floating mb-3">
            <input type="date" value="<?=$dateBirth?>" name="dateBirth" class="form-control" id="floatingInput">
            <label for="floatingInput">Дата рождения:</label>
    </div>
    <input class="btn btn-success mb-3" type="submit" value="Отправить">

    <p>Уже есть аккаунт? <a href="login.php">Войти</a></p>
</form>
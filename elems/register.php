<form action="" method="POST">
Регистрация:<br>
    <?php
        if(!preg_match('#\w{4,12}#', $login) && !empty($_POST['login'])) echo 'Логин должен содержать только латинские буквы и цифры, от 4 до 12 символов<br>';
        if(!isLogin($login, $link) && !empty($_POST['login'])) echo 'Логин занят<br>';
    ?>
    Логин:
    <input type="text" value="<?=$login?>" name="login"><br>
    <?php
        if(!preg_match('#.{4,12}#', $password) && !empty($_POST['pass'])) echo 'Пароль должен содержать от 4 до 12 символов<br>';
        if(($password != $confirm) && !empty($_POST['pass']) && !empty($_POST['confirm'])) echo 'Пароли не совпадают<br>';
    ?> 
    Пароль:
    <input type="password" name="pass"><br>
    Подтвердите пароль:
    <input type="password" name="confirm"><br>
    E-mail:
    <input type="email" value="<?=$email?>" name="email"><br>
    Дата рождения:
    <input type="date" value="<?=$dateBirth?>" name="dateBirth"><br>

    <input type="submit" value="Отправить"><br>
    Уже есть аккаунт? <a href="login.php">Войти</a>


</form>
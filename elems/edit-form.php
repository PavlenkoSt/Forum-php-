<form action="" method="POST">
    <div class="form-floating mb-3">
        <input type="text" class="form-control" id="floatingInput" name="login" value="<?=$result['login']?>">
        <label for="floatingInput">Логин</label>
    </div>
    <div class="form-floating mb-3">
        <input type="email" class="form-control" id="floatingInput" name="email" value="<?=$result['email']?>">
        <label for="floatingInput">E-mail</label>
    </div>
    <div class="form-floating mb-3">
        <input type="date" class="form-control" id="floatingInput" name="date" value="<?=$result['dateBirth']?>">
        <label for="floatingInput">Дата рождения</label>
    </div>
    <input class="btn btn-success mb-3" type="submit" value="Редактировать">
</form>
<a href="changePassword.php">Изменить пароль</a>
<a href="deleteProfile.php">Удалить профиль</a>
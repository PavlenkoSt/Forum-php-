<?php
    if(!empty($_SESSION['auth'])){
?>
        <form action="" method="POST">
        <p class="mb-1">Для удаления аккаунта введите пароль:</p>
        <div class="form-floating mb-3">
            <input type="password" name="pass" class="form-control" id="floatingInput">
            <label for="floatingInput">Пароль</label>
        </div>
            <input class="btn btn-success mb-3" type="submit" value="Удалить">
        </form>
<?php
    }else{
        echo '<a href="login.php">Войти</a>';
    }
?>
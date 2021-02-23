<h2>Добавить новое обсуждение</h2>
<form action="" method="POST" class="mt-3">
    <div class="form-floating mb-3">
        <input type="text" class="form-control" id="floatingInput" name="topic">
        <label for="floatingInput">Тема</label>
    </div>
    <div class="form-floating">
        <select class="form-select mb-3" aria-label="Default select" name="category">
            <option value="1">IT-технологии</option>
            <option value="2">Здоровье</option>
            <option value="3">Литература</option>
            <option value="4">Философия и психология</option>
            <option value="5">Астрономия</option>
            <option value="6">Другое</option>
        </select>
        <label for="floatingSelect">Категория</label>
    </div>
    <div class="form-floating mb-3">
        <textarea class="form-control" id="floatingTextarea2" style="height: 100px" name="message"></textarea>
        <label for="floatingTextarea2">Первое сообщение</label>
    </div>
    <input class="btn btn-success mb-3" type="submit" value="Добавить">
</form>
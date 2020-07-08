<div class="border-div-container-login">
<div class="container">
    <label >Вход в панель Администратора</label>
        <div class="card-body">
            <form action="/application/admin/login" method="post">
                <div class="form-group">
                    <label>Логин</label>
                    <input class="form-control" type="text" name="login">
                </div>
                <div class="form-group">
                    <label>Пароль</label>
                    <input class="form-control" type="password" name="password">
                </div><br/>
                <button type="submit" class="btn btn-primary btn-block">Вход</button>
            </form>
        </div>
</div>
</div>
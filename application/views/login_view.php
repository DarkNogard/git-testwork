<form class="form-signin" action="" method="post">
        <h1>Авторизации</h1>
        <label for="inputEmail" class="sr-only">Email address</label>
        <input name="login" type="text" id="inputEmail" class="form-control" placeholder="Логин" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input name="password" type="password" id="inputPassword" class="form-control" placeholder="Пароль" required>
        <?php extract($data); ?>
        <?php if($login_status=="access_granted") { ?>
        <p style="color:green">Авторизация прошла успешно.</p>
        <?php } elseif($login_status=="access_denied") { ?>
        <p style="color:red">Логин и/или пароль введены неверно.</p>
        <?php } ?>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Войти</button>
</form>


<?
$page_title = 'Авторизация'
?>

<? include 'base/header.php' ?>

<form class="form-signin text-center" method="post" action="/login">
    <h1 class="h3 mb-3 font-weight-normal">Авторизация</h1>
    <div class="form-group">
        <label for="login" class="sr-only">Логин</label>
        <input
            type="text"
            id="login"
            name="login"
            class="form-control<? echo isset($errors['login_or_password']) ? (' is-invalid') : '' ?>"
            placeholder="Логин"
            required
            autofocus
            value="<? echo $login ?>"
        >
        <? if (isset($errors['login_or_password'])) { ?>
            <div class="invalid-feedback">
                <? echo $errors['login_or_password'] ?>
            </div>
        <? } ?>
    </div>

    <div class="form-group">
        <label for="inputPassword" class="sr-only">Пароль</label>
        <input
            type="password"
            name="password"
            id="inputPassword"
            class="form-control<? echo isset($errors['login_or_password']) ? (' is-invalid') : '' ?>"
            placeholder="Пароль"
            required
        >
        <? if (isset($errors['login_or_password'])) { ?>
            <div class="invalid-feedback">
                <? echo $errors['login_or_password'] ?>
            </div>
        <? } ?>
    </div>

    <button class="btn btn-lg btn-primary btn-block" type="submit">Авторизоваться</button>
</form>

<? include 'base/footer.php' ?>

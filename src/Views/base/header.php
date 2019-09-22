<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <title><? echo $page_title ?></title>


    <!-- Bootstrap core CSS -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/styles.css" rel="stylesheet">
    <script src="/js/jquery-3.4.1.min.js"></script>
    <script src="/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<div class="container">
    <header class="blog-header py-3">
        <div class="row flex-nowrap justify-content-between align-items-center">
            <div class="col-4 pt-1">
                <a class="text-muted" href="/">Тестовое задание</a>
            </div>
            <div class="col-4 text-center">
                <a class="blog-header-logo text-dark" href="/">BeeJee</a>
            </div>
            <div class="col-4 d-flex justify-content-end align-items-center">
                <? if($user['id']) { ?>
                    <a class="btn btn-sm btn-outline-secondary" href="/logout">Выйти</a>
                <? } else {?>
                    <a class="btn btn-sm btn-outline-secondary" href="/login">Авторизация</a>
                <? } ?>

            </div>
        </div>
    </header>
</div>


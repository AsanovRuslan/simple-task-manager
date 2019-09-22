<?
$page_title = 'Задача №' . $task->id;

?>

<? include __DIR__ . '/../base/header.php' ?>

    <div class="container">

        <? if (isset($_SESSION['flash']['message'])) {?>
            <p class="alert alert-primary">
                <? echo $_SESSION['flash']['message'] ?>
            </p>
        <? } ?>

        <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
            <div class="col p-4 d-flex flex-column position-static">
                <strong class="d-inline-block mb-2 text-primary">
                    <? echo htmlspecialchars($task->username) . ' ' . htmlspecialchars($task->email) ?>
                </strong>
                <h3 class="mb-3">
                    <? echo $page_title ?>
                </h3>
                <p class="card-text mb-auto"><? echo htmlspecialchars($task->text) ?></p>
                <? if ($user['id'] && $task->id) { ?>
                    <a href="/task/<? echo $task->id ?>/edit">Редактировать</a>
                <? } ?>
            </div>
        </div>
    </div>

<? include __DIR__ . '/../base/footer.php' ?>
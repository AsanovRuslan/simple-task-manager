<?
$page_title = 'Список задач';
?>

<? include __DIR__ . '/../base/header.php' ?>

    <div class="container">

        <div class="my-3 p-3 bg-white rounded box-shadow">
            <h6 class="border-bottom border-gray pb-2 mb-0 clearfix row align-items-center">
                <div class="col-4">
                    Список задач
                </div>
                <div class="col-4">
                    <form action="/" method="get" title="Сортировать по:">
                        <input type="hidden" name="page" value="1">
                        <div class="row justify-content-center align-items-center">
                            <div class="col-auto">
                                <select class="form-control form-control-sm" name="order_by">
                                    <option value="">По умолчанию</option>
                                    <? foreach ($sort_options as $key => $value) { ?>
                                        <option value="<? echo $key ?>" <? echo $order_by === $key ? 'selected' : '' ?>>
                                            <? echo $value ?>
                                        </option>
                                    <? } ?>
                                </select>
                            </div>
                            <div class="col-auto">
                                <button class="btn btn-sm btn-secondary" type="submit">Сортировать</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-4 clearfix">
                    <a href="/task/create" class="btn btn-sm btn-primary float-right">Создать задачу</a>
                </div>
            </h6>

            <? foreach ($tasks as $task) { ?>
                <div class="media text-muted pt-3">
                    <div class=" media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                        <div class="clearfix">
                            <a href="/task/<? echo $task->id ?>" class="text-gray-dark float-left">
                                <? echo htmlspecialchars($task->username) . ' ' . htmlspecialchars($task->email) ?>
                            </a>
                            <span class="float-right">
                                <? echo $task->done ? 'Завершена' : 'Не завершена' ?>
                            </span>
                        </div>
                        <? echo htmlspecialchars($task->text); ?>
                        <? if ($task->edited_by_admin) { ?>
                            <br>
                            <small>отредактировано администратором</small>
                        <? } ?>
                    </div>
                </div>
            <? } ?>

            <? if (empty($tasks)) { ?>
                <div class="alert alert-info mt-3">
                    Список задач пуст.
                </div>
            <? } ?>

            <nav class="mt-4">
                <ul class="pagination pagination-sm justify-content-center">
                    <?
                    $current_count = 0;

                    while ($current_count < $total_pages) {
                        $current_count++;
                        ?>
                        <? if ($current_count == $page) { ?>
                            <li class="page-item active" aria-current="page">
                                <span class="page-link">
                                    <? echo $current_count ?>
                                    <span class="sr-only">(current)</span>
                                </span>
                            </li>
                        <? } else { ?>
                            <li class="page-item">
                                <a class="page-link"
                                   href="/?page=<? echo $current_count ?>&order_by=<? echo $order_by ?>">
                                    <? echo $current_count ?>
                                </a>
                            </li>
                        <? } ?>
                    <? } ?>
                </ul>
            </nav>
        </div>

    </div>

<? include __DIR__ . '/../base/footer.php' ?>
<?
$page_title = 'Список задач';
?>

<? include __DIR__ . '/../base/header.php' ?>

    <div class="container">
        <form class="form-task-create text-center" method="post"
              action="<? echo $task->id ? "/task/$task->id" : '/task/create' ?>">
            <h1 class="h3 mb-3 font-weight-normal">
                <? echo $task->id ? 'Обновление задачи №' . $task->id : 'Создание задачи' ?>
            </h1>

            <div class="form-group">
                <label for="email" class="sr-only">Email</label>
                <input
                    <? echo $task->id ? 'readonly' : '' ?>
                    type="text"
                    id="email"
                    name="email"
                    class="form-control<? echo isset($errors['email']) ? (' is-invalid') : '' ?>"
                    placeholder="Email"
                    required
                    autofocus
                    value="<? echo $task->email ?>"
                >
                <? if (isset($errors['email'])) { ?>
                    <div class="invalid-feedback">
                        <? echo $errors['email'] ?>
                    </div>
                <? } ?>
            </div>

            <div class="form-group">
                <label for="login" class="sr-only">Имя пользователя</label>
                <input
                    <? echo $task->id ? 'readonly' : '' ?>
                    type="text"
                    id="username"
                    name="username"
                    class="form-control<? echo isset($errors['username']) ? (' is-invalid') : '' ?>"
                    placeholder="Имя пользователя"
                    required
                    value="<? echo $task->username ?>"
                >
                <? if (isset($errors['username'])) { ?>
                    <div class="invalid-feedback">
                        <? echo $errors['username'] ?>
                    </div>
                <? } ?>
            </div>

            <div class="form-group">
                <label for="login" class="sr-only">Описание задачи</label>
                <textarea
                    id="text"
                    name="text"
                    rows="10"
                    class="form-control<? echo isset($errors['text']) ? (' is-invalid') : '' ?>"
                    required
                    placeholder="Описание задачи"
                ><? echo $task->text ?></textarea>
                <? if (isset($errors['text'])) { ?>
                    <div class="invalid-feedback">
                        <? echo $errors['text'] ?>
                    </div>
                <? } ?>
            </div>

            <? if ($user['id']) { ?>
                <div class="form-group">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" name="done" id="done"
                               value="1" <? echo $task->done ? 'checked' : '' ?>>
                        <label class="custom-control-label" for="done">Задача выполнена</label>
                    </div>
                    <? if (isset($errors['text'])) { ?>
                        <div class="invalid-feedback">
                            <? echo $errors['text'] ?>
                        </div>
                    <? } ?>
                </div>
            <? } ?>

            <button class="btn btn-lg btn-primary btn-block" type="submit">
                <? echo $task->id ? 'Обновить' : 'Создать' ?>
            </button>
        </form>
    </div>

<? include __DIR__ . '/../base/footer.php' ?>
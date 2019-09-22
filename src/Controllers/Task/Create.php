<?php


namespace BeeJee\App\Controllers\Task;


use BeeJee\App\Controller;
use BeeJee\App\Models\Task;
use BeeJee\App\Models\User;
use BeeJee\App\Session;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\RedirectResponse;

class Create extends Controller
{
    /**
     * @var Task
     */
    private $task;
    /**
     * @var Session
     */
    private $session;

    public function __construct(Task $task, User $user, Session $session)
    {
        $this->task    = $task;
        $this->session = $session;

        parent::__construct($user);
    }

    public function __invoke(ServerRequestInterface $request, array $args = []): ResponseInterface
    {
        $params     = $request->getParsedBody();
        $email      = (string)($params['email'] ?? '');
        $username   = (string)($params['username'] ?? '');
        $text       = (string)($params['text'] ?? '');
        $done       = (bool)($params['done'] ?? false);
        $errors     = [];

        if (!$email) {
            $errors['email'] = 'Поле email обязательно для заполнения';
        }
        if ($email && filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            $errors['email'] = 'Введите валидный email';
        }
        if (!$username) {
            $errors['username'] = 'Поле с именем пользователя обязательно для заполнения';
        }
        if (!$text) {
            $errors['text'] = 'Поле с описанием задачи обязательно для заполнения';
        }

        $this->task->email    = $email;
        $this->task->username = $username;
        $this->task->text     = $text;
        $this->task->done     = $done;

        if (count($errors)) {
            return $this->view('task/form', [
                'task'   => $this->task,
                'errors' => $errors,
            ]);
        }

        $this->task->create();

        $this->session->flash('message', "Задача №{$this->task->id} создана");

        return new RedirectResponse('/task/' . $this->task->id);
    }

}
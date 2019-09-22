<?php


namespace BeeJee\App\Controllers\Task;


use BeeJee\App\Controller;
use BeeJee\App\Models\Task;
use BeeJee\App\Models\User;
use BeeJee\App\Session;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\RedirectResponse;

class Update extends Controller
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

    public function __invoke(ServerRequestInterface $request, array $args): ResponseInterface
    {
        $params = $request->getParsedBody();
        $id     = $args['id'];
        $text   = $params['text'] ?? '';
        $done   = $params['done'] ?? '';
        $errors = [];

        $this->task = $this->task->getById($id);

        if (!$this->task->id) {
            return new RedirectResponse("/");
        }

        if (!$text) {
            $errors['text'] = 'Поле с описанием задачи обязательно для заполнения';
        }

        if ($this->task->text !== $text) {
            $this->task->edited_by_admin = 1;
        }

        $this->task->text = $text;
        $this->task->done = $done;

        if (count($errors)) {
            return $this->view('task/form', [
                'errors' => $errors,
                'task'   => $this->task,
            ]);
        }

        $this->task->update();

        $this->session->flash('message', "Задача №{$this->task->id} обновлена");

        return new RedirectResponse('/task/' . $this->task->id);
    }

}
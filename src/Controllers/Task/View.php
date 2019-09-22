<?php


namespace BeeJee\App\Controllers\Task;


use BeeJee\App\Controller;
use BeeJee\App\Models\Task;
use BeeJee\App\Models\User;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\RedirectResponse;

class View extends Controller
{
    /**
     * @var Task
     */
    private $task;

    public function __construct(Task $task, User $user)
    {
        $this->task = $task;

        parent::__construct($user);
    }

    public function __invoke(ServerRequestInterface $request, array $args): ResponseInterface
    {
        $params = [];

        if (isset($args['id'])) {
            $params['task'] = $this->task->getById($args['id']);
        }

        return $this->view('task/view', $params);
    }

}
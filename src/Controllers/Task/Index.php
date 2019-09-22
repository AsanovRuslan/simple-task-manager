<?php


namespace BeeJee\App\Controllers\Task;


use BeeJee\App\Controller;
use BeeJee\App\Models\Task;
use BeeJee\App\Models\User;
use BeeJee\App\TemplateResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\RedirectResponse;

class Index extends Controller
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

    public function __invoke(ServerRequestInterface $request, array $args = []): ResponseInterface
    {
        $query_params = $request->getQueryParams();
        $order_by     = $query_params['order_by'] ?? '';
        $page         = $query_params['page'] ?? 1;

        if (!is_numeric($page) || $page < 1) {
            $page = 1;
        }

        if (!$order_by || ($order_by && !array_key_exists($order_by, Task::AVAILABLE_SORT))) {
            $order_by = 'id desc';
        }

        $tasks = $this->task->getList($order_by, ($page - 1) * Task::PER_PAGE);
        $count = $this->task->count();

        return $this->view('task/index', [
            'tasks'        => $tasks,
            'order_by'     => $order_by,
            'page'         => $page,
            'count'        => $count,
            'total_pages'  => (int)ceil($count / Task::PER_PAGE),
            'sort_options' => Task::AVAILABLE_SORT,
        ]);
    }

}
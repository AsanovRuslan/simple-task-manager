<?php


namespace BeeJee\App;

use BeeJee\App\Models\User;
use Zend\Diactoros\Response;

abstract class Controller implements ControllerInterface
{
    /**
     * @var User
     */
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function view($path, $params = [])
    {
        return new TemplateResponse($path, array_merge($params, [
            'user' => $this->user->getUserInfo()
        ]));
    }
}
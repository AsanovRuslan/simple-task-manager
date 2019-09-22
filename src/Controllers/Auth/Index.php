<?php


namespace BeeJee\App\Controllers\Auth;

use BeeJee\App\Controller;
use BeeJee\App\Models\User;
use Delight\Auth\Auth;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\RedirectResponse;

class Index extends Controller
{
    /**
     * @var Auth
     */
    private $auth;

    public function __construct(Auth $auth, User $user)
    {
        $this->auth = $auth;

        parent::__construct($user);
    }

    public function __invoke(ServerRequestInterface $request, array $args = []): ResponseInterface
    {
        if ($this->auth->isLoggedIn()) {
            return new RedirectResponse('/');
        }

        return $this->view('login');
    }
}
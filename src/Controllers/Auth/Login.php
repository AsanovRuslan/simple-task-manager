<?php


namespace BeeJee\App\Controllers\Auth;


use BeeJee\App\Controller;
use BeeJee\App\Models\User;
use Delight\Auth\AmbiguousUsernameException;
use Delight\Auth\Auth;
use Delight\Auth\InvalidPasswordException;
use Delight\Auth\UnknownUsernameException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\RedirectResponse;

class Login extends Controller
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

        $errors      = [];
        $parsed_body = $request->getParsedBody();
        $login       = $parsed_body['login'] ?? '';
        $password    = $parsed_body['password'] ?? '';

        try {
            $this->auth->loginWithUsername($login, $password);

            return new RedirectResponse('/');

        } catch (UnknownUsernameException | AmbiguousUsernameException | InvalidPasswordException $e) {
            $errors['login_or_password'] = 'Введен неверный логин или пароль';
        }

        return $this->view('login', [
            'login'  => $login,
            'errors' => $errors,
        ]);
    }
}
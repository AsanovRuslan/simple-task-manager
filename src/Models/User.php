<?php


namespace BeeJee\App\Models;


use Delight\Auth\Auth;

class User
{
    /**
     * @var Auth
     */
    private $auth;

    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    public function getUserInfo()
    {
        return [
            'id'        => $this->auth->getUserId(),
            'email'     => $this->auth->getEmail(),
            'user_name' => $this->auth->getUsername(),
        ];
    }
}
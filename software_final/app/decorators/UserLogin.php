<?php
class UserLogin {
    private $userModel;

    public function __construct($userModel) {
        $this->userModel = $userModel;
    }

    public function login($username, $password) {
        return $this->userModel->authenticate($username, $password);
    }
}

<?php
class LoginLogger {
    private $login;

    public function __construct($login) {
        $this->login = $login;
    }

    public function login($username, $password) {
        $user = $this->login->login($username, $password);

        if ($user) {
            global $conn;
            $stmt = $conn->prepare("INSERT INTO login_logs (user_id, username) VALUES (?, ?)");
            $stmt->execute([$user['user_id'], $username]);
        }

        return $user;
    }
}

<?php
class User {
    public $username;
    public $email;
    public $phone;
    public $hash;
    public $authToken;

    private $errors;

    public function __construct($username, $email, $password, $phone) {
        $this->errors = array();

        if (strlen($username) < 4) {
            $this->errors["username"] = "Логин должен быть не менее 4 символов!";
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->errors["email"] = "Неверный формат почты!";
        }

        if (strlen($password) < 4) {
            $this->errors["password"] = "Пароль должен быть не менее 4 символов!";
        }

        $pattern = "/^[0-9+]+$/";
        $match = preg_match($pattern, $phone);

        if (!$match || strlen($phone) < 4) {
            $this->errors["phone"] = "Неверный формат номера!";
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        
        if (empty($this->errors)) {
            $this->username = $username;
            $this->email = $email;
            $this->hash = $hashedPassword;
            $this->phone = str_replace("+", "", $phone);
            $this->authToken = uniqid();
        }
    }

    public function getErrors() {
        return $this->errors;
    }
}
?>
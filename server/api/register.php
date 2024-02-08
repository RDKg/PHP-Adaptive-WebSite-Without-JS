<?php
require_once SERVER_DIR."/database/DatabaseService.php";
require_once SERVER_DIR."/database/builders/QueryBuilder.php";
require_once SERVER_DIR."/database/builders/QuerySetValuesBuilder.php";
require_once SERVER_DIR."/models/User.php";
require_once SERVER_DIR."/utils.php";

function register($username, $email, $phone, $password, $repeatPassword) {
    $db = DatabaseService::getInstance();
    $user = new User(
        $username,
        $email,
        $password,
        $phone
    );
    $errors = $user->getErrors() ?? [];
    
    if ($password !== $repeatPassword) {
        $errors["repeat-password"] = "Пароли не совпадают!";
    }
    
    if (!empty($errors)) {
        return ["response" => $errors, "status" => 400];
    }

    $querySetValues = QuerySetValuesBuilder::create()
        ->addAssignment("username", $username)
        ->addAssignment("email", $email)
        ->addAssignment("phone", $phone)
        ->addAssignment("hash", $user->hash);
    $queryBuilder = new QueryBuilder("users", [$querySetValues]);
    $result = $db->insertEntry($queryBuilder);
    
    if ($result === true) {
        return ["response" => $user, "status" => 200];
    }
    
    foreach (["email", "phone", "username"] as $field) {
        if (strpos($result, $field)) {
            $errors[$field] = "Введенные данные заняты!";
        }
    }
    
    return ["response" => $errors, "status" => 400];
}

$username = $_POST["username"] ?? null;
$email = $_POST["email"] ?? null;
$phone = $_POST["phone"] ?? null;
$password = $_POST["password"] ?? null;
$repeatPassword = $_POST["repeat-password"] ?? null;

$result = register($username, $email, $phone, $password, $repeatPassword);

$response = $result["response"];
$status = $result["status"];

if ($status != 200) {
    $_SESSION["errors"] = $response;

    header("Location: /register.php");
    exit;
}

if (is_object($response)) {
    setcookie("authToken", $response->authToken, time() + 60 * 60 * 24, "/");
    header("Location: /");
}
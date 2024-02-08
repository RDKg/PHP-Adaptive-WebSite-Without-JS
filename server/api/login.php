<?php
require_once SERVER_DIR."/database/DatabaseService.php";
require_once SERVER_DIR."/utils.php";

function login($username, $password) {
    $db = DatabaseService::getInstance();
    $result = $db->getUserdataByAuthData($username, $password);

    if (empty($result)) {
        $_SESSION["errors"] = [
            "username" => "Неверный логин/почта!"
        ];
        
        header("Location: /login.php");
        exit;
    }

    $response = $result["response"];
    $status = $result["status"];
    
    if ($status != 200) {
        $_SESSION["errors"] = $response;
    
        header("Location: /login.php");
        exit;
    }

    setcookie("authToken", $response["authToken"], time() + 60 * 60 * 24 * 7, "/");
    header("Location: /");
}

$username = $_POST["username"] ?? null;
$password = $_POST["password"] ?? null;

$result = login($username, $password);
<?php
require_once SERVER_DIR."/includes/header.php";
require_once SERVER_DIR."/database/DatabaseService.php";

$db = DatabaseService::getInstance();
$userdata = $db->getUserdataByAuthData(authToken: $_COOKIE["authToken"] ?? null);
$isAuth = $userdata !== null;

if ($isAuth) {
    header("Location: /");
    exit;
}

$errors = $_SESSION["errors"] ?? [];

unset($_SESSION["errors"]);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>RUBI</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Yanone+Kaffeesatz:wght@200..700&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" type="text/css" href="/css/styles.css">
</head>
<body>
    <?php
        echo get_header($isAuth, $_SERVER["REQUEST_URI"]);
    ?>
    <main>
        <section class="sign-section-container section-gap restrictor">
            <h1 class="section-title" id="sign-section-title">РЕГИСТРАЦИЯ</h1>
            <div class="sign-container unselect">
                <form class="sign-form" id="sign-up-form" action="/api/register.php" method="post">
                    <?php
                        $inputs = '
                            <meta http-equiv="Content-Type" content="text/html; charset=utf-8" >
                            <input placeholder="Введите логин..." name="username" id="username">
                            <input placeholder="Введите почту..." name="email" id="email">
                            <input placeholder="Введите телефон..." name="phone" id="phone">
                            <input placeholder="Введите пароль..." type="password" name="password" id="password">
                            <input placeholder="Повторите пароль..." type="password" name="repeat-password" id="repeat-password">
                        ';

                        $dom = new DOMDocument();
                        $dom->loadHTML($inputs);
                        $domInputs = $dom->getElementsByTagName('input');

                        foreach ($domInputs as $input) {
                            $attributeName = $input->attributes->getNamedItem("name")->nodeValue;

                            if (array_key_exists($attributeName, $errors)) {
                                echo '<span class="error-validation-message">'.$errors[$attributeName].'</span>';
                            }

                            echo $dom->saveHTML($input);
                        }
                    ?>
                    <div class="sign-button-wrapper">
                        <button id="sign-up-button" class="sign-button">ЗАРЕГИСТРИРОВАТЬСЯ</button>
                    </div>
                </form>
            </div>
        </section>
    </main>
</body>
</html>
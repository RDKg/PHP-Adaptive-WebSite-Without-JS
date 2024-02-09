<?php
require_once SERVER_DIR."/includes/header.php";
require_once SERVER_DIR."/database/DatabaseService.php";

$db = DatabaseService::getInstance();
$userdata = $db->getUserdataByAuthData(authToken: $_COOKIE["authToken"] ?? null);
$isAuth = $userdata !== null;
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
        echo get_header($isAuth);
    ?>
    <main>
        <section class="page-not-found-section-container">
            <h1 id="page-not-found-title">СТРАНИЦА НЕ НАЙДЕНА</h1>
        </section>
    </main>
</body>
</html>
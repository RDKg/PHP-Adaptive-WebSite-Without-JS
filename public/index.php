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
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" type="text/css" href="/css/styles.css">
</head>
<body>
    <?php
        echo get_header($isAuth);
    ?>
    <main>
        <section class="welcome-section-container section-gap restrictor">
            <div class="welcome-links">
                <a id="youtube-link" class="welcome-link" href="https://www.youtube.com/channel/UCV4xE3OpyiOX2xSCud31zYA" target="_blank">
                    <div>
                        <img src="/assets/icons/youtube.svg">
                    </div>
                </a>
                <a id="github-link" class="welcome-link" href="https://github.com/RDKg/PHP-Adaptive-WebSite-Without-JS" target="_blank">
                    <div>
                        <img src="/assets/icons/github.svg">
                    </div>
                </a>
                <a id="vk-link" class="welcome-link" href="https://vk.com/rdk_g" target="_blank">
                    <div>
                        <img src="/assets/icons/vk.svg">
                    </div>
                </a>
                <a id="tg-link" class="welcome-link" href="https://t.me/rubin_rudenko" target="_blank">
                    <div>
                        <img src="/assets/icons/tg.svg">
                    </div>
                </a>
            </div>
            <div class="welcome-interaction-container unselect">
                <h1 class="section-title" id="section-1-title">Пользуйтесь этим сайтом с удовольствием!</h1>
                <div class="welcome-interaction-images-container">
                    <div id="interaction-image-1">
                        <img src="/assets/gifs/pink_girl.gif">
                    </div>
                    <div class="interaction-images-second-column">
                        <div id="interaction-image-2">
                            <img src="/assets/images/sunset.png">
                        </div>
                        <div id="interaction-image-3">
                            <img src="/assets/images/neon-cars.png">
                        </div>
                    </div>
                </div>
                <div class="start-button-wrapper">
                    <a class="start-button">
                        <div>
                            НАЧАТЬ
                        </div>
                    </a>
                </div>
            </div>
        </section>
        <section class="absolute-section-line no-padding-top">
            <h1 class="section-title" id="sign-up-section-title">ПРОЙДИ ПРОСТУЮ РЕГИСТРАЦИЮ</h1>
        </section>
        <section>
            <div id="snow-banner">
            </div>
        </section>
        <section class="absolute-section-line no-padding-bottom background-black">
            <h1 class="section-title" id="account-info-section-title">ТУТ ВИДНО ИНФОРМАЦИЮ О ТВОЕМ АККАУНТЕ :)</h1>
        </section>
        <section class="account-info-section-wrapper section-gap">
            <div class="account-info-section-container restrictor">
                <div class="account-info-container">
                    <div class="account-info-header">
                        <div id="account-avatar">
                            <img>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="images-section-container section-gap">
            <h1 class="section-title">Еще картиночки можно посмотреть</h1>
            <div class="set-visible-image-buttons-container">
                <label class="set-visible-image-button-container">
                    <input type="radio" name="set-visible-image-input" checked>
                    <div class="set-visible-image-button"></div>
                    <img src="/assets/images/picture-sun.png" id="picture-sun-image">
                </label>
                <label class="set-visible-image-button-container">
                    <input type="radio" name="set-visible-image-input">
                    <div class="set-visible-image-button"></div>
                    <img src="/assets/images/roxi.jpg" id="roxi-image">
                </label>
                <label class="set-visible-image-button-container">
                    <input type="radio" name="set-visible-image-input">
                    <div class="set-visible-image-button"></div>
                    <img src="/assets/images/foot.jpg" id="foot-image">
                </label>
                <label class="set-visible-image-button-container">
                    <input type="radio" name="set-visible-image-input">
                    <div class="set-visible-image-button"></div>
                    <img src="/assets/images/gray-2-girls.jpg" id="gray-2-girls-image">
                </label>
                <label class="set-visible-image-button-container">
                    <input type="radio" name="set-visible-image-input">
                    <div class="set-visible-image-button"></div>
                    <img src="/assets/images/blue-girl.jpg" id="blue-girl-image">
                </label>
                <label class="set-visible-image-button-container">
                    <input type="radio" name="set-visible-image-input">
                    <div class="set-visible-image-button"></div>
                    <img src="/assets/images/train-lofi.jpg" id="train-lofi-image">
                </label>
                <label class="set-visible-image-button-container">
                    <input type="radio" name="set-visible-image-input">
                    <div class="set-visible-image-button"></div>
                    <img src="/assets/images/4-girls-gray.jpg" id="4-girls-gray">
                </label>
                <label class="set-visible-image-button-container">
                    <input type="radio" name="set-visible-image-input">
                    <div class="set-visible-image-button"></div>
                    <img src="/assets/images/girl-pink-clouds.png" id="girl-pink-clouds">
                </label>
            </div>
        </section>
    </main>
    <footer>
        <p>Created by<br>
        <span>Демьян Руденко<br> @rdk_g</span>
    </p>
    </footer>
</body>
</html>
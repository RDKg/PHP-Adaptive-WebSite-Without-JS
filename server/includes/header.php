<?php
require_once SERVER_DIR."/utils.php";

function get_header($isAuth) {
    $links = '
        <ul id="header-sign-links">
            <a id="sign-in" href="/login/">
                <li>
                    <img src="/assets/icons/door.svg">
                </li>
            </a>
            <a id="sign-up" href="/register/">
                <li>
                    РЕГИСТРАЦИЯ
                </li>
            </a>
        </ul>
    ';

    if ($isAuth) {
        $links = '
            <ul id="header-sign-links">
                <a id="logout" href="/api/logout/">
                    <li>
                        ВЫЙТИ
                    </li>
                </a>
            </ul>
        ';
    }

    $header = '
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <header class="unselect restrictor">
            <div class="header-container">
                <a id="header-logo-link" href="/">
                    <style>
                        @import url("https://fonts.googleapis.com/css2?family=Bellota+Text:wght@400;700&display=swap");
                    </style>
                    <h1 id="logo-title">
                        RUBI
                        <img id="logo-img" src="/assets/icons/logo.svg">
                        MUSI
                    </h1>
                </a>
                '.$links.'
            </div>
        </header>
    ';

    return $header;
}
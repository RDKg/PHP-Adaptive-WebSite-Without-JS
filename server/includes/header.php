<?php
function get_header($isAuth, $uri) {
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
            </div>
        </header>
    ';
    
    // libxml_use_internal_errors(true);
    
    // $dom = new DOMDocument();
    // $dom->loadHTML($header);
    // $elements = $dom->getElementsByTagName("a");
    
    // libxml_use_internal_errors(false);
    
    // foreach ($elements as $node) {
    //     $href = $node->attributes->item(0)->nodeValue;
        
    //     if ($href == $uri) {
    //         $node->setAttribute("class", "selected-header-link");
    //     }
    // }
    
    // $header = $dom->saveHTML();

    return $header;
}
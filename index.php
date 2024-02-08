<?php
require_once "init.php";
require_once SERVER_DIR."/database/DatabaseHandler.php";

$db = DatabaseHandler::getInstance();

session_start(); 

if (TEST) {
    require_once SERVER_DIR."/tests/tests.php";
}

require_once SERVER_DIR."/route.php";


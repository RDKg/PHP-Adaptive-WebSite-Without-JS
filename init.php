<?php
$config = parse_ini_file("config.ini");

define("PROJECT_DIR", str_replace("\\", "/", __DIR__));
define("PUBLIC_DIR", PROJECT_DIR."/public");
define("SERVER_DIR", PROJECT_DIR."/server");

define("SERVER_ADDRESS", "http://localhost:8080");

define("DB_PATH", SERVER_DIR."/src/database.db");

define("CAPTCHA_CLIENT_KEY", $config["captcha_client_key"]);
define("CAPTCHA_SERVER_KEY", $config["captcha_server_key"]);

define("TEST", $config["test"]);

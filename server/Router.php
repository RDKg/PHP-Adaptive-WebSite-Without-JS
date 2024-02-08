<?php
require_once SERVER_DIR."/utils.php";

class Router {
    protected $routes = array();

    public function __construct() {
        consoleLog("");
        consoleLog("● Status: OPENED");
    }

    public function __destruct() {
        consoleLog("● Status: CLOSED\n");
    }

    public function define($routes) {
        $this->routes = $routes;
    }

    public function handleRequest() {
        $uri = $_SERVER["REQUEST_URI"];
        $route = $this->getRoute($uri);
        $routeFile = $this->getRouteFile($uri, $route);
        
        consoleLog("● Connection-Uri: ".SERVER_ADDRESS.$uri);
        
        if ($routeFile == null) {
            require PUBLIC_DIR."/page_not_found.php";
            exit;
        }
        
        if (str_contains($uri, "/api/")) {
            require $route["path"];
            exit;
        }

        $contentType = $this->getContentType($routeFile);
        header("Content-Type: ".$contentType);
        consoleLog("● Connection-Path: ".$routeFile);
        consoleLog("● Content-Type: ".$contentType);

        require $routeFile;
        exit;
    }

    private function getRouteFile($uri, $route) {
        $fullUri = PUBLIC_DIR.$uri;

        if (str_contains($uri, "/api/")) {
            $fullUri = SERVER_DIR.$uri;
        }

        $isDir = !pathinfo($fullUri, PATHINFO_EXTENSION);

        if ($route == null) {
            return null;
        }

        if ($isDir) { 
            $path = $route["path"];
            $isPathDir = !pathinfo($path, PATHINFO_EXTENSION);

            if ($isPathDir) {
                return null;
            }
            
            return $path;
        }

        return $fullUri;
    }

    private function getRoute($uri) {
        $fullUri = PUBLIC_DIR.$uri;

        if (str_contains($uri, "/api/")) {
            $fullUri = SERVER_DIR.$uri;
        }

        $isDir = !pathinfo($fullUri, PATHINFO_EXTENSION);
        
        if ($isDir) {
            foreach ($this->routes as $route) {
                if ($route["uri"] == $uri) {
                    return $route;
                }
            }

            return null;
        }

        foreach ($this->routes as $route) {
            if (str_contains($fullUri, $route["path"])) {
                return $route;
            }
        }

        return null;
    }

    private function getContentType($path) {
        $extension = pathinfo($path, PATHINFO_EXTENSION);

        switch ($extension) {
            case "css":
                return "text/css";
            case "php":
                return "text/html";
        }

        $finfo = new finfo(FILEINFO_MIME_TYPE);
        $contentType = $finfo->file($path);

        return $contentType;
    }
}

$router = new Router();
$router->define([
    // FILES
    "" => [
        "uri" => "/",
        "path" => PUBLIC_DIR."/index.php",
    ],
    "main" => [
        "uri" => "/main/",
        "path" => PUBLIC_DIR."/index.php",
    ],
    "login" => [
        "uri" => "/login/",
        "path" => PUBLIC_DIR."/login.php",
    ],
    "register" => [
        "uri" => "/register/",
        "path" => PUBLIC_DIR."/register.php",
    ],

    // FOLDERS
    "css" => [
        "uri" => "/css/",
        "path" => PUBLIC_DIR."/css/",
        "handler" => ""
    ],
    "assets" => [
        "uri" => "/assets/",
        "path" => PUBLIC_DIR."/assets/",
        "handler" => ""
    ],

    // API
    "api_register" => [
        "uri" => "/api/register/",
        "path" => SERVER_DIR."/api/register.php",
    ],
    "api_login" => [
        "uri" => "/api/login/",
        "path" => SERVER_DIR."/api/login.php",
    ],
]);
$router->handleRequest();

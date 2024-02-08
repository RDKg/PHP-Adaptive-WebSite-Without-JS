<?php
require_once SERVER_DIR."/database/builders/QueryBuilder.php";
require_once SERVER_DIR."/database/builders/QueryBuilderSorts.php";
require_once SERVER_DIR."/database/builders/QueryConditionsBuilder.php";
require_once SERVER_DIR."/utils.php";

class DatabaseService extends DatabaseHandler {
    private static $instance;

    public function __construct(PDO $db) {
        parent::__construct($db);
    }

    public static function getInstance() {
        if (!self::$instance) {
            $db = self::connectDatabase(DB_PATH);
            self::$instance = new DatabaseService($db);
        }

        return self::$instance;
    }

    public function getUserdataByAuthData($login=null, $password=null, $authToken=null) {
        $queryConditions = QueryConditionsBuilder::create()
            ->openSeparate()
            ->where("email", "=", $login)
            ->orWhere("username", "=", $login)
            ->orWhere("phone", "=", $login)
            ->closeSeparate()
            ->orWhere("authToken", "=", $authToken);
        $queryBuilder = new QueryBuilder("users", [$queryConditions]);
        $result = $this->getEntries($queryBuilder);

        if ($result == null) {
            return null;
        }

        foreach ($result as $entry) {
            if ($password !== null && password_verify($password, $entry["hash"])) {
                return $entry;
            }
            else if ($authToken == $entry["authToken"]) {
                return $entry;
            }
        }
    }
}
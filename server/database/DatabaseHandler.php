<?php
require_once SERVER_DIR."/database/TableDefinitions.php";
require_once SERVER_DIR."/database/builders/QueryBuilder.php";
require_once SERVER_DIR."/database/builders/QueryBuilderSorts.php";
require_once SERVER_DIR."/database/builders/QueryConditionsBuilder.php";
require_once SERVER_DIR."/utils.php";

class DatabaseHandler {
    private PDO $db;

    private static $instance;

    public function __construct(PDO $db) {
        $this->db = $db;
        $this->createTable(TableDefinitions::USERS);
    }

    public static function getInstance() {
        if (!self::$instance) {
            $db = self::connectDatabase(DB_PATH);
            self::$instance = new DatabaseHandler($db);
        }

        return self::$instance;
    }
    
    public static function connectDatabase(string $dbPath=DB_PATH) {
        try {
            $db = new PDO("sqlite:$dbPath");

            return $db;
        }
        catch (PDOException $e) {
            $message = $e->getMessage();
            error_log($message."\n", 3, SERVER_DIR."/src/log.txt");

            return false;
        }
    }

    public function createTable($query) {
        try {
            $statement = $this->db->prepare($query);
            $statement->execute();

            return true;
        } catch (Exception $e) {
            $message = $e->getMessage();
            error_log($message."\n", 3, SERVER_DIR."/src/log.txt");
            
            return false;
        }
    }

    public function insertEntry(QueryBuilder $queryBuilder) {
        try {
            $query = $queryBuilder->getInsertQueryString();
            $values = $queryBuilder->getInsertPlaceholderValueData()[0];
            $statement = $this->db->prepare($query);

            for ($i = 0; $i < count($values)+1; $i++) {
                $statement->bindParam(
                    $values["placeholders"][$i],
                    $values["values"][$i]
                );
            }

            $result = $statement->execute();

            if (!$result) {
                throw new Exception($statement->errorInfo()[2]);
            }

            $statement->closeCursor();

            return true;
        }
        catch (Exception $e) {
            $message = $e->getMessage();
            error_log($message."\n", 3, SERVER_DIR."/src/log.txt");

            return false;
        }
    }

    public function getEntries(QueryBuilder $queryBuilder) {
        try {
            $query = $queryBuilder->getSelectQueryString();
            $values = $queryBuilder->getSelectPlaceholderValueData()[0];
            $statement = $this->db->prepare($query);

            for ($i = 0; $i < count($values)+1; $i++) {
                $statement->bindParam(
                    $values["placeholders"][$i],
                    $values["values"][$i]
                );
            }

            $result = $statement->execute();

            if (!$result) {
                return array();
            }

            $data = $statement->fetchAll(PDO::FETCH_ASSOC);

            return $data;
        }
        catch (Exception $e) {
            $message = $e->getMessage();
            error_log($message."\n", 3, SERVER_DIR."/src/log.txt");

            return false;
        }
    }

    public function updateEntry(QueryBuilder $queryBuilder) {
        try {
            $query = $queryBuilder->getUpdateQueryString();
            $values = $queryBuilder->getUpdatePlaceholderValueData()[0];
            $statement = $this->db->prepare($query);
                
            for ($i = 0; $i < count($values)+1; $i++) {
                $statement->bindParam(
                    $values["placeholders"][$i],
                    $values["values"][$i]
                );
            }

            $result = $statement->execute();

            if (!$result) {
                throw new Exception($statement->errorInfo()[2]);
            }

            $statement->closeCursor();

            return true;
        }
        catch (Exception $e) {
            $message = $e->getMessage();
            error_log($message."\n", 3, SERVER_DIR."/src/log.txt");

            return false;
        }
    }
}
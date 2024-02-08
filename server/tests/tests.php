<?php
require_once SERVER_DIR."/utils.php";
require_once SERVER_DIR."/database/builders/QueryBuilder.php";
require_once SERVER_DIR."/database/builders/QueryBuilderSorts.php";
require_once SERVER_DIR."/database/builders/QuerySetValuesBuilder.php";

$login = null;
$authToken = "65a87b5ad26c0";
$queryConditions = QueryConditionsBuilder::create()
    ->openSeparate()
    ->where("email", "=", $login)
    ->orWhere("username", "=", $login)
    ->orWhere("phone", "=", $login)
    ->closeSeparate()
    ->orWhere("authToken", "=", $authToken);
$queryBuilder = new QueryBuilder("users", [$queryConditions]);
consoleLog($queryBuilder->getSelectQueryString());

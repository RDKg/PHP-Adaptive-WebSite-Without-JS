<?php
class TableDefinitions {
    public const USERS = "
        CREATE TABLE IF NOT EXISTS users (
            id INTEGER PRIMARY KEY,
            username TEXT UNIQUE,
            email TEXT UNIQUE,
            phone TEXT UNIQUE,
            authToken TEXT UNIQUE,
            hash TEXT
        );
    ";
}
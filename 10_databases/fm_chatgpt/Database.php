<?php

class Database {
    private static $host = "localhost";
    private static $db   = "testdb";

    private static $user = "root";
    private static $pass = "";

    private static $pdo = null;

    public static function connect() {
        if (self::$pdo === null) {
            $dsn = "mysql:host=" . self::$host . ";dbname=" . self::$db . ";charset=utf8mb4";

            // Create PDO
            self::$pdo = new PDO($dsn, self::$user, self::$pass);

            // Set attributes
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            self::$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        }

        return self::$pdo;
    }
}

/*

Reuse connection (important)

The static $pdo ensures:

Only one connection per request
Better performance

Additional Upgrades:

UTF-8 support (important)

Always include:

charset=utf8mb4

in DSN:

mysql:host=localhost;dbname=testdb;charset=utf8mb4

Default fetch mode

Instead of always writing:

$stmt->fetch(PDO::FETCH_ASSOC);

Set once:

self::$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

Then:

$stmt->fetch(); // already associative

You don't have to close the connection:

PHP manages the connection for you. The connection is automatically closed when:

the script finishes
or the $pdo object is destroyed (goes out of scope)

So at the end of your request, PHP cleans it up.

*/
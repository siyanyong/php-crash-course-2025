<?php

try {
    $pdo = new PDO('sqlite:contacts.db');  // SQLite file - easy!
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  // Error handling uses exceptions
    $pdo->exec("CREATE TABLE IF NOT EXISTS contacts (
        id INTEGER PRIMARY KEY,
        name TEXT NOT NULL,
        email TEXT NOT NULL,
        phone TEXT,
        image TEXT
    );"); // Direct execution; No results set
    return $pdo;
} catch (PDOException $e) {
    return null;
}

/*

1. exec()
Direct execution
No placeholders
No result set
Good for simple, non-user-input SQL

2. query()
Also executes immediately
BUT returns a result set (for SELECT)

3. prepare() + execute()
Safer (prevents SQL injection)
Supports parameters
Best for user input

Think of PDO like this:

Method	Meaning
query()	“Run and give me results (SELECT only)”
exec()	“Run this and tell me how many rows changed”
prepare()	“I might use user input, make this safe first”

Important caution
You should avoid using exec() with user input, because it does not support parameter binding. That makes it vulnerable to SQL injection.
Bad example:
$pdo->exec("DELETE FROM users WHERE id = $id"); // unsafe if $id is user input

*/
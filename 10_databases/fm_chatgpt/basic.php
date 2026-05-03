<?php
$dsn = "mysql:host=localhost;dbname=testdb"; // data source name
$username = "root";
$password = "";

try {
    // Create connection
    $pdo = new PDO($dsn, $username, $password);
    // Set error mode to throw exceptions for try-catch
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Prepare query against sql injection attacks
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
    // Execute with parameter
    $stmt->execute(['email' => 'test@example.com']);
    // Fetch result
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    print_r($user);

} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

/*
Yes—what you’ve written is essentially the minimum safe pattern for a parameterized query using PDO in PHP:

1. Create a PDO connection
2. Set error handling mode

Can be combined!
3. Prepare the SQL statement
4. Execute with bound parameters
5. Fetch results

6. Handle exceptions

That’s the core workflow. In practice, you’ll reuse steps 1–2 across many queries and only repeat 3–5.

DSN format depends on the database

MySQL / MariaDB
mysql:host=localhost;dbname=testdb;charset=utf8mb4
PostgreSQL
pgsql:host=localhost;port=5432;dbname=testdb
SQLite
sqlite:/path/to/database.db
(No host needed because it's a file)

*/

?>
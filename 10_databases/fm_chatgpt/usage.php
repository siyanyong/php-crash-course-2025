<?php

try {
    require "Database.php";

    $pdo = Database::connect(); // static operator

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->execute(['email' => 'test@example.com']);

    $user = $stmt->fetch();

    print_r($user);

} catch (PDOException $e) {
    error_log("Database error: " . $e->getMessage());
    http_response_code(500);
    echo "Something went wrong.";
}

echo "Still runs!";
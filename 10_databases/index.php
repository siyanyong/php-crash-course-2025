<?php
$pdo = require 'db.php';
$contacts = [];
if ($pdo) {
    // Query to fetch all contacts
    $stmt = $pdo->query("SELECT * FROM contacts"); // Direct execution with results set

    // Fetch all results as associative arrays
    $contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a href="create.php">Create new contact</a>

<ul>
    <?php foreach ($contacts as $contact): ?>
        <li>
            <img src="<?php echo $contact['image']; ?>" height="50">
            <?php echo "{$contact['name']} - {$contact['email']} - {$contact['phone']}"; ?>
            <a href="delete.php?id=<?php echo $contact['id'] ?>">
                Delete
            </a>
        </li>
    <?php endforeach; ?>
</ul>
</body>
</html>

<!--

In PHP’s PDO, fetch() and fetchAll() are both used to retrieve query results, but they behave very differently in terms of how much data they return and when.

fetch()
Returns one row at a time
You call it repeatedly (usually in a loop)
Good for large result sets because it’s memory efficient

Example:

$stmt = $pdo->query("SELECT * FROM users");

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    print_r($row);
}

👉 Think of it as: “Give me the next row.”

fetchAll()
Returns all rows at once
Stores the entire result set in an array
Easier to work with, but can use a lot of memory for large queries

Example:

$stmt = $pdo->query("SELECT * FROM users");
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

print_r($rows);

👉 Think of it as: “Give me everything right now.”

The key fact:

In PHP, assignment is an expression, not a statement.

That means this:

$row = $stmt->fetch(PDO::FETCH_ASSOC)

does two things:

Executes the right-hand side (fetch(...))
Assigns the result to $row
Evaluates to the value that was assigned

So the assignment itself returns the assigned value.

But here’s the crucial difference from PHP
1. Java is strictly typed

In Java:

while (row = getNext()) { }

❌ This does not compile

Because:

row = getNext() is not a boolean
while requires a boolean condition

So Java prevents the exact pattern you saw in PHP PDO loops.

2. You must explicitly compare in Java

Instead, you write:

while ((row = getNext()) != null) {
    // use row
}

Now:

assignment happens first
then it is compared to null
result is a boolean (true or false)

    -->
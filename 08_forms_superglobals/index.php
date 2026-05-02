<?php
// 49:37
$contactsFile = "contacts.json";
$contacts = is_file($contactsFile) ? json_decode(file_get_contents($contactsFile), true) : [];
// file_exist does not discrimate between file or directory - it check if anything exists so use is_file()
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
    <?php foreach ($contacts as $contact): ?> <!-- notice the : -->
        <!-- <li>
            <img src="<?php echo $contact['image']; ?>" height="50">
            <?php echo "{$contact['name']} - {$contact['email']} - {$contact['phone']}"; ?>
            <a href="delete.php?id=<?php echo $contact['id'] ?>">
                Delete
            </a>
        </li> -->
        <li>
    <img src="<?= htmlspecialchars($contact['image']) ?>" height="50">

    <?= htmlspecialchars($contact['name']) ?> -
    <?= htmlspecialchars($contact['email']) ?> -
    <?= htmlspecialchars($contact['phone']) ?>

    <a href="delete.php?id=<?= (int)$contact['id'] ?>">
        Delete
    </a>
    <!-- Deleting using a GET method is bad -->
</li>
    <?php endforeach; ?>
</ul>
</body>
</html>

    <!-- <?php echo $name; ?> is <?= $name ?>-->
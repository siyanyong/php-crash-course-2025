<?php

$pdo = require 'db.php';

if (isset($_GET['id'])) {
    $contactId = $_GET['id'];

    // Fetch the contact's image name before deleting
    $stmt = $pdo->prepare("SELECT image FROM contacts WHERE id = :id");
    $stmt->execute([':id' => $contactId]);
    $contact = $stmt->fetch(PDO::FETCH_ASSOC);

    // If there is an image, delete it from the server directory
    if ($contact && $contact['image']) {
        $imagePath = 'uploads/' . $contact['image'];
        if (file_exists($imagePath)) {
            unlink($imagePath);  // Delete the image file from the server directory
        }
    }

    // Now delete the contact from the database
    $stmt = $pdo->prepare("DELETE FROM contacts WHERE id = :id");
    $stmt->execute([':id' => $contactId]);
    echo "Contact Deleted";
}

/*

What it does
Deletes the file specified by $filename
Returns:
true on success
false on failure
Important notes
It only deletes files, not directories (use rmdir() for directories).
The PHP process must have permission to delete the file.
If the file doesn’t exist or is locked, it will fail (and may emit a warning).

*/
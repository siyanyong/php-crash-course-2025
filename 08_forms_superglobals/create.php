<?php

$uploadsDir = 'uploads/'; // all images in here
$contactsFile = 'contacts.json'; // all contacts in here

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
    $phone = filter_input(INPUT_POST, "phone", FILTER_SANITIZE_NUMBER_INT);

    if ($name && $email && $phone && isset($_FILES['image'])) {

        // Ensure the uploads directory exists
        if (!is_dir($uploadsDir)) { // if directory does not exist
            mkdir($uploadsDir, 0777, true); // recursive true
        }

        // get current timestamp in seconds
        // basename is the last portion of entire name
        $imageName = time() . "_" . basename($_FILES["image"]["name"]);
        $imagePath = $uploadsDir . $imageName;

        // $imagePath is needed here as an arg
        if (move_uploaded_file($_FILES['image']['tmp_name'], $imagePath)) {
            $contacts = file_exists($contactsFile) ?
                        json_decode(file_get_contents($contactsFile), true) // make associa arr so as to not get mixed types
                        : [];

            $contacts[] = [
                'id' => rand(100000000, 200000000),
                'name' => $name,
                "email" => $email,
                "phone" => $phone,
                "image" => $imagePath
            ];

            // save into a json file and make it readable
            file_put_contents(
                $contactsFile,
                json_encode($contacts, JSON_PRETTY_PRINT)
            );

            echo "Contact added: $name ($email, $phone)";
        } else {
            echo "Image upload failed";
        }

    } else {
        echo "Invalid input!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        label, input {
            display: block;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    
<form action="" method="POST" enctype="multipart/form-data">
    <label>Name:</label>
    <input type="text" name="name">

    <label>Email:</label>
    <input type="email" name="email">

    <label>Phone:</label>
    <input type="text" name="phone">

    <label>Contact Image:</label>
    <input type="file" name="image" accept="image/*" required>

    <button type="submit">Add Contact</button>
</form>
</body>
</html>

<!-- accept is just a filter for the file picker UI. It does not enforce security. Always validate. -->
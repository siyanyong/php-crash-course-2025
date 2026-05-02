<?php
// http://localhost:8080/08_forms_superglobals/exercise.php?name=renny&age=41
echo "<pre>";
var_dump($_GET, $_POST); // It would appear in the $_GET array
var_dump($_SERVER['REQUEST_METHOD']);
// var_dump($_SERVER);

var_dump($_FILES);

echo "</pre>";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_SPECIAL_CHARS); // Needs validation later
    $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL); // Do not sanitize - may strip chars
    $phone = filter_input(INPUT_POST, "phone", FILTER_SANITIZE_NUMBER_INT); // Needs validation later

    if ($name && $email && $phone) {
        echo "Contact added: $name ($email, $phone)";
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
    <form action="" method="post" enctype="multipart/form-data">
        <label for="">Name:</label>
        <input type="text" name="name" id="">

        <label for="">Email:</label>
        <input type="email" name="email" id="">

        <label for="">Phone:</label>
        <input type="text" name="phone" id="">

        <label>Contact Image:</label>
        <input type="file" name="image" accept="image/*" required>

        <button type="submit">Add Contact</button>
    </form>
</body>
</html>

<!-- 

If the method is GET you will see:
http://localhost:8080/08_forms_superglobals/exercise.php?name=r&email=r%40r&phone=r 

enctype in form and accept in input for file type is needed for file uploads.

You have to move the uploaded file if not the tmp file will be gone after one request.

 -->
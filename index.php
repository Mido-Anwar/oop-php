<?php
include './inc/form.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <form action="./inc/form.php" method="POST" enctype="multipart/form-data">
        <input type="text" name="firstName" id="firstName" placeholder="First Name">
        <input type="text" name="lastName" id="lastName" placeholder="Last Name">
        <input type="text" name="email" id="email" placeholder="Email">
        <input type="submit" value="Send" name="submit">
    </form>
    <pre>
    <?php
    $users = new SqlQeuaries();
    var_dump($users->SelectQuery());
    ?>
</pre>
    <script src="./js/script.js"></script>
</body>

</html>
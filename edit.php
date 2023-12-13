<?php
include 'inc/form.php';
/**
 *first fill database information in db file in inc folder
 */
//* select by id;
$user = new SqlQeuaries();
$user->SetId($_GET['id']);
$user->SelectQueryById();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body style="background-color: green;">
    <a href="../inc/dashboard.php">Dashboard</a>

    <form action="../inc/form.php" method="POST">
        <input type="text" name="firstName" id="" value="<?= $user->SelectQueryById()['first_name'] ?>">
        <input type="text" value="<?= $_GET['action'] ?>" name="action" hidden>
        <input type="text" value="<?= $user->SelectQueryById()['id'] ?>" name="id" hidden>
        <input type="text" name="lastName" id="" value="<?= $user->SelectQueryById()['last_name'] ?>">
        <input type="text" name="email" id="" value="<?= $user->SelectQueryById()['email'] ?>">
        <input type="submit" value="edit" name="update">
    </form>
    <script src="./js/script.js"></script>
</body>

</html>
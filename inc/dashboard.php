<?php
require 'form.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">

    <title>Dashboard</title>
</head>

<body>
    <table>
        <thead>
            <th>first name</th>
            <th>last name</th>
            <th>Email</th>
            <th>edit </th>
            <th>delete</th>
        </thead>
        <tbody>
            <?php
            $users = new SqlQeuaries();
            foreach ($users->SelectQuery() as $user) {
            ?>
                <tr>
                    <td><?= $user['first_name'] ?> </td>
                    <td><?= $user['last_name'] ?> </td>
                    <td><?= $user['email'] ?> </td>
                    <td>
                        <a href="http://localhost/winner/edit.php/?action=edit&id=<?= $user['id'] ?>">edit</a>
                    </td>
                    <td>
                        <a href="http://localhost/winner/inc/form.php/?action=delete&id=<?= $user['id'] ?>">delete</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>

</html>
<?php
include '../inc/form.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/bootstrap/css/bootstrap.css.map">

    <title>Dashboard</title>
</head>

<body>
    <main>
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
            $users = new UserSqlQeuaries();
            foreach ($users->SelectQuery() as $user) : // this way for view datatable without brackets and easy readable 
            ?>
                <tr>
                    <td><?= htmlspecialchars($user['first_name']) // this function for scripts shutdown  ?> </td>
                    <td><?= $user['last_name'] ?> </td>
                    <td><?= $user['email'] ?> </td>
                    <td>
                        <a href="http://localhost/winner/views/edit.php/?action=edit&id=<?= $user['id'] ?>">edit</a>
                    </td>
                    <td>
                        <a href="http://localhost/winner/inc/form.php/?action=delete&id=<?= $user['id'] ?>">delete</a>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
    </main>
   
</body>

</html>
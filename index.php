<?php
$con = mysqli_connect('localhost','midoanawr','s1f4y5l1','win');
if (!$con) {
  echo 'fail' . mysqli_connect_error();
}else{


}
if (isset($_POST['submit'])) {
    $firstname = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    echo $firstname . $lastName . $email;
}
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

    <form action="index.php" method="post">
        <input type="text" name="firstName" id="firstName" placeholder="First Name">
        <input type="text" name="lastName" id="lastName" placeholder="Last Name">
        <input type="text" name="email" id="email" placeholder="Email">
        <input type="submit" value="Send" name="submit">
    </form>

    <script src="./js/script.js"></script>
</body>

</html>
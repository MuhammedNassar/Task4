<?php
session_start();                             // start
$name = $_SESSION['name'];                   // Fill data     
$email = $_SESSION['email'];
$gender = $_SESSION['gender'];
$address = $_SESSION['address'];
$linkedin = $_SESSION['linkedin'];
$imageUrl = $_SESSION['image'];
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    session_destroy();                      // clear Sessions and back to task4.php
    header('Location: ./task4.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Register</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
    <div style="padding-top: 50px; background:lightgray ; width:300px;height:auto;">
        <img src="<?php echo $imageUrl ?>" style="width:100%">
        <h3>
            <p><?php echo $name ?></p>
        </h3>
        <p><?php echo $email ?></p>
        <p><?php echo $gender ?></p>
        <p><?php echo $address ?></p>
        <a href="<?php echo $linkedin ?>">LinkedIn</i></a>

    </div>
    <p><button type="submit">back</button></p>
</form>
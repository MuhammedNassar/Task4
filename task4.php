<?php
session_start();
$errors = [];
function RemoveSpaces($strToConvert)
{
    if (!empty($strToConvert)) {
        return $strToConvert = trim(strip_tags(($strToConvert)));
    }
}
function UplaodPic()
{

    if (!empty($_FILES['image']['name'])) {
        $ImageName = $_FILES['image']['name'];
        $imageTemp = $_FILES['image']['tmp_name'];
        $imageExt = explode('.', $ImageName);
        $finalExt = RemoveSpaces(strtolower(end($imageExt)));
        $allowedExt = ['gif', 'jgp', 'png'];
        if (in_array($finalExt, $allowedExt)) {
            $finalname = rand() . time() . '.' . $finalExt;
            $distnationFolder = './uploads/' . $finalname;
            if (move_uploaded_file($imageTemp, $distnationFolder)) {
                return $distnationFolder;
            } else {
                $errors['whileUpload'] = 'Upload faild please try again';
            }
        } else {

            $errors['formatnotAllowed'] = 'Selected Format Not allowed';
        }
    } else {
        global $errors;
        $errors['emptyImage'] = 'Image Field Is Requird';
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = RemoveSpaces($_POST['uname']);
    $psw = strip_tags($_POST['psw']);
    $email = removeSpaces($_POST['email']);
    $gender = removeSpaces($_POST['gender']);
    $address = removeSpaces($_POST['address']);
    $linkedin = removeSpaces($_POST['linkedin']);
    $imageUrl = UplaodPic();
    global $errors;
    if (empty($name)) {
        $errors['name'] = 'Username is Requird';
    }
    if (!empty($psw)) {
        if (!strlen($psw) >= 6) {
            $errors['shortPass'] = 'Password should be more than 6 Chars';
        }
    } else {
        $errors['password'] = 'Password is Requird';
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['Email'] = 'Invalid Email Format';
    }
    if (!empty($address)) {
        if (strlen($address) > 10) {
            $errors['addressLong'] = 'Address should be less than 10 Chars';
        }
    } else {
        $errors['address'] = 'Address Is Requird';
    }
    if (!empty($linkedin) && filter_var($linkedin,FILTER_VALIDATE_URL)) {
        if (! strpos($linkedin,'linkedin.com/')) {
            $errors['wrongelinkedinUrl'] = 'You most give Linkedin URL only ';
            //var_dump( strpos('linkedin.com/',$linkedin));
        }
    } else {
        $errors['linkedin'] = 'Linkedin Is Requird';
    }
    if (count($errors) > 0) {

        foreach ($errors as $key => $value) {
            echo '<b> * : ' . $key . ' | ' . $value . '<b><br>';
        }
    } else {
        $_SESSION['name'] = $name;
        $_SESSION['email'] = $email;
        $_SESSION['gender'] = $gender;
        $_SESSION['address'] = $address;
        $_SESSION['linkedin'] = $linkedin;
        $_SESSION['image'] = $imageUrl;
        header('Location: ./profile.php');
        exit();
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Register</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container" style="padding-top: 20px;">

        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="uname"><b>Username</b></label>
            </div> <input type="text" name="uname" class="form-control">
            <div class="form-group">
                <label for="psw"><b>Password</b></label>
                <input type="password" name="psw" class="form-control">
            </div>
            <div class="form-group">
                <label for="email"><b>Email</b></label>
                <input type="text" name="email" class="form-control">
            </div>
            <div class="form-group">
                <label for="Address"><b>Address</b></label>
                <input type="text" name="address" class="form-control">
            </div>
            <select name="gender">
                <option value=" ">--select--</option>
                <option value="male" selected="selected">male</option>
                <option value="female">female</option>
            </select>
            <div class="form-group">
                <label for="linkedin"><b>LinkediN</b></label>
                <input type="text" name="linkedin" class="form-control">
            </div>
            <div class="form-group">
                <label for="file"><b>LinkediN</b></label>
                <input type="file" name="image" class="form-control">
            </div>


            <button type="submit" class="btn btn-primary">Login</button>

        </form>
    </div>
</body>
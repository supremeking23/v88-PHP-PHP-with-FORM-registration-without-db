<?php 
session_start();
if(isset($_SESSION["has_error_first_name"])){
    $has_error_first_name = $_SESSION["has_error_first_name"];
}else{
    $has_error_first_name = FALSE;
}

if(isset($_SESSION["has_error_last_name"])){
    $has_error_last_name = $_SESSION["has_error_last_name"];
}else{
    $has_error_last_name = FALSE;
}

if(isset($_SESSION["has_error_email"])){
    $has_error_email = $_SESSION["has_error_email"];
}else{
    $has_error_email = FALSE;
}

if(isset($_SESSION["has_error_password"])){
    $has_error_password = $_SESSION["has_error_password"];
}else{
    $has_error_password = FALSE;
}

if(isset($_SESSION["has_error_confirm_password"])){
    $has_error_confirm_password = $_SESSION["has_error_confirm_password"];
}else{
    $has_error_confirm_password = FALSE;
}

if(isset($_SESSION["has_error_confirm_password"])){
    $has_error_confirm_password = $_SESSION["has_error_confirm_password"];
}else{
    $has_error_confirm_password = FALSE;
}

if(isset($_SESSION["has_error_birth_date"])){
    $has_error_birth_date = $_SESSION["has_error_birth_date"];
}else{
    $has_error_birth_date = FALSE;
}
if(isset($_SESSION["has_error_profile_picture"])){
    $has_error_profile_picture = $_SESSION["has_error_profile_picture"];
}else{
    $has_error_profile_picture = FALSE;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration without DB</title>
    <style>
        body * {
            outline:1px dashed red;
        }

        body {
            font-family:helvetica;
        }



        .container {
            width:1200px;
            margin:0 auto;
            padding:20px;
        }

        ul li {
            margin-bottom:10px;
            color:red;
        }

       

        form input {
            display:block;
            padding:10px;
            width:90%;
            margin:10px;
        }


        .highlight {
            border:2px solid red;
        }

        .hide-form {
            display:none;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Registration Form</h1>
        <!-- display errors here -->
        <?php 
            if(isset($_SESSION["errors"])){    
                echo "<ul>";           
                foreach($_SESSION["errors"] as $error){ ?>
                    <li><?= $error ?></li>
        <?php   }
                echo "</ul>";
            }
        ?>

        <?php 
            if(isset($_SESSION["success_message"])){ ?>
            <h1><?= $_SESSION["success_message"] ?> </h1>
        <?php    }
        ?>

        <form action="process.php" method="POST" enctype="multipart/form-data" class="<?= isset($_SESSION["success_message"])? "hide-form" : "";  ?>">
            <input type="text" name="email" value="" placeholder="Email" class="<?= ($has_error_email) ? "highlight":"" ?>">
            <input type="text" name="first_name" value="" placeholder="First Name" class="<?= ($has_error_first_name) ? "highlight":"" ?>">
            <input type="text" name="last_name" value="" placeholder="Last Name" class="<?= ($has_error_last_name) ? "highlight":"" ?>">
            <input type="password" name="password" value="" placeholder="Password"  class="<?= ($has_error_password) ? "highlight":"" ?>">
            <input type="password" name="confirm_password" value="" placeholder="Confirm password"  class="<?= ($has_error_confirm_password) ? "highlight":"" ?>">
            <input type="text" name="birth_date" value="" placeholder="Birth Date"  class="<?= ($has_error_birth_date) ? "highlight":"" ?>">
            <input type="file" name="profile_picture" id="profile_picture" value=""  class="<?= ($has_error_profile_picture) ? "highlight":"" ?>">
            <input type="submit" name="submit" value="submit" value="Submit Info" >
        </form>
    </div>
</body>
</html>
<?php 
// session_destroy();
unset($_SESSION["success_message"]);
?>
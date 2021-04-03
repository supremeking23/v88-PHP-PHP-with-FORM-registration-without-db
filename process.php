<?php 
session_start();

// validate
if(!isset($_POST["submit"])){
    header("Location: index.php");   
}else{
    $errors = array();

    // check for numbers
    function checkForNumericCharacter($str){
        $strArray = str_split($str);
        // $has_error = false;
        for($i = 0; $i < count($strArray); $i++){
            if(is_numeric($strArray[$i])){
                // $has_error = true;
                return TRUE;
                // break;
            }
        }
    }

    function checkPasswordLength($password,$maxLength){
        if(strlen($password) <= $maxLength){
            return TRUE;
        }
        return FALSE;
    }

    function checkPasswordAndConfirmPassword($password,$confirm_password){
        if($password !== $confirm_password){
            return TRUE;
        }

        return FALSE;
    }


    function validateDateOfBirth($date_of_birth){
        $format = explode("/",$date_of_birth);
        // var_dump($format);
        if(count($format)  <= 1){
            return TRUE;
        //    echo "invalid date format";
        }else{
            if(checkdate($format[0],$format[1], $format[2])){
                return FALSE;
            //no error
            }else{

                return TRUE;
            }
        }
    }


    function fileUpload($file){
        $target_dir = "uploads/";
        $rename = $file["name"] . time();
        $target_file = $target_dir . basename($file["name"]);
        move_uploaded_file($file["tmp_name"], $target_file);
    }

    //check if the variables are empty
    if(empty($_POST["email"]) AND isset($_POST["email"])){
        $errors[] = "Email cannot be blank";
        $_SESSION["has_error_email"] = TRUE;
    }else{
        $_SESSION["has_error_email"] = FALSE;
    }

    if(empty($_POST["first_name"]) AND isset($_POST["first_name"])){
        $errors[] = "First Name cannot be blank";
        $_SESSION["has_error_first_name"] = TRUE;
    }else{
        $_SESSION["has_error_first_name"] = FALSE;
    }

    if(empty($_POST["last_name"]) AND isset($_POST["last_name"])){
        $errors[] = "Last Name cannot be blank";
        $_SESSION["has_error_last_name"] = TRUE;
    }else{
        $_SESSION["has_error_last_name"] = FALSE;
    }

    if(empty($_POST["password"]) AND isset($_POST["password"])){
        $errors[] = "Password cannot be blank";
        $_SESSION["has_error_password"] = TRUE;
    }else{
        $_SESSION["has_error_password"] = FALSE;
    }

    if(empty($_POST["confirm_password"]) AND isset($_POST["confirm_password"])){
        $errors[] = "Confirm Password cannot be blank";
        $_SESSION["has_error_confirm_password"] = TRUE;
    }else{
        $_SESSION["has_error_confirm_password"] = FALSE;
    }

    if(empty($_POST["birth_date"]) AND isset($_POST["birth_date"])){
        $errors[] = "Birth Date cannot be blank";
        $_SESSION["has_error_birth_date"] = TRUE;
    }else{
        if(validateDateOfBirth($_POST["birth_date"])){
            $errors[] = "Error on date field, please use this format: mm/dd/yyyy";
            $_SESSION["has_error_birth_date"] = TRUE;
        }else{
            $_SESSION["has_error_birth_date"] = FALSE;
        }
        
    }

    if($_FILES["profile_picture"]["size"] == 0){
        $errors[] = "Profile picture cannot be blank";
        $_SESSION["has_error_profile_picture"] = TRUE;
    }else{
        fileUpload($_FILES["profile_picture"]);
        $_SESSION["has_error_profile_picture"] = FALSE;
    }


    if(checkForNumericCharacter($_POST["first_name"])){
        $errors[] = "First name cannot have a number";
        $_SESSION["has_error_first_name"] = TRUE;
    }

    if(checkForNumericCharacter($_POST["last_name"])){
        $errors[] = "Last name cannot have a number";
        $_SESSION["has_error_last_name"] = TRUE;
    }


    if(!empty($_POST["password"]) AND checkPasswordLength($_POST["password"],6) ){
        $errors[] = "Password should be more than 6 characters";
        $_SESSION["has_error_password"] = TRUE;
        $_SESSION["has_error_confirm_password"] = TRUE;
    }

    if(checkPasswordAndConfirmPassword($_POST["password"],$_POST["confirm_password"])){
        $errors[] = "Password and confirm password must match";
        $_SESSION["has_error_password"] = TRUE;
        $_SESSION["has_error_confirm_password"] = TRUE;
    }

    
  
   echo "error ." . count($errors);

    if(count($errors) > 0){
        $_SESSION["errors"] = $errors; 
    }else{
        $_SESSION["success_message"] = "Thank you for submitting your information";
        unset($_SESSION["errors"]);
        
        
        
    }
    header("Location: index.php");  


    // 


}
?>
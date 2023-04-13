<?php
session_start();
include "../inc/env.php";
//print_r($_REQUEST);

//VALIDATION RULES
$msg=$_REQUEST;

$name = $_REQUEST['name'];
$email = $_REQUEST['email'];
$phone = $_REQUEST['phone'];
$password = $_REQUEST['password'];
$confirm_password = $_REQUEST['confirm_password'];
$errors = [];


if(empty($name)){
    $errors['name_error'] = "Please enter your User Name";
}

if(empty($email)){
    $errors['email_error'] = "Please enter your User Email";
}else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    $errors['email_error'] = "Please enter your Valid Email";
}
 if(strlen($phone) != 11){
     $errors['phone_error'] = "Please enter your Valid Phone Number"; 
 }

 if(empty($password)){
    $errors['password_error'] = "Please enter your Password";
 }else if(strlen($password) < 8){
     $errors['password_error'] = "Please enter a strong Password";
 }


 if(empty($confirm_password)){
     $errors['con_password_error'] = "Please enter your Confirm Password";
 }else if($password != $confirm_password){
    $errors['con_password_error'] = "Confirm Password did not Match!";
 }
//print_r($errors);

//*CHECK FOR ERRORS

if(count($errors) > 0)
{
    //*REDIRECT BACK
    $_SESSION['errors'] = $errors;
    $_SESSION['info']=$msg;
    header("Location: ../register.php");
}else{
  
$query = "INSERT INTO users(name, email, phone, password) VALUES ('$name', '$email', '$phone', '$password')";

$response = mysqli_query($conn,$query);


 if($response){
     $_SESSION['msg'] = 'Your post has been submitted!';
     header("location: ../login.php");
 }

}
//var_dump($response);
//print_r($errors);
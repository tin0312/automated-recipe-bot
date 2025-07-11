<?php
session_start();

// extract post request data
$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];
$fullName = $_POST['full-name'];
include_once 'sendEmail.php';
// Save email to session
$_SESSION['email'] = $email;
// generate a random code and save in temp users table
$ranCode = substr(md5(uniqid(rand(), true)), 0, 6);

// TODO: save temp user in the temp user database
// TODO: save the generated code in the temp users table
// TODO: Check if the code submitted matches the one saved in the temp table
// TODO: Save the user into users table
// send the generated code with email
if(sendEmail($email, $fullName, $ranCode)){
    // redirect to verification page
    header('Location: /automated-recipe-bot/verification.php');
    exit();

} else {
    echo 'Something went wrong';
}
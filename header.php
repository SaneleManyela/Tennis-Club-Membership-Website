<?php
session_start(); //This begins a user session

/*This is where all the site's pages begin
 * and where the css and javascript files are
 * referenced
 */
echo <<<_INIT
<!DOCTYPE html>
<html>
    <head>
        <meta charset='utf-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <link rel='stylesheet' href='styles.css'>
        <script src='validationScript.js'></script>
       
_INIT;

/*Requires the php file containing
 * functions that are used throughout 
 * the site's operations
 */
require_once 'functions.php'; 

$userstr = "Welcome Guest"; //An unlogged user is welcomed

if(isset($_SESSION['user']))
{
    $user = $_SESSION['user'];
    $pass = $_SESSION['pass'];
    $loggedin = TRUE; //A boolean variable that specifies if a user is logged in
    $userstr = "Logged in as: ".ucfirst(strtolower($user));//A logged user is welcomed with login name
}
 else {
     $loggedin = FALSE;
}
//The upper part of each page
echo <<<_MAIN
        <title>Tennis Club Membership</title>
    </head>
    <body>
        <div data-role='page'>
            <div data-role='header'>
                <div id='logo' class='center'><img id='tennis' src='logo.png'>
                    Tennis Club</div>
                <div class='username'>$userstr</div>
            </div>
        <div data-role='content'>
_MAIN;
/*If a user is logged in, the site checks
 * if they logged in as a senior, junior consultant,
 * or as a member. This is evaluated based on the rank 
 * chosen on the 'login As' field
 * Based on the 'rank' the user is logged in as,
 * they are directed to the home page but a different
 * menu is displayed for each rank of user
 */
if($loggedin)
{
    switch(getUserIdentifier($_SESSION['rank']))
    {
        case "Senior Consultant":
echo <<<_LOGGEDIN
    <div class='center'>
        <ul>
            <li><a href="index.php?view=$user">Home</a></li>
            <li><a href="readAnnouncements.php">View Announcements</a></li>
            <li><a href="postAnnouncements.php">Post Announcements</a></li>
            <li><a href="logout.php">Log out</a></li>
        </ul>
    </div>
_LOGGEDIN;
            break;
        case "Junior Consultant":
echo <<<_LOGGEDIN
    <div class='center'>
        <ul>
            <li><a href="index.php?view=$user">Home</a></li>
            <li><a href="readAnnouncements.php">View Announcements</a></li>
            <li><a href="logout.php">Log out</a></li>
        </ul>
    </div>
_LOGGEDIN;
            break;
            
        case "Registered Member":
echo <<<_LOGGEDIN
    <div class='center'>
        <ul>
            <li><a href="index.php?view=$user">Home</a></li>
            <li><a href="account.php?view=$user">Account</a></li>
            <li><a href="update.php">Update Account</a></li>
            <li><a href="readAnnouncements.php">View Announcements</a></li>
            <li><a href="logout.php">Log out</a></li>
        </ul>
    </div>
_LOGGEDIN;
            break;
    }
}
else
{
echo <<<_GUEST
    <div class='center'>
         <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="login.php">Login</a></li>
        </ul>
    </div>
    <p class='info'>(You must be logged in to use this app)</p>
_GUEST;
}
?>
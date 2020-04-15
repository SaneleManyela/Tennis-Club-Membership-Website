<?php
require_once 'header.php';
//if a user is not logged in the form does not display account details
if(!$loggedin) 
{
    die("</div></body></html>");
}
//A declaration of variables to contain account data from database
$name; $contactNo; $address; $passwrd; $dOB; $sex; $nextOfKin;
$membership; $hasTrainer; $trainingTime;

//A querying and variable assignments
$result = queryMysql("SELECT * FROM tblMembers WHERE name='$user' AND password='$pass'");
$record = $result->fetch_array(MYSQLI_ASSOC);
$name = $record['Name'];
$contactNo = $record['ContactNumber'];
$address = $record['Address'];
$passwrd = $record['Password'];
$dOB = $record['DOB'];
$sex = $record['Sex'];
$nextOfKin = $record['NextOfKin'];
$membership = $record['Membership'];
$hasTrainer = $record['HasTrainer'];
$trainingTime = $record['TrainingTime'];

/*This is displayed if a user has changed their user name
 * or user password and as a result their account details 
 * can no longer be displayed, reason being that the website 
 * uses the password and user name the user logged in with to
 * query the database
 */ 
if($passwrd=="" && $name=="")
{
    echo "<div id='heading' class='center'>Hello $user, you have just updated your account details
         and changed either your username or password. Please log out and log in
         again to view your new account details.</div>";
}
else
{
    /*This is displayed whenever a user opens the account pages and user
     * account information has been fetched successfully from the database
     */
    echo "<div class='center' id='heading'>Your Account Details</div>";
}

//A user interface to display account details
echo <<<_END
<pre>
    <label for='name'>Name:</label>                $name <br>
    <label for='contactNo'>Contact No:</label>      $contactNo <br>
    <label for='address'>Address:</label>           $address <br>
    <label for='password'>Password:</label>         $passwrd <br>
    <label for='dob'>Date Of Birth:</label>   $dOB <br>
    <label for='sex'>Sex:</label>                     $sex <br>
    <label for='nextOfKin'>Next Of Kin:</label>     $nextOfKin<br>
    <label for='membership'>Membership:</label>    $membership<br>
    <label for='hasTrainer'>Has Trainer:</label>      $hasTrainer<br>
    <label for='trainingTime'>Training Time:</label>  $trainingTime<br>
</pre>
_END;
?>
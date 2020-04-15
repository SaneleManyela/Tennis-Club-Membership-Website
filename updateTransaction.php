<?php
require_once 'header.php';
/* The following lines of code get member ID from the database
 * The program then checks if form input controls have been
 * given values, if so each input value is sanitised then
 * an update query argument with input values is passed to the function
 * queryMysql(query) which update member account details
 */
$result = queryMysql("SELECT MemberID FROM tblMembers WHERE name='$user' AND password='$pass'");
$record = $result->fetch_array(MYSQLI_ASSOC);
$memberID = $record['MemberID'];

if(isset($_POST['name']))
{
    $name = sanitizeString($_POST['name']);
}
if(isset($_POST['contactNo']))
{
    $contactNo = sanitizeString($_POST['contactNo']);
}
if(isset($_POST['address']))
{
    $address = sanitizeString($_POST['address']);
}
if(isset($_POST['password']))
{
    $passwrd = sanitizeString($_POST['password']);
}
if(isset($_POST['DOB']))
{
    $dOB = sanitizeString($_POST['DOB']);
}
if(isset($_POST['sex']))
{
    $sex = sanitizeString($_POST['sex']);
}
if(isset($_POST['nextOfKin']))
{
    $nextOfKin = sanitizeString($_POST['nextOfKin']);
}
if(isset($_POST['membership']))
{
    $membership = sanitizeString($_POST['membership']);
}
if(isset($_POST['hasTrainer']))
{
    $hasTrainer = sanitizeString($_POST['hasTrainer']);
}
if(isset($_POST['trainingTime']))
{
    $trainingTime = sanitizeString($_POST['trainingTime']);
}

$result = queryMysql("UPDATE tblmembers SET name='$name', ContactNumber='$contactNo',
         address='$address', password='$passwrd', DOB='$dOB', sex='$sex',
         nextOfKin='$nextOfKin', membership='$membership', hasTrainer='$hasTrainer',
         trainingTime='$trainingTime' WHERE MemberID='$memberID'");

if(!$result)
{
    echo "<div class='center' id='heading'><b>Account details update was unsuccessful</b>";
}
else
{
    echo "<div class='center' id='heading'><b>Account details have been updated successfully</b>";
}

echo <<<_END
        </div>
            <br><br>
                
            <br><br><br>
        </div>
    <body>
</html>
_END;

?>
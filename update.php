<?php
require_once 'header.php';
//if a user is not logged the update form is not displayed
if(!$loggedin) 
{
    die("</div></body></html>");
}
//Assignment of variables with results from the database
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
//Update page heading
echo "<div class='center' id='heading'>Update Your Account Details</div>";
//A GUI form that allows member users to update their account details
echo <<<_END
            <table class="updateDetails" border="0" cellpadding="2" cellspacing="5">
            
            <form method="post" action="update.php" onsubmit="return validate(this)">
                    <tr><td><label>Name</label></td>
                        <td><input type="text" maxlength="32" name="name" value='$name'></td></tr>
                    <tr><td><label>Contact No</label></td>
                        <td><input type="text" maxlength="32" name="contactNo" value='$contactNo'></td></tr>
                    <tr><td><label>Address</label></td>
                        <td><textarea maxlength="32" name="address">$address</textarea></td></tr>
                    <tr><td><label>Password</label></td>
                        <td><input type="text" maxlength="12" name="password" value='$passwrd'></td></tr>
                    <tr><td><label>Date Of Birth</label></td>
                        <td><input type="date" maxlength="32" name="DOB" value='$dOB'></td></tr>
                    <tr><td><label>Sex<label></td>
                        <td><select maxlength="32" name="sex">
_END;
                            if($sex == "Female")
                            {
                                echo <<<_SEX
                                <option value='Female' selected='$sex'>Female</option>
                                <option value='Male'>Male</option>    
_SEX;
                            }
                            else
                            {
                                echo <<<_SEX
                                <option value='Female'>Female</option>
                                <option value='Male' selected='$sex'>Male</option>    
_SEX;
                            }
echo <<<_END
                            </select></td></tr>
                    <tr><td><label>Next of Kin</label></td>
                        <td><input type="text" maxlength="12" name="nextOfKin" value='$nextOfKin'></td></tr>
                    <tr><td><label>Membership<label></td>
                        <td><select maxlength="32" name="membership">
_END;
                            switch ($membership)
                            {
                                case "Beginner Membership":
                                echo <<<_MEMBERSHIP
                                <option value='Beginner Membership' selected='$membership'>Beginner Membership</option>
                                <option value='Junior Membership'>Junior Membership</option>
                                <option value='Advanced Membership'>Advanced Membership</option>
                                <option value='Professional Membership'>Professional Membership</option>
_MEMBERSHIP;
                                    break;
                                case "Junior Membership":
                                echo <<<_MEMBERSHIP
                                <option value='Beginner Membership'>Beginner Membership</option>
                                <option value='Junior Membership' selected='$membership'>Junior Membership</option>
                                <option value='Advanced Membership'>Advanced Membership</option>
                                <option value='Professional Membership'>Professional Membership</option>
_MEMBERSHIP;
                                    break;
                                case "Advanced Membership":
                                echo <<<_MEMBERSHIP
                                <option value='Beginner Membership'>Beginner Membership</option>
                                <option value='Junior Membership'>Junior Membership</option>
                                <option value='Advanced Membership' selected='$membership'>Advanced Membership</option>
                                <option value='Professional Membership'>Professional Membership</option>
_MEMBERSHIP;
                                    break;
                                case "Professional Membership":
                                echo <<<_MEMBERSHIP
                                <option value='Beginner Membership'>Beginner Membership</option>
                                <option value='Junior Membership'>Junior Membership</option>
                                <option value='Advanced Membership''>Advanced Membership</option>
                                <option value='Professional Membership' selected='$membership>Professional Membership</option>
_MEMBERSHIP;
                                    break;
                            }
echo <<<_END
                            </select></td></tr>
                    <tr><td><label>Has Trainer<label></td>
                        <td><select maxlength="32" name="hasTrainer">
_END;
                            if($hasTrainer == "Yes")
                            {
                                echo <<<_TRAINER
                                <option value='yes' selected='$hasTrainer'>Yes</option>
                                <option value='no'>No</option>    
_TRAINER;
                            }
                            else
                            {
                                echo <<<_TRAINER
                                <option value='yes'>Yes</option>
                                <option value='no' selected='$hasTrainer'>No</option>    
_TRAINER;
                            }
echo <<<_END
                            </select></td></tr>
                    <tr><td><label>Training Time<label></td>
                        <td><select maxlength="32" name="trainingTime">
_END;
                            switch($trainingTime)
                            {
                                case "7:00 - 9:00":
                                echo <<<_TrainingTime
                                <option value='7:00 - 9:00' selected='$trainingTime'>7:00 - 9:00</option>
                                <option value='9:00 - 11:00'>9:00 - 11:00</option>
                                <option value='11:00 - 13:00'>11:00 - 13:00</option>
                                <option value='14:00 - 16:00'>14:00 - 16:00</option>
                                <option value='16:00 - 18:00'>16:00 - 18:00</option>
_TrainingTime;
                                    break;
                                case "9:00 - 11:00":
                                echo <<<_TrainingTime
                                <option value='7:00 - 9:00'>7:00 - 9:00</option>
                                <option value='9:00 - 11:00' selected='$trainingTime'>9:00 - 11:00</option>
                                <option value='11:00 - 13:00'>11:00 - 13:00</option>
                                <option value='14:00 - 16:00'>14:00 - 16:00</option>
                                <option value='16:00 - 18:00'>16:00 - 18:00</option>
_TrainingTime;
                                    break;
                                case "11:00 - 13:00":
                                echo <<<_TrainingTime
                                <option value='7:00 - 9:00'>7:00 - 9:00</option>
                                <option value='9:00 - 11:00'>9:00 - 11:00</option>
                                <option value='11:00 - 13:00' selected='$trainingTime'>11:00 - 13:00</option>
                                <option value='14:00 - 16:00'>14:00 - 16:00</option>
                                <option value='16:00 - 18:00'>16:00 - 18:00</option>
_TrainingTime;
                                    break;
                                case "14:00 - 16:00":
                                echo <<<_TrainingTime
                                <option value='7:00 - 9:00'>7:00 - 9:00</option>
                                <option value='9:00 - 11:00'>9:00 - 11:00</option>
                                <option value='11:00 - 13:00'>11:00 - 13:00</option>
                                <option value='14:00 - 16:00' selected='$trainingTime'>14:00 - 16:00</option>
                                <option value='16:00 - 18:00'>16:00 - 18:00</option>
_TrainingTime;
                                    break;
                                case "16:00 - 18:00":
                                echo <<<_TrainingTime
                                <option value='7:00 - 9:00'>7:00 - 9:00</option>
                                <option value='9:00 - 11:00'>9:00 - 11:00</option>
                                <option value='11:00 - 13:00'>11:00 - 13:00</option>
                                <option value='14:00 - 16:00'>14:00 - 16:00</option>
                                <option value='16:00 - 18:00' selected='$trainingTime'>16:00 - 18:00</option>
_TrainingTime;
                                    break;
                            }
echo <<<_END
                            </select></td></tr>
                    <tr><td colspan="24" align="center">
                        <input type="submit" formaction='updateTransaction.php' value="Update">
                        </td></tr>
                </form>
        </table>
    <br><br>
    </body>
</html>
_END;
?>
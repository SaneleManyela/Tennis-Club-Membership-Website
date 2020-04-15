<?php
require_once 'header.php';
$error = $user = $pass = $rank = ""; //declaration and initialisation of variables
//if the text field named 'user' has a set value, this code executes
if(isset($_POST['user'])) 
{
    //Line 8, 9, 10 sanitises the assigns user passed values to variables
    $user = sanitizeString($_POST['user']); 
    $pass = sanitizeString($_POST['pass']);
    $rank = sanitizeString($_POST['rank']);
    /*A statement to check if all fields were passed values.
     * This is evaluated based on contents of the variables 
     * that were assigned values from user input.
     * If all fields were given values, the program code determines
     * which user to query the database for its login details, this is
     * based on the value returned by the function getUserIdentifier()
     * passed the rank field value. If the user is a consultant their 
     * passed details are authenticated against the ones from the database
     * if its a valid user, they are directed to the home page. The same goes 
     * for a user that has the member rank 
     */
    if($user == "" || $pass =="")
    {
        $error = "Not all fields were entered";
    }
    else {
        switch(getUserIdentifier($_POST['rank']))
        {
            case "Junior Consultant": case "Senior Consultant": 
                $result = queryMysql("SELECT name, password, rank FROM tblconsultants
                    WHERE name='$user' AND password='$pass' AND rank='$rank'");
                if($result -> num_rows == 0)
                {
                    $error = "Invalid login attempt";
                }
                else
                {
                    $_SESSION['user'] = $user;
                    $_SESSION['pass'] = $pass;
                    $_SESSION['rank'] = $rank;
                    die("<br><div class='center'><b>You are now logged in. Please 
                    <a data-transition='slide' href='index.php?view=$user'>
                    Click here</a> to continue.</b></div></div><br><br></body></html><br>");
                     
                }
                break;
            
            case "Registered Member":
                $result = queryMysql("SELECT name, password, membership FROM tblmembers
                    WHERE name='$user' AND password='$pass' AND membership='$rank'");
                if($result -> num_rows == 0)
                {
                    $error = "Invalid login attempt";
                }
                else
                {
                    $_SESSION['user'] = $user;
                    $_SESSION['pass'] = $pass;
                    $_SESSION['rank'] = $rank;
                    die("<br><div class='center'><b>You are now logged in. Please 
                    <a data-transition='slide' href='index.php?view=$user'>
                    Click here</a> to continue.</b></div></div><br><br></body></html><br>");
                }
                break;
        }
    }
}
//A login form
echo <<<_END
    <form method='post' action='login.php'>
    <div data-role='container' class='center'>
        <div data-role='fieldcontain'>
            <label></label>
            <span class='error'>$error</span>
        </div>
        <div data-role='fieldcontain'>
            <label>Please enter your details to log in</label>
        </div>
        <br><br>
        <div data-role='fieldcontain'>
        <pre><label for='Username'>Username</label>  <input type='text' maxlength='16'
            name='user' required="required" value='$user'></pre>
        </div>
        <div data-role='fieldcontain'>
            <pre><label for='Password'>Password</label>  <input type='password' maxlength='16' name='pass' required="required"
                    value='$pass'></pre>
        </div>
        <div data-role='fieldcontain'>
            <pre><label for='Login As'>Login As:</label>  <select name='rank'>
                        <option value='Beginner Membership'>Beginner Membership</option>
                        <option value='Junior Membership'>Junior Membership</option>
                        <option value='Advanced Membership'>Advanced Membership</option>
                        <option value='Professional Membership'>Professional Membership</option>
                        <option value='Junior Consultant'>Junior Consultant</option>
                        <option value='Senior Consultant'>Senior Consultant</option>
                </select></pre>
        </div>
            <input align='center' data-transition='slide' type='submit' value='Login'>
        </div>
    </div>
        <br><br><br>
    </form>
</div>
</body>
</html>    
_END;
?>
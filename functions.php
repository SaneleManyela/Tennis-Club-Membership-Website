<?php
$host_name = 'localhost'; //database host name
$database_name = 'tennisClubMembership'; //Name of the database used
$username = 'root'; //name of the database user
$password = 'password'; //password of the database

/*A database connection to connect the user so that
 * they can access contents in database, such as
 * their log in details, their account details, and
 * announcement details
 */
$connection = new mysqli($host_name, $username, $password, $database_name);

//This statement checks if there was no error while connecting to the database
if($connection ->connect_error) 
{
    mysql_fatal_error(); //A function that outputs user friendly error message
}

/*A function that executes all SQL queries - depending on
 * the correctness of the passed argument - and then
 * returns a result
 */
function queryMysql($query)
{
    global $connection;
    $result = $connection->query($query);
    if (!$result) {
        echo mysqli_error($connection);
    }
    return $result;
}

function GetLastPostedAnnouncementID()
{
    $fetchID = queryMysql("SELECT AnnouncementID FROM tblAnnouncements");
    $ID = array();
    if($fetchID -> num_rows)
    {
        $rows = $fetchID -> num_rows;
        for($i = 0; $i < $rows; $i++)
        {
            $rowID = $fetchID -> fetch_Array(MYSQLI_NUM);
            array_push($ID, array_pop($rowID));
        }
        return $lastIndex = array_pop($ID);
    }
}

//A function that destroy user session with a cookie that expires after one day
function destroySession()
{
    $_SESSION = array();
    if(session_id() != "" || isset($_COOKIE[session_name()]))
    {
        setcookie(session_name(), '', time()-86400, '/');
    }
    session_destroy();
}
//A funtion that sanitises user input in order to prevent malicious code
function sanitizeString($var)
{
    global $connection;
    $var = strip_tags($var);
    $var = htmlentities($var);
    if(get_magic_quotes_gpc())
    {
        $var = stripcslashes($var);
    }
    return $connection->real_escape_string($var);
}

//A function that identifies a user based on user rank 
function getUserIdentifier($field)
{
    if(preg_match("/Junior Consultant/",$field))
    {
        return "Junior Consultant";
    }
    else if(preg_match("/Senior Consultant/", $field)){
        return "Senior Consultant";
    }
    else if(preg_match("/ *Membership/", $field))
    {
        return "Registered Member";
    }
}
//A function that outputs user friendly error message
function mysql_fatal_error()
{
    echo <<<_END
    <div> We are sorry, but it was not possible to complete
    the requested task. The error message we got was:
        <p class='error'>Fatal Error</p/>
    Please click the back button on your browser
    and try again. If you are still having problems,
    please <a href="mailto:admission@server.com">email
            our adminstrator</a>. Thank you.</br>
        </div>
_END;
}

?>

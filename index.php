<?php
require_once 'header.php'; //A request to use a header on this page

echo "<div class='center'><b>Welcome to Tennis Club web application</b>";
if($loggedin)
{
    echo " <b>$user, you are logged in.</b>"; //Shows when a user is logged in
}
else {
    echo "<b>, please log in.<b>"; //Shows when a user is not logged in
}
//This displays on the footer
echo <<<_END
        </div>
            <br><br><br>
        </div>
        <div data-role="footer">
        <h4 class='center'>Web-facing Interface of the <i>Tennis Membership</i> application</h4>
        </div><br><br>
    <body>
</html>
_END;
?>


<?php
require_once 'header.php';
/*When the logout menu is selected, this statement
 * first checks if a user has a session going on, if
 * so the user session is destroyed the logged out
 * else if the user select logout on the menu for the
 * second time, they are told they cannot logout as they
 * are not logged in * 
 */
if(isset($_SESSION['user']))
{
    destroySession();
    echo "<br><div class='center'><b>You have been logged out. Please
        <a data-transition='slide' href='index.php'>Click here</a>
        to refresh the screen.</b></div><br><br>";
}
else {
    echo "<div class='center' class='info'><b> You cannot log out because you are not
        logged in</b></div><br><br>";
}
?>
</div>
</body>
</html>

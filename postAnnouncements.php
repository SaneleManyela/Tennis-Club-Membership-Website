<?php

require_once 'header.php';

//if a user is not logged the post announcements form is not displayed
if(!$loggedin) 
{
    die("</div></body></html>");
}
$text = $audioLoc = $imageLoc = $videoLoc = "";
if(isset($_POST['upload'])){
    if($_POST['text'] !== ""){
        $text = GetTextAnnouncement();
    }else{
        $text = "No text announcement for latest announcement posted";
    }
    
    if(!($_FILES['audio']['size'] == 0)){
        $audioLoc = GetAudioLocation();
    }else{
        $audioLoc = "";
    }
    
    if(!($_FILES['image']['size'] == 0)){
        $imageLoc = GetImageLocation(); 
    }else{
        $imageLoc = "";
    }
    
    if(!($_FILES['video']['size'] == 0)){
        $videoLoc = GetVideoLocation();
    }
    else{
        $videoLoc = "";
    }
    UploadAnnouncement();
    /**
    if(!empty($_FILES['audio']['size'])){
        //$_FILES && ($_FILES['audio']['name'])
        $maxsize = 5242880; // 5MB is the maximum size of a file to be uploaded

        $name = $_FILES['audio']['name'];//name of the video file to be uploaded
        $target_dir = "Announcements/"; //directory where announcement files are stored
        $target_file = $target_dir . $_FILES["audio"]["name"];

        // Select file type
        $audioFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        // Valid file extensions
        $extensions_arr = array("m4a","mp3","ogg");

        // Check extension
        if( in_array($audioFileType,$extensions_arr) ){
 
            // Check file size
            if(($_FILES['audio']['size'] >= $maxsize) || ($_FILES["audio"]["size"] == 0)) {
                echo "File too large. File must be less than 5MB.";
            }else{
                // Upload file to the database
                if(move_uploaded_file($_FILES['audio']['tmp_name'],$target_file)){
                    queryMysql("UPDATE tblAnnouncements SET AudioAnnouncement='$target_file' WHERE AnnouncementID = '".GetLastPostedAnnouncementID()."'");
                }
            }
        }else{
              echo "Invalid file extension.<br>";
        }
    }else{
        queryMysql("UPDATE tblAnnouncements SET AudioAnnouncement='$audioLoc' WHERE AnnouncementID = '".GetLastPostedAnnouncementID()."'");
    }
    **/
}

/*These multi-line statements check if the 'upload' button has 
 *been clicked, if so each statement code is executed if a
 * value has been given to its respective field
*/
function GetVideoLocation(){
    if(isset($_POST['upload'])){
        if(!($_FILES['video']['size'] == 0)){    
            $maxsize = 5242880; // 5MB is the maximum size of a file to be uploaded
            $name = $_FILES['video']['name']; //name of the video file to be uploaded
            $target_dir = "Announcements/"; //directory where announcement files are stored
            $target_file = $target_dir . $name;
            $videoFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION)); // Select file type
            $extensions_arr = array("mp4","avi","3gp","mov","mpeg"); // Valid file extensions
            if( in_array($videoFileType,$extensions_arr) ){ // Check extension
                if(($_FILES['video']['size'] >= $maxsize) || ($_FILES["video"]["size"] == 0)) {
                    echo "<div class='center' id='AnnouncementTypeface'>Video file too large. File must be less than 5MB.</div>";
                }else{
                    if(move_uploaded_file($_FILES['video']['tmp_name'],$target_file)){
                        return $target_file;
                    }
                }
            }else { echo "<div class='center' id='AnnouncementTypeface'>Invalid video file extension.</div><br>"; }
        }
    }
}

function GetAudioLocation(){
    if(isset($_POST['upload'])){
        if(!($_FILES['audio']['size'] == 0)){
            $maxsize = 5242880; // 5MB is the maximum size of a file to be uploaded
            $name = $_FILES['audio']['name'];//name of the video file to be uploaded
            $target_dir = "Announcements/"; //directory where announcement files are stored
            $target_file = $target_dir . $name;
            $audioFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION)); // Select file type
            $extensions_arr = array("m4a","mp3","ogg"); // Valid file extensions
            if(in_array($audioFileType,$extensions_arr)) { // Check extension
                if(($_FILES['audio']['size'] >= $maxsize) || ($_FILES["audio"]["size"] == 0)) {
                    echo "<div class='center' id='AnnouncementTypeface'>Audio file too large. File must be less than 5MB.</div>";
                }else{
                    if(move_uploaded_file($_FILES['audio']['tmp_name'],$target_file)){
                        return $target_file;
                    }
                }
            }else{ echo "<div class='center' id='AnnouncementTypeface'>Invalid audio file extension.</div><br>"; }
        }
    }
}

function GetImageLocation(){ 
    if(isset($_POST['upload'])){
        if(!($_FILES['image']['size'] == 0)){
            $maxsize = 5242880; // 5MB is the maximum size of a file to be uploaded
            $name = $_FILES['image']['name'];
            $target_dir = "Announcements/";//directory where announcement files are stored
            $target_file = $target_dir . $name;
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION)); // Select file type
            $extensions_arr = array("pjpeg","jpeg","jpg","gif","png","tif"); // Valid file extensions
            if( in_array($imageFileType,$extensions_arr) ){ // Check extension
                if(($_FILES['image']['size'] >= $maxsize) || ($_FILES["image"]["size"] == 0)) {
                    echo "<div class='center' id='AnnouncementTypeface'>Image file too large. File must be less than 5MB.</div>";
                }else{
                    if(move_uploaded_file($_FILES['image']['tmp_name'],$target_file)){
                        return $target_file;
                    }
                }
            }else{ echo "<div class='center' id='AnnouncementTypeface'>Invalid file extension.</div><br>"; }
        }
    }
}

function GetTextAnnouncement(){
    if(isset($_POST['upload'])){
        //Check if 'text' field has been given values 
        if($_POST['text'] !== ""){
            //Sanitise user input 
            $textAnnouncement = sanitizeString($_POST['text']);
            //A regex operation to replace excesive spaces with one space character
            return $textAnnouncement = preg_replace('/\s\s+/', ' ', $textAnnouncement);
        }
    }
}

function UploadAnnouncement(){
    global $text; global $audioLoc; global $imageLoc; global $videoLoc;
    $time = DateFormater("l F jS, Y - g:ia", time());
    if(isset($_POST['text']) || isset($_FILES['audio']) || isset($_FILES['image'])
            || isset($_FILES['video'])){
        $query = "INSERT INTO tblAnnouncements(time,TextAnnouncement, AudioAnnouncement, ImageAnnouncement, "
                . "VideoAnnouncement, ConsultantID)"
                . " VALUES('".$time."','". $text ."','".$audioLoc."','". $imageLoc."','".$videoLoc."','".GetConsultantID()."')";
        queryMysql($query);  
        echo "<div class='center' id='AnnouncementTypeface'>Announcement Uploaded Successfully</div>";
    }
}

//A GUI form for users to upload files, url, and text
echo <<<_END
    <form method='post' action='' enctype='multipart/form-data'>
        <div class='center' id='heading'>Post An Announcement</div><br>
        <pre><div class='center'>
        <label for='caption'>Text</label>                  <textarea name='text'></textarea><br>
        <label for='audio'>Audio</label>              <input type='file' name='audio' accept=".m4a, .mp3, .ogg"/><br>
        <label for='image'>Image</label>              <input type='file' name='image' accept=".jpg, .pjpeg, .gif, .tiff, .png"/><br>
        <label for='video'>Video</label>              <input type='file' name='video' accept=".mp4, .webm, .ogv"/><br>
            <input type='submit' name='upload' value='Upload Announcement'>
        </div></pre>
    </form>
    </div><br>
_END;
/*A function that takes two arguments as parameters
 *and return a formated date and time
 */
function DateFormater($formating, $timestamp)
{
    return date($formating, $timestamp);
}
// A function that gets consultant ID from the database and return it
function GetConsultantID()
{
    $consultantName = $_SESSION['user'];
    $consultantPassword = $_SESSION['pass'];
    $consultantRank = $_SESSION['rank'];
    $query = "SELECT ConsultantID from tblConsultants WHERE name='$consultantName'"
                        . " AND password='$consultantPassword' AND rank='$consultantRank'";
    $result = queryMysql($query);
    $consultantID = $result -> fetch_array(MYSQLI_ASSOC);
    return $consultantID['ConsultantID'];    
}
?>
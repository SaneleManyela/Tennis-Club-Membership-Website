<?php
require_once 'header.php';

//if a user is not logged in the form does not display announcements
if(!$loggedin) 
{
    die("</div></body></html>");
}
//A declaration and initialisation of variables
$audioLocation = $imageLocation = $videoLocation = $textAnnouncement = $time = "";

//Begining of a form that allows users to view announcements
echo "<form method='post' action='viewAnnouncements.php' enctype='multipart/form-data'>";

$fetchAnnouncements = queryMysql("SELECT Time, TextAnnouncement, AudioAnnouncement,"
        . "ImageAnnouncement, VideoAnnouncement FROM tblAnnouncements WHERE "
        . "AnnouncementID='". GetLastPostedAnnouncementID() ."'");

if($fetchAnnouncements -> num_rows){
    $idAnnouncements = $fetchAnnouncements -> fetch_array(MYSQLI_ASSOC);
    while (next($idAnnouncements)){
        $time = $idAnnouncements['Time']; 
        $textAnnouncement = stripslashes($idAnnouncements['TextAnnouncement']);
        $textAnnouncement = stripslashes(preg_replace('/\s]s+/', ' ', $textAnnouncement));
        $audioLocation = $idAnnouncements['AudioAnnouncement'];
        $imageLocation = $idAnnouncements['ImageAnnouncement'];
        $videoLocation = $idAnnouncements['VideoAnnouncement'];
    }
        echo <<<_END
        <div class='center' id='AnnouncementTypeface'>Announcements Posted on $time</div><br><br>
        <div class='center' id='AnnouncementTypeface'><b>Text Announcement</b></div>
        <hr color='black'><div class='center' id='AnnouncementTypeface' id='TextAnnouncementStyle'>$textAnnouncement</div><hr color='black'><br><br>
        
        <div class='center' id='AnnouncementTypeface'><b>Audio Announcement</b></div><br>
        <div class='center'>
            <audio controls>
            <source src="$audioLocation">
            </audio>
        </div><br><br>       
        
        <div class='center' id='AnnouncementTypeface'><b>Image Announcement</b></div>
        <div class='center'><img src="$imageLocation"></div><br><br>
        
        <div class='center' id='AnnouncementTypeface'><b>Video Announcement</b></div><br><br>
        <div class='center'>
        <video width="560" height="320" controls>
            <source src="$videoLocation">
        </video></div><br><br>
_END;
    
}
else{
    echo <<<_END
        <div class='center' id='AnnouncementTypeface'>No Announcements to Display</div><br><br>
        <div class='center' id='AnnouncementTypeface'><b>Text Announcement</b></div>
        <hr color='black'><div id='AnnouncementTypeface' id='TextAnnouncementStyle'>$textAnnouncement</div><hr color='black'><br><br>
        
        <div class='center' id='AnnouncementTypeface'><b>Audio Announcement</b></div>
        <div class='center'>
            <audio controls>
            <source src="$audioLocation">
            </audio>
        </div><br><br>       
        
        <div class='center' id='AnnouncementTypeface'><b>Image Announcement</b></div>
        <div class='center'><img src="$imageLocation"></div><br><br>
        
        <div class='center' id='AnnouncementTypeface'><b>Video Announcement</b></div><br><br>
        <div class='center'>
        <video width="560" height="320" controls>
            <source src="$videoLocation">
        </video></div><br><br>
_END;
}
?>
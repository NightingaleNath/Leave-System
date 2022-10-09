<?php
session_start();
include('includes/config.php');
$dt     = new DateTime('now', new DateTimezone('Africa/Accra'));
$date   = $dt->format('F j, Y');
$tm     = new DateTime('now', new DateTimezone('Africa/Accra'));
$time   = $tm->format('g:i a');

$msg      = str_replace("'", "", $_POST['message']);
$receiver = $_POST['receive']; //incoming msg id
$sender   = $_POST['send']; //outgoing msg id

$sql = "INSERT INTO 
    tbl_message(
     incoming_msg_id, 
     outgoing_msg_id, 
     text_message, 
     curr_date, 
     curr_time
     )VALUES(
    '$receiver', 
    '$sender', 
    '$msg', 
    '$date ',
    '$time'
    )";
$lastInsertId = mysqli_query($conn, $sql) or die(mysqli_error());
 if($lastInsertId) {

} else {
    echo "Message sending failed!";
}

?>
<?php
include('includes/config.php');
?>

<ul>
    <?php 
    $receiver = $_GET['receive'];
    $sender   = $_GET['send'];
    
    $sql = "SELECT * FROM tbl_message LEFT JOIN tblemployees ON tblemployees.emp_id = tbl_message.outgoing_msg_id 
    WHERE incoming_msg_id='$receiver' AND outgoing_msg_id='$sender' || outgoing_msg_id='$receiver' AND 
    incoming_msg_id='$sender' ORDER BY msg_id ASC";
    $query = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_array($query)){ 
    $id = $row['emp_id'];
    if($sender == $id){
    ?>
    <li class="clearfix admin_chat">
    <span class="chat-img">
    <img src="<?php echo (!empty($row['location'])) ? '../uploads/'.$row['location'] : '../uploads/NO-IMAGE-AVAILABLE.jpg'; ?>" alt="">
    </span>
    <div class="chat-body clearfix">
    <p><?php echo $row['text_message']; ?></p>
    <div class="chat_time"><?php echo $row['curr_date'] . $row['curr_time'] ; ?></div>
    </div>
    </li>
    <?php }else{ ?>

    <li class="clearfix">
    <span class="chat-img">
        <img src="<?php echo (!empty($row['location'])) ? '../uploads/'.$row['location'] : '../uploads/NO-IMAGE-AVAILABLE.jpg'; ?>" alt="">
    </span>
    <div class="chat-body clearfix">
        <p><?php echo $row['text_message']; ?></p>
        <div class="chat_time"><?php echo $row['curr_date'] . $row['curr_time'] ; ?></div>
    </div>
    </li>

    <?php } ?>
    <?php } ?>

</ul>
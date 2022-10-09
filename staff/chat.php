<!DOCTYPE html>
<html>
<head>
	<!-- Basic Page Info -->
	<meta charset="utf-8">
    <title>ACI Leave System</title>

	 <!-- Site favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="../vendors/images/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../vendors/images/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../vendors/images/favicon-16x16.png">

	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- Google Font -->
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="../vendors/styles/core.css">
    <link rel="stylesheet" type="text/css" href="../vendors/styles/icon-font.min.css">
    <link rel="stylesheet" type="text/css" href="../src/plugins/jquery-steps/jquery.steps.css">
    <link rel="stylesheet" type="text/css" href="../src/plugins/datatables/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="../src/plugins/datatables/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="../vendors/styles/style.css">


	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-119386393-1"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'UA-119386393-1');
	</script>
</head>

<?php include('../includes/config.php'); ?>
<?php include('../includes/session.php');?>

<?php
   if(!isset($_GET['sender']) && $_GET['receiver'] == null){
     echo "<script>window.location='chat.php';</script>";
   }else{
      $sender   = $_GET['sender'];
      $receiver = $_GET['receiver'];
   }
?>

<body>
	<!-- <div class="pre-loader">
        <div class="pre-loader-box">
            <div class="loader-logo"><img src="../vendors/images/deskapp-logo-svg.png" alt=""></div>
            <div class='loader-progress' id="progress_div">
                <div class='bar' id='bar1'></div>
            </div>
            <div class='percent' id='percent1'>0%</div>
            <div class="loading-text">
                Loading...
            </div>
        </div>
    </div> -->

    <!-- Getting Sender & Receiver Id through hidden inputs -->
    <input type="hidden" id="receive" value="<?php echo $receiver; ?>"> 
    <input type="hidden" id="send" value="<?php echo $sender; ?>">
    <!-- Getting Sender & Receiver Id through hidden inputs -->
    
    <div class="header">
		<div class="header-left">
			<div class="menu-icon dw dw-menu"></div>
			<div class="search-toggle-icon dw dw-search2" data-toggle="header_search"></div>
			
		</div>
		<div class="header-right">
			<div class="dashboard-setting user-notification">
				<div class="dropdown">
					<a class="dropdown-toggle no-arrow" href="javascript:;" data-toggle="right-sidebar">
						<i class="dw dw-settings2"></i>
					</a>
				</div>
			</div>
			
			<div class="user-info-dropdown">
				<div class="dropdown">

					<?php $query= mysqli_query($conn,"select * from tblemployees where emp_id = '$session_id'")or die(mysqli_error());
								$row = mysqli_fetch_array($query);
						?>

					<a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">
						<span class="user-icon">
							<img src="<?php echo (!empty($row['location'])) ? '../uploads/'.$row['location'] : '../uploads/NO-IMAGE-AVAILABLE.jpg'; ?>" alt="">
						</span>
						<span class="user-name"><?php echo $row['FirstName']. " " .$row['LastName']; ?><br><h6 style="font-size: 12px; color: white; margin-right: 10px; margin-top: 5px;"><i style="margin-right: 2px;" class="fa fa-circle text-light-green"></i> <?php echo $row['Status']; ?></h6></span>
						
					</a>
					<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
						<a class="dropdown-item" href="staff_profile.php"><i class="dw dw-user1"></i> Profile</a>
						<a class="dropdown-item" href="change_password.php"><i class="dw dw-help"></i> Reset Password</a>
						<a class="dropdown-item" href="../logout.php"><i class="dw dw-logout"></i> Log Out</a>
					</div>
				</div>
			</div>
			
		</div>
	</div>

    <?php include('includes/right_sidebar.php')?>

    <?php include('includes/left_sidebar.php')?>

	<div class="mobile-menu-overlay"></div>

	<div class="main-container">
		<div class="pd-ltr-20 xs-pd-20-10">
			<div class="min-height-200px">
				<!-- <div class="page-header">
					<div class="row">
						<div class="col-md-6 col-sm-12">
							<div class="title">
								<h4>Chat</h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.html">Home</a></li>
									<li class="breadcrumb-item active" aria-current="page">Chat</li>
								</ol>
							</nav>
						</div>
					</div>
				</div> --> 

				<div class="bg-white border-radius-4 box-shadow mb-30">
					<div class="row no-gutters">
						<div class="col-lg-3 col-md-4 col-sm-12">
							<div class="chat-list bg-light-gray">
								<div class="chat-search">
									<span class="ti-search"></span>
									<input type="text" placeholder="Search Contact">
								</div>
								<div class="notification-list chat-notification-list customscroll">
									<ul>
                                        <?php
		                                  $query = mysqli_query($conn,"select * from tblemployees where Department = '$session_depart' and emp_id != '$session_id'") or die(mysqli_error());
		                                  while ($row = mysqli_fetch_array($query)) {
		                                  $id = $row['emp_id'];
		                                  ?>
										<li>
											<a href="chat.php?sender=<?php echo $session_id; ?>&receiver=<?php echo $row['emp_id']; ?>">
												<img src="<?php echo (!empty($row['location'])) ? '../uploads/'.$row['location'] : '../uploads/NO-IMAGE-AVAILABLE.jpg'; ?>" alt="">
												<h3 class="clearfix"><?php echo substr($row['FirstName']. " " .$row['LastName'], 0, 15); ?></h3>
												<p>
                                                 <?php
                                                  if($row['Status'] == "Online") {
                                                    echo "<i class='fa fa-circle text-light-green'></i>";
                                                  } else {
                                                    echo "<i class='fa fa-circle text-light-orange'></i>";
                                                  }
                                                 ?>
                                                 <?php echo $row['Status'];?>
                                                </p>
											</a>
										</li>
										
										<?php }?>
									</ul>
								</div>
							</div>
						</div>
						<div class="col-lg-9 col-md-8 col-sm-12">
							<div class="chat-detail">
								<div class="chat-profile-header clearfix">
									<div class="left">
										<div class="clearfix">
                                            <?php
		                                    $query = mysqli_query($conn,"select * from tblemployees where emp_id='$receiver'") or die(mysqli_error());
		                                    while ($row = mysqli_fetch_array($query)) {
		                                    $id = $row['emp_id'];
		                                    ?>
											<div class="chat-profile-photo">
											   <img src="<?php echo (!empty($row['location'])) ? '../uploads/'.$row['location'] : '../uploads/NO-IMAGE-AVAILABLE.jpg'; ?>" alt="">
											</div>
											<div class="chat-profile-name">
												<h3><?php echo $row['FirstName']. " " .$row['LastName']; ?></h3>
												<span style="margin-top: 5px;"><?php
                                                  if($row['Status'] == "Online") {
                                                    echo "<i style='margin-right: 2px; margin-top: 2px;' class='fa fa-circle text-light-green'></i>";
                                                  } else {
                                                    echo "<i style='margin-right: 2px; margin-top: 2px;' class='fa fa-circle text-light-orange'></i>";
                                                  }
                                                 ?>
                                                 <?php echo $row['Status'];?></span>
											</div>
                                            <?php }?>
										</div>
									</div>
									<div class="right text-right">
										<div class="dropdown">
											<a class="btn btn-outline-primary dropdown-toggle" href="#" role="button" data-toggle="dropdown">
												Setting
											</a>
											<div class="dropdown-menu dropdown-menu-right">
												<a class="dropdown-item" href="#">Export Chat</a>
												<a class="dropdown-item" href="#">Search</a>
												<a class="dropdown-item text-light-orange" href="#">Delete Chat</a>
											</div>
										</div>
									</div>
								</div>
								<div class="chat-box">
									<div class="chat-desc customscroll">
										<ul>
										<?php 
    
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
									</div>
									<div class="chat-footer">
										<div class="file-upload"><a href="#"><i class="fa fa-paperclip"></i></a></div>
										<form method="POST" id="chatForm">
                                          <div class="chat_text_area">
											<textarea id="message" placeholder="Type your message…"></textarea>
										 </div>
										 <div class="chat_send">
											<button onclick="return chat_validation()" class="btn btn-link" type="submit"><i class="icon-copy ion-paper-airplane"></i></button>
										 </div>
                                        </form>
                                        <div id="msg"></div>  
                                        <script type="text/javascript">
                                          function chat_validation(){
                                            const textmsg = $('#message').val();
                                            const receive = $('#receive').val(); 
                                            const send  = $('#send').val(); 

                                            if(textmsg == "") {
                                               alert('Type Message....');
                                               return false;
                                            }
                                            const datastr = 'message='+textmsg+'&receive='+receive+'&send='+send;
                                            $.ajax({
                                            url:'../chatlog.php',
                                            type:'POST',
                                            data:datastr,
                                            success:function(e){
                                            $('#msg').html(e);
                                             }
                                            });
                                            document.getElementById('chatForm').reset();
                                            return false;
                                          }
                                        </script>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="footer-wrap pd-20 mb-20 card-box">
				DeskApp - Bootstrap 4 Admin Template By <a href="https://github.com/dropways" target="_blank">Ankit Hingarajiya</a>
			</div>
		</div>
	</div>
	<!-- js -->
	<script src="../vendors/scripts/core.js"></script>
    <script src="../vendors/scripts/script.min.js"></script>
	<script src="../vendors/scripts/process.js"></script>
    <script src="../vendors/scripts/layout-settings.js"></script>

	<script language="javascript">
	setInterval(function(){
	window.location.reload();
	}, 30000);
	</script>

</body>
</html>
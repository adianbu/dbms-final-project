<?php

include("connect.php");

$con = OpenCon();

session_start();

$amount = $_POST['amount'];
$cardno = $_SESSION['Card_Number'];
$cardstatus=$_SESSION['Card_Status'];



if(isset($_POST['submit'])) {
	if(strtoupper($cardstatus)=="ISSUED"){
		$balance = mysqli_query($con, "CALL recharge('$amount','$cardno');") or die(mysql_error());
		$row = $balance->fetch_array();
		$_SESSION['Balance'] = $row['Balance'];

		$_SESSION['successfull']="Successfully Recharged your Card";
	}
	else{
		$_SESSION['unsuccessfull']="Card status is pending";
	}
	
	// echo "<script type='text/javascript'>alert('$cardstatus');</script>";
}


header("Location: ../smart_card_homepage.php");

$balance->free();

CloseCon($con);
?>
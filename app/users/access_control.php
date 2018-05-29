<?php
$user = $_SESSION['login_user'];

$sql = "SELECT userPROFILE FROM security WHERE username = '$user'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
if ($row['userPROFILE'] <> 'admin') {
	//echo 'alert("Your Profile Does Not Have Enough Rights to Access This Module")';
	//header("location: ../index.php");
	echo "<script>
			alert('Your profile: ".$row['userPROFILE'].", does not have enough rights to access this module. If you believe this is an error please contact your Administrator: timp@networkstours.com. You will be redirected to the front page after you click OK');
			window.location.href='../index.php';
		  </script>";
}	
?>
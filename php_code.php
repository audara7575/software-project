<!doctype html>
<html>
<head>





<meta charset="utf-8">
<title>Courier management</title>
<!-- Login -->

<?php
	session_start();
ini_set('display_errors','1');
$db = mysqli_connect('localhost', 'root', '', 'i5soulutions');
if(isset($_POST['btnLog'])){


$un = $_POST['txtun'];
$pw = $_POST['txtpw'];
$rid=$_POST['txtroll'];
$int=0;

//validate loging details
$sql = "SELECT * FROM users WHERE un='$un' AND pw='$pw' AND role ='$rid'";

$que = mysqli_query($db,$sql) or die("invalid query");
if(!mysqli_affected_rows($db)==1){
echo '<div class="alert alert-danger">
<strong>Login Fail!</strong> Please Check Your Login Details.
</div>';

}
else{
	$_SESSION['un'] = $un;
$_SESSION['rid'] = $rid;


if($_SESSION['rid'] =="Admin"){
$payement="index.php";
header("location:index.php");
}
else if($_SESSION['rid'] =="Manager"){
$payement="Payement.php";
header("location:trck_warehouse.php");
}

else if($_SESSION['rid'] =="teacher"){
//here please place the entire page code
header("location:exam.php");
}
else{
echo "you have no access this page";
}


}
}

?>





<!-- Selcetion list -->
<?php


	$db = mysqli_connect('localhost', 'root', '', 'i5soulutions');
    $result0 = mysqli_query($db, "SELECT roll_name  FROM rolls");
    $option0 = '';
	while($row = mysqli_fetch_assoc($result0))
{
  $option0 .= '<option value = "'.$row['roll_name'].'">'.$row['roll_name'].'</option>';
}



?>


<!-- Users Details -->
<?php

	$db = mysqli_connect('localhost', 'root', '', 'i5soulutions');

	// initialize variables


	$up = false;

	if (isset($_POST['save5'])) {
		
	
		$cid = $_POST['uid'];
		$cname = $_POST['psw'];
		$add= $_POST['add'];
		$Cfee= $_POST['tel'];
		$nic= $_POST['nic'];
		$email= $_POST['email'];
		$Cduration = $_POST['rid'];
		$confirm_password=$_POST['cpsw'];
		
		if($cname!=$confirm_password){
			$_SESSION['message'] = " Password Not matched";
				header('location: Users.php');
		}
else{

//insert
$rs = mysqli_query($db, "SELECT un FROM users WHERE un='$cid' ");
$rs2 = mysqli_query($db, "SELECT nic FROM users WHERE nic='$nic' ");

if (!mysqli_num_rows($rs)==0) {
		$_SESSION['message'] = " Username Already  Exists";
		header('location: Users.php');
}

elseif (!mysqli_num_rows($rs2)==0) {
	$_SESSION['message'] = " NIC Already  Exists";
	header('location: Users.php');
}

else{		mysqli_query($db, "INSERT INTO `users` (`id`, `un`, `pw`, `address`, `tel`, `nic`, `email`, `role`) VALUES (NULL, '$cid', '$cname', '$add', '$Cfee', '$nic', '$email', '$Cduration');");
		$_SESSION['message'] = "Record Inserted";
		header('location: Users.php');
	}}}
//update




 if (isset($_GET['edit5'])) {
		$cid = $_GET['edit5'];
		$update= true;


        $result = mysqli_query($db, "SELECT * FROM users WHERE username='$cid' ");



     while($row = mysqli_fetch_array($result))
   {
        $bid = $row['username'];
		    $name = $row['password'];
		    $c = $row['Address'];
	    	$bco = $row['Telephone_no'];
    	  $nic = $row['NIC'];
      	$mail = $row['email'];
        $rol = $row['roll'];
     }
	  }






	if (isset($_POST['update5'])) {
    $bid = $_POST['uid'];
    $name = $_POST['psw'];
    $c= $_POST['add'];
    $bco= $_POST['tel'];
    $nic= $_POST['nic'];
    $mail= $_POST['email'];
    $rol = $_POST['rid'];
$rs2 = mysqli_query($db, "SELECT NIC FROM users WHERE NIC='$nic' ");
if (!mysqli_num_rows($rs2)==0) {
	$_SESSION['message'] = " NIC Already  Exists";
	header('location: Users.php');
}

else{
	mysqli_query($db, "UPDATE `users` SET `password`=''$name',`Address`='$c',`Telephone_no`='$bco',`NIC`='$nic',`email`=$mail,`roll`='$rol' WHERE `users`.`username` = '$bid';");
	$_SESSION['message'] = "Record Updated!";

	header('location: Users.php');
}}




//delete
if (isset($_GET['del5'])) {
	$idc = $_GET['del5'];
	mysqli_query($db,"DELETE FROM `users` WHERE un='$idc' ");
	$_SESSION['message'] = "Record deleted!";
	header('location:Users.php');
}


?>
<!-- roll Details -->

<?php

	$db = mysqli_connect('localhost', 'root', '', 'i5soulutions');

	// initialize variables


	$up = false;

	if (isset($_POST['saveroll'])) {
		$cid = $_POST['Cidroll'];
		$cname = $_POST['Cnameroll'];
$abc="teacher";

//insert
  $rs = mysqli_query($db, "SELECT roll_name FROM rolls WHERE roll_name='$cid' ");

if (!mysqli_num_rows($rs)==0) {
      $_SESSION['message'] = "Roll name Already  Exists";
			header('location: rolls.php');
}


else {
//check BatchID feild empty
if (empty($_POST["Cidroll"])) {
    $_SESSION['message'] = "Please insert  Roll Name";
    header('location: rolls.php');
  }
  //check Batch name feild empty
  elseif  (empty($_POST["Cnameroll"])) {
      $_SESSION['message'] = "Please insert Date";
      header('location: rolls.php');
    }
		else{
		mysqli_query($db, "INSERT INTO rolls (roll_name,Date ) VALUES ('$cid','$cname')");
		$_SESSION['message'] = "Record Inserted";
		header('location: rolls.php');
	}}}
//update



 if (isset($_GET['editroll'])) {
		$cid = $_GET['editroll'];
		$update= true;


        $result = mysqli_query($db, "SELECT * FROM rolls WHERE roll_name='$cid' ");



     while($row = mysqli_fetch_array($result))
   {
        $bid = $row['roll_name'];
		$name = $row['Date'];

     }
	  }






	if (isset($_POST['updateroll'])) {
	    $bid = $_POST['Cidroll'];
		$city = $_POST['Cnameroll'];



	mysqli_query($db, "UPDATE `rolls` SET `roll_name` = '$bid', `Date` = '$city' WHERE `rolls`.`roll_name` = '$bid';");
	$_SESSION['message'] = "Record Updated!";

	header('location: rolls.php');
}







//delete
if (isset($_GET['delroll'])) {
	$cid = $_GET['delroll'];
	mysqli_query($db, "DELETE FROM rolls WHERE roll_name='$cid'");
	$_SESSION['message'] = "Record deleted!";
	header('location: rolls.php');
}


?>
</head>

<body>

</body>
</html>

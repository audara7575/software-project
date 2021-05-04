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




<!-- Branch Deatils -->
<?php
$temp="";
	$db = mysqli_connect('localhost', 'root', '', 'i5soulutions');
// initialize variables


	$id = 0;
	$update = false;
	$up=false;

	if (isset($_POST['savebranch'])) {
		$bid = $_POST['Bid'];
		$city = $_POST['Bcity'];
		$address = $_POST['BAddress'];
		$bco = $_POST['Bcontc'];
//insert

//validation

//check Brnch id alredy exist

$check="SELECT `Brnach_ID` FROM `branch` WHERE `Brnach_ID` =$bid";
$rs = mysqli_query($db,$check);

if (!mysqli_num_rows($rs)==0) {
      $_SESSION['message'] = "Branch ID Already  Exists";
			header('location: Class.php');
}

else {
//check bid feild empty
if (empty($_POST["Bid"])) {
    $_SESSION['message'] = "Please insert  Branch_ID";
    header('location: Class.php');
  }
  //check city feild empty
  elseif  (empty($_POST["Bcity"])) {
      $_SESSION['message'] = "Please insert City";
      header('location: Class.php');
    }
    //check address feild empty
    elseif (empty($_POST["BAddress"])) {
        $_SESSION['message'] = "Please insert Address";
        header('location: Class.php');
      }
      //check  contact number feild empty
  elseif (empty($_POST["Bcontc"])) {
          $_SESSION['message'] = "Please insert Contact_no";
          header('location: Class.php');
        }
        //add data to branch tab
  else{
		mysqli_query($db, "INSERT INTO branch (Brnach_ID,City,Address,Contact_no) VALUES ('$bid','$city', '$address','$bco')");
		$_SESSION['message'] = "Record Inserted";
		header('location: Class.php');

  }	} }
//update
if (isset($_GET['edit'])) {
   $cid = $_GET['edit'];
   $update= true;


       $result = mysqli_query($db, "SELECT * FROM branch WHERE Brnach_ID='$cid' ");



    while($row = mysqli_fetch_array($result))
  {
       $temp = $row['Brnach_ID'];
       $city = $row['City'];
       $c = $row['Address'];
       $bco = $row['Contact_no'];
}}



 if (isset($_POST['updatebranch'])) {

   $bid = $_POST['Bid'];
     $city = $_POST['Bcity'];
     $c = $_POST['BAddress'];
    $bco = $_POST['Bcontc'];


	  //check city feild empty
	  if  (empty($_POST["Bcity"])) {
	      $_SESSION['message'] = "Please insert City";
	      header('location: Class.php');
	    }
	    //check address feild empty
	    elseif (empty($_POST["BAddress"])) {
	        $_SESSION['message'] = "Please insert Address";
	        header('location: Class.php');
	      }
	      //check  contact number feild empty
	  elseif (empty($_POST["Bcontc"])) {
	          $_SESSION['message'] = "Please insert Contact_no";
	          header('location: Class.php');
	        }
	        //add data to branch tab
	  else{

 mysqli_query($db, "UPDATE `branch` SET `City` = '$city', `Address` = '$c', `Contact_no` = '$bco' WHERE `branch`.`Brnach_ID` = '$bid';");
 $_SESSION['message'] = "Record Updated!";

 header('location: Class.php');}
}





//delete
if (isset($_GET['del'])) {
	$bid = $_GET['del'];
	mysqli_query($db, "DELETE FROM branch WHERE Brnach_ID='$bid'");
	$_SESSION['message'] = "Record deleted!";
	header('location: Class.php');
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



/*

	$db = mysqli_connect('localhost', 'root', '', 'i5soulutions');
    $result = mysqli_query($db, "SELECT CourseID FROM course");
    $option = '';
	while($row = mysqli_fetch_assoc($result))
{
  $option .= '<option value = "'.$row['CourseID'].'">'.$row['CourseID'].'</option>';
}


$result2 = mysqli_query($db, "SELECT Brnach_ID FROM branch ");
    $option2 = '';
	while($row = mysqli_fetch_assoc($result2))
{
  $option2 .= '<option value = "'.$row['Brnach_ID'].'">'.$row['Brnach_ID'].'</option>';
}

$result3 = mysqli_query($db, "SELECT Class_ID FROM course_branch");
    $option3 = '';
	while($row = mysqli_fetch_assoc($result3))
{
  $option3.= '<option value = "'.$row['Class_ID'].'">'.$row['Class_ID'].'</option>';
}

$result4 = mysqli_query($db, "SELECT roll_name FROM rolls");
    $option4 = '';
	while($row = mysqli_fetch_assoc($result4))
{
  $option4.= '<option value = "'.$row['roll_name'].'">'.$row['roll_name'].'</option>';
}

*/
?>



<!-- Course Details -->
<?php

	$db = mysqli_connect('localhost', 'root', '', 'i5soulutions');

	// initialize variables


	$up = false;

	if (isset($_POST['save2'])) {
		$cid = $_POST['Cid'];
		$cname = $_POST['Cname'];
		$Cduration = $_POST['Cduration'];
		$Cfee = $_POST['Cfee'];

//insert
//check course id alredy exist

$check="SELECT `CourseID` FROM `course` WHERE `CourseID` =$cid";
$rs = mysqli_query($db,$check);

if (!mysqli_num_rows($rs)==0) {
      $_SESSION['message'] = "CourseID Already  Exists";
			header('location: Course.php');
}

else {
//check CID feild empty
if (empty($_POST["Cid"])) {
    $_SESSION['message'] = "Please insert  CourseID";
    header('location: Course.php');
  }
  //check name feild empty
  elseif  (empty($_POST["Cname"])) {
      $_SESSION['message'] = "Please insert Name";
      header('location: Course.php');
    }
    //check duration feild empty
    elseif (empty($_POST["Cduration"])) {
        $_SESSION['message'] = "Please insert Duration";
        header('location: Course.php');
      }
      //check  course fee feild empty
  elseif (empty($_POST["Cfee"])) {
          $_SESSION['message'] = "Please insert course fee";
          header('location: Course.php');
        }
        //add data to Course tab
  else{
		mysqli_query($db, "INSERT INTO course (CourseID,name ,duration,Course_fee ) VALUES ('$cid','$cname', '$Cduration','$Cfee')");
		$_SESSION['message'] = "Record Inserted";
		header('location: Course.php');
	}}}
//update



 if (isset($_GET['edit1'])) {
		$cid = $_GET['edit1'];
		$update= true;


        $result = mysqli_query($db, "SELECT * FROM course WHERE CourseID='$cid' ");



     while($row = mysqli_fetch_array($result))
   {
        $biid = $row['CourseID'];
		$name = $row['name'];
		$c = $row['duration'];
		$bco = $row['Course_fee'];
     }
	  }


	if (isset($_POST['update2'])) {
	    $bid = $_POST['Cid'];
		$name = $_POST['Cname'];
		$c = $_POST['Cduration'];
		$bco = $_POST['Cfee'];

		//check name feild empty
	  if  (empty($_POST["Cname"])) {
	      $_SESSION['message'] = "Please insert Name";
	      header('location: Course.php');
	    }
	    //check duration feild empty
	    elseif (empty($_POST["Cduration"])) {
	        $_SESSION['message'] = "Please insert Duration";
	        header('location: Course.php');
	      }
	      //check  course fee feild empty
	  elseif (empty($_POST["Cfee"])) {
	          $_SESSION['message'] = "Please insert course fee";
	          header('location: Course.php');
	        }
	        //add data to Course tab
	  else{
	mysqli_query($db, "UPDATE `course` SET `CourseID` = '$bid', `name` = '$name', `duration` = '$c', `Course_fee` = '$bco' WHERE `course`.`CourseID` = '$biid';");
	$_SESSION['message'] = "Record Updated!";

	header('location: Course.php');
}

}





//delete
if (isset($_GET['del1'])) {
	$cid = $_GET['del1'];
	mysqli_query($db, "DELETE FROM course WHERE CourseID='$cid'");
	$_SESSION['message'] = "Record deleted!";
	header('location: Course.php');
}


?>


<!-- Assaning class Details -->
<?php
$db = mysqli_connect('localhost', 'root', '', 'i5soulutions');

	// initialize variables


	$up = false;

	if (isset($_POST['save3'])) {
		$priceID= $_POST['priceID'];
		$weight = $_POST['Weight'];
		$browser= $_POST['browser'];
		$sd = $_POST['sd'];
		$price = $_POST['price'];

//insert
$check="SELECT `price_code ` FROM `course_branch` WHERE `price_code ` =$priceID";
$rs = mysqli_query($db,$check);

if (!mysqli_num_rows($rs)==0) {
      $_SESSION['message'] = "price ID Already  Exists";
			header('location: Aclass.php');
}


  else{

		mysqli_query($db, "INSERT INTO `price`(`price_code`, `weight_category`, `distance_category`, `date`, `price`) VALUES ('$priceID','$weight','$browser','$sd','$price')");
		$_SESSION['message'] = "Record Inserted";
		header('location: Aclass.php');


	}}

//update
if (isset($_GET['edit2'])) {
	 $clid = $_GET['edit2'];
	 $update= true;


			 $result = mysqli_query($db, "SELECT * FROM course_branch WHERE Class_ID='$clid' ");



		while($row = mysqli_fetch_array($result))
	{
	 $biid = $row['Class_ID'];
	 $name = $row['Branch_ID'];
	 $c = $row['Course_ID'];
	 $bco = $row['start_day'];
		}
	 }


 if (isset($_POST['updateclass'])) {
	 $bid = $_POST['clid'];
	 $name = $_POST['ciid'];
	 $c = $_POST['bid'];
	 $bco = $_POST['sd'];

	 //check CID feild empty
	 if  (empty($_POST["ciid"])) {
			 $_SESSION['message'] = "Please insert CourseID";
			 header('location: Aclass.php');
		 }
		 //check BID feild empty
		 elseif (empty($_POST["bid"])) {
				 $_SESSION['message'] = "Please insert Branch_ID";
				 header('location: Aclass.php');
			 }
			 //check  Date feild empty
	 elseif (empty($_POST["sd"])) {
					 $_SESSION['message'] = "Please insert Date";
					 header('location: Aclass.php');
				 }
				 //add data to Course tab
	 else{
 mysqli_query($db, "UPDATE `course_branch` SET`Branch_ID`='$c',`Course_ID`='$name',`start_day`='$bco' WHERE `Class_ID`='$bid';");
 $_SESSION['message'] = "Record Updated!";

 header('location: Aclass.php');
}}


//delete
if (isset($_GET['del2'])) {
	$val = $_GET['del2'];
	mysqli_query($db, "DELETE FROM `course_branch` WHERE Class_ID='$val';");
	$_SESSION['message'] = "Record deleted!";
	header('location: Aclass.php');
}


?>

<!-- Batch Details -->
<?php
$db = mysqli_connect('localhost', 'root', '', 'i5soulutions');

	// initialize variables


	$up = false;

	if (isset($_POST['savebatch'])) {
		$baid = $_POST['id'];
		$bname = $_POST['Bname'];
		$bduration = $_POST['Byear'];
		$bfee = $_POST['cid'];

//insert
$check="SELECT `Batch_id` FROM `course_branch` WHERE `Batch_id` =$baid";
$rs = mysqli_query($db,$check);

if (!mysqli_num_rows($rs)==0) {
      $_SESSION['message'] = "Batch ID Already  Exists";
			header('location: Batch.php');
}

else {
//check BatchID feild empty
if (empty($_POST["id"])) {
    $_SESSION['message'] = "Please insert  Batch ID";
    header('location: Batch.php');
  }
  //check Batch name feild empty
  elseif  (empty($_POST["Bname"])) {
      $_SESSION['message'] = "Please insert Batch name";
      header('location: Batch.php');
    }
    //check Year feild empty
    elseif (empty($_POST["Byear"])) {
        $_SESSION['message'] = "Please insert Year";
        header('location: Batch.php');
      }
      //check  Date feild empty
  elseif (empty($_POST["cid"])) {
          $_SESSION['message'] = "Please insert Class ID";
          header('location: Batch.php');
        }
        //add data to Course tab
  else{

		mysqli_query($db,"INSERT INTO `batch` (`Batch_id`, `Name`, `Year`, `Class_id`) VALUES ('$baid', '$bname', '$bduration', '$bfee');");
		$_SESSION['message'] = "Record Inserted";
		header('location:Batch.php');


	}}}

	//update
	if (isset($_GET['edit3'])) {
		 $clid = $_GET['edit3'];
		 $update= true;


				 $result = mysqli_query($db, "SELECT * FROM `batch` WHERE `Batch_id`='$clid' ");



			while($row = mysqli_fetch_array($result))
		{
		 $biid = $row['Batch_id'];
		 $baname = $row['Name'];
		 $byear = $row['Year'];
		 $clid = $row['Class_id'];
			}
		 }


	 if (isset($_POST['updatebatch'])) {
		 $baid = $_POST['id'];
		 $bname = $_POST['Bname'];
		 $bduration = $_POST['Byear'];
		 $bfee = $_POST['cid'];

		 if  (empty($_POST["Bname"])) {
	       $_SESSION['message'] = "Please insert Batch name";
	       header('location: Batch.php');
	     }
	     //check Year feild empty
	     elseif (empty($_POST["Byear"])) {
	         $_SESSION['message'] = "Please insert Year";
	         header('location: Batch.php');
	       }
	       //check  Date feild empty
	   elseif (empty($_POST["cid"])) {
	           $_SESSION['message'] = "Please insert Class ID";
	           header('location: Batch.php');
	         }
	         //add data to Branch tab
	   else{
	 mysqli_query($db, "UPDATE `batch` SET `Name`='$bname',`Year`='$bduration',`Class_id`='$bfee' WHERE `Batch_id`='$baid';");
	 $_SESSION['message'] = "Record Updated!";

	 header('location: Batch.php');
	}}




//delete
if (isset($_GET['del3'])) {
	$val2 = $_GET['del3'];
	mysqli_query($db, "DELETE FROM `batch` WHERE `Batch_id`='$val2'");
	$_SESSION['message'] = "Record deleted!";
	header('location:Batch.php');
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

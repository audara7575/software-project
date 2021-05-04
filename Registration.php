<!DOCTYPE html>
<html lang="en">
<?php  include('reg.php');

$user;

$user=$_SESSION['rid'] ;

if($user=="Admin" || $user=="Manager"){
}
else {
  echo "
  <script language='javascript'>
  alert('Sorry, but you must login to view the members area!')
  </script>
  <script>
window.location='javascript: history.go(-1)'
  </script>
  "; }

  $db = mysqli_connect('localhost', 'root', '', 'Student');
    $result = mysqli_query($db, "SELECT Batch_id  FROM `batch`");
    $optionbatch = '';
	while($row = mysqli_fetch_assoc($result))
{
  $optionbatch .= '<option value = "'.$row['Batch_id'].'">'.$row['Batch_id'].'</option>';
}

  ?>

<head>

<meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>SITI Institute</title>
  <!-- Bootstrap core CSS-->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Page level plugin CSS-->
  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  <!-- Navigation-->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="index.php">SITI Institute</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Registration Form">
          <a class="nav-link" href="index.php">
            <i class="fa fa-fw fa-dashboard"></i>
                 <span class="nav-link-text">Registration Form</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Components">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-wrench"></i>
            <span class="nav-link-text">Exam Deatils</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseComponents">
            <li>
              <a href="Exam.php">Exam Mangement</a>
            </li>
             <li>
              <a href="Result.php">Result Uploding</a>
            </li>

          </ul>
        </li>


         <li class="nav-item" data-toggle="tooltip"  data-placement="right" title="Components">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#Student" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-wrench"></i>
            <span class="nav-link-text">Students Deatils</span>
          </a>
          <ul class="sidenav-second-level collapse" id="Student">
            <li>
              <a href="Registration.php">Student Data view</a>
            </li>
             <li>
              <a href="Payement.php">Payement</a>
            </li>
            <li>
              <a href="Attendents.php">Attendents</a>
            </li>
          </ul>
        </li>


        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Components">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#Class" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-wrench"></i>
            <span class="nav-link-text">Class Detailst</span>
          </a>
          <ul class="sidenav-second-level collapse" id="Class">
            <li>
              <a href="Class.php">Branch Mangement</a>
            </li>
             <li>
              <a href="Course.php">Course Mangement</a>
            </li>
            <li>
              <a href="Aclass.php">Class Assaining</a>
            </li>
            <li>
              <a href="Batch.php">Batch Assaining</a>
            </li>
          </ul>
        </li>



        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Components">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#Accounts_Mangemnt" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-wrench"></i>
            <span class="nav-link-text">Accounts Mangemnt</span>
          </a>
          <ul class="sidenav-second-level collapse" id="Accounts_Mangemnt">
            <li>
              <a href="Users.php">Users</a>
            </li>
            <li>
              <a href="Rolls.php">Rolls Mangement</a>
            </li>
            <li>
              <a href="student.php">User view</a>
            </li>
          </ul>
        </li>
         </ul>
      </ul>

      <ul class="navbar-nav ml-auto">


        <li class="nav-item">
          <form class="form-inline my-2 my-lg-0 mr-lg-2">

          </form>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="modal" data-target="#exampleModal">
            <i class="fa fa-fw fa-sign-out"></i>Logout</a>
        </li>
      </ul>
    </div>
  </nav>
  <div class="content-wrapper">
    <div class="container-fluid">

      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Home</a>
        </li>
        <li class="breadcrumb-item active"> Register Form </li>
      </ol>
      <!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Student Details</div>


          <!-- Databse Connection-->
          <?php if (isset($_SESSION['message'])): ?>
	       <div  class="alert alert-info">
		   <?php
			echo "<strong>". $_SESSION['message']. "</strong>";
			unset($_SESSION['message']);
		    ?>
	       </div>
          <?php endif ?>
          <?php

           $con=mysqli_connect("localhost","root","","student");
           // Check connection
          if (mysqli_connect_errno())
          {
          echo "Failed to connect to MySQL: " . mysqli_connect_error();
          }

          if (isset($_POST['serch'])) {
            $bid = $_POST['serchtxt'];
          $result = mysqli_query($con,"SELECT * FROM `student` WHERE `Index_no`='$bid'");
          $resultbatch = mysqli_query($con,"SELECT * FROM `register`WHERE `Index_no`='$bid'");

} ?>
<form method="post" action="Registration.php" >
<strong> Enter INDEXNO For Serch Student</strong>
<input placeholder="IndexNO..." name="serchtxt"   class="nav-item">
<input type="submit" class="btn btn-info" value="serch" name="serch"/>
<br> <br>



</form>
          <form   method="post" action="reg.php"  id="regForm">


   <!-- One "tab" for each step in the form: -->
   <div  class="border-info" class="active">

  <fieldset  class="card-header">


<br/>


  <label> INDEX_NO</label>
    <input placeholder="IndexNO..." name="index"  id="index"  class="form-control" onfocus="<?php if ($update == true){ echo "myFunction()"; } else echo ""; ?>" value="<?php if ($update == true){ echo $index;} else echo ""; ?>">


  <label>First Name: </label>
     <input class="form-control" placeholder="First name..." name="fname" value="<?php if ($update == true){ echo $fname;} else echo ""; ?>">
    <label> Last name:</label>
     <input class="form-control" placeholder="Last name..." name="lname" value="<?php if ($update == true){ echo $lname;} else echo ""; ?>">
  <label> School: </label>
     <input class="form-control" placeholder="School..." name="scl" value="<?php if ($update == true){ echo $scl;} else echo ""; ?>">
       <label> Address:</label>
     <input class="form-control" placeholder="Address..." name="add" value="<?php if ($update == true){ echo $address;} else echo ""; ?>">

   <label> Sex </label>
    <input class="form-control" placeholder="sex" name="add" value="<?php if ($update == true){ echo $sex;} else echo ""; ?>">

     <label>   NIC </label>
     <input class="form-control" placeholder="NIC"  name="nic" value="<?php if ($update == true){ echo $nic;} else echo ""; ?>">

    <label>  Cureent study Level </label>
    <input class="form-control" placeholder="Cureent study Level"  name="csl" value="<?php if ($update == true){ echo $sl;} else echo ""; ?>">

   <label>DOB: </label>
     <input class="form-control" placeholder="DOB..."  name="dob" type="date" value="<?php if ($update == true){ echo $dob;} else echo ""; ?>">
       Contact Number
     <input class="form-control" placeholder="Contact Number" name="cnt" value="<?php if ($update == true){ echo $contact;} else echo ""; ?>">

  <label>Email:</label>
     <input class="form-control" placeholder="Email..." name="email" value="<?php if ($update == true){ echo $email;} else echo ""; ?>">
         <label>   Gurdian's Name </label>
        <input class="form-control" placeholder="Gurdian's Name..." name="gname" value="<?php if ($update == true){ echo $gname;} else echo ""; ?>">
        <label>   Gurdian's Contact_no </label>
       <input class="form-control" placeholder="Gurdian's contact Number" name="rdate" value="<?php if ($update == true){ echo $gcnt;} else echo ""; ?>">
        <br/>

  <button   class="btn btn-success" type="submit" name="save" >Submit</button>


		 </form>
     <script>
     function myFunction() {

         document.getElementById("index").disabled = true;
     }
     </script>
        <div class="card-body">
          <div class="table-responsive">


            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Index</th>
                  <th>First Name </th>
                  <th>Last Name</th>
                  <th>School</th>
                  <th>Address</th>
                  <th>NIC</th>
                  <th>Sex</th>
                  <th>Study level</th>
                  <th>DOB</th>
                  <th>Contact No</th>
                  <th>Email</th>

                  <th>Guredian Name</th>
                  <th>G.Contact_no</th>

                  <th>Action</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Index</th>
                  <th>First Name </th>
                  <th>Last Name</th>
                  <th>School</th>
                  <th>Address</th>
                  <th>NIC</th>
                  <th>Sex</th>
                  <th>Study level</th>
                  <th>DOB</th>
                  <th>Contact No</th>
                  <th>Email</th>

                  <th>Guredian Name</th>
                  <th>G.Contact_no</th>
                  <th>Action</th>
                </tr>
              </tfoot>


              <?php while($row = mysqli_fetch_array($result))
               {
              echo "<tr>";
              echo "<td>" . $row['Index_no'] . "</td>";
              echo "<td>" . $row['first_name'] . "</td>";
              echo "<td>" . $row['last_name'] . "</td>";
              echo "<td>" . $row['school'] . "</td>";
              echo "<td>" . $row['address'] . "</td>";
              echo "<td>" . $row['nic'] . "</td>";
              echo "<td>" . $row['sex'] . "</td>";
              echo "<td>" . $row['study_level'] . "</td>";
              echo "<td>" . $row['DOB'] . "</td>";
              echo "<td>" . $row['contact'] . "</td>";
              echo "<td>" . $row['email'] . "</td>";
              echo "<td>" . $row['Gurdian_name'] . "</td>";
              echo "<td>" . $row['G.Contact_Number'] . "</td>";

              ?>
<td> <a href="Registration.php?edit1=<?php echo $row['Index_no']; ?>"  class="btn btn-info" onclick="changeText()" >Edit</a>
<a href="reg.php?del1=<?php echo $row['Index_no']; ?>" class="btn btn-danger">Delete</a>  </td>
          <?php echo "</tr>";
            }




         ?>
 </tbody></table>




 <label>Registerd Date</label>
 <input type="date" class="form-control"  name="rdate"/>

 <label>Batch Id</label>
 <select class="form-control" name="bid">

 <?php echo $optionbatch; ?>

 </select>


 <br/>
 <button   class="btn btn-success" type="submit" name="save1" >Submit</button>





     <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
       <thead>
         <tr>
           <th>Batch ID</th>
           <th>Date</th>

           <th>Action</th>
         </tr>
       </thead>
       <tfoot>
         <tr>
           <th>Batch ID</th>
           <th>Date</th>

           <th>Action</th>
         </tr>
       </tfoot>


       <?php while($row = mysqli_fetch_array($resultbatch))
        {
       echo "<tr>";
       echo "<td>" . $row['batch_id'] . "</td>";
       echo "<td>" . $row['Date'] . "</td>";

       ?>
<td> <a href="Course.php?edit1=<?php echo $row['batch_id']; ?>"  class="btn btn-info" onclick="changeText()" >Edit</a>
<a href="php_code.php?del1=<?php echo $row['batch_id']; ?>" class="btn btn-danger">Delete</a>  </td>
   <?php echo "</tr>";
     }



  mysqli_close($con);
  ?>
</tbody></table></form>




          </div>
        </div>

      </div>
    </div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
    <footer class="sticky-footer">
      <div class="container">
        <div class="text-center">
          <small>Copyright © Stiti Institute 2018</small>
        </div>
      </div>
    </footer>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fa fa-angle-up"></i>
    </a>
    <!-- Logout Modal-->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-primary" href="login.php">Logout</a>
          </div>
        </div>
      </div>
    </div>
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Page level plugin JavaScript-->
    <script src="vendor/datatables/jquery.dataTables.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin.min.js"></script>
    <!-- Custom scripts for this page-->
    <script src="js/sb-admin-datatables.min.js"></script>
  </div>
</body>

</html>

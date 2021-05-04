<!DOCTYPE html>
<html lang="en">
<?php  include('reg.php');
/*
$user;

$user=$_SESSION['rid'] ;

if($user=="Admin" || $user=="Teacher" ){
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
 */
 
 $con = mysqli_connect('localhost', 'root', '', 'i5soulutions');
 $result='';
 if (isset($_POST['search'])) {
	 $id= $_POST['id'];
	 
	  $result = mysqli_query($con,"SELECT * FROM `track` WHERE `order_id`='$id' AND `active` ='1'");
	 }
	 
	 
	
 
 
 
 
 
 
 
 
 
 
 
 
 
 ?>

<head>

<meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Courier management</title>
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
    <a class="navbar-brand"  href="index.php">Courier management</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Registration Form">
          <a class="nav-link" href="index.php">
            <i class="fa fa-fw fa-dashboard"></i>
                 <span class="nav-link-text" href="index.php">Place Order</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Components">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-wrench"></i>
            <span class="nav-link-text">Tracking</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseComponents">
            <li>
              <a href="track_warehouse.php">Whrehouse</a>
            </li>
			<li>
              <a href="track_delivery.php">Delivery service</a>
            </li>
             <li>
              <a href="customer.php">Customer</a>
            </li>

          </ul>
        </li>


         <li class="nav-item" data-toggle="tooltip"  data-placement="right" title="Components">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#i5soulutions" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-wrench"></i>
            <span class="nav-link-text">Admin duties</span>
          </a>
          <ul class="sidenav-second-level collapse" id="i5soulutions">
            <li>
              <a href="Aclass.php">Price Management</a>
            </li>
             <li>
              <a href="Users.php">User Management</a>
            </li>
            <li>
              <a href="roll.php">Role Management</a>
            </li>
          </ul>
        </li>


        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Components">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#Class" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-wrench"></i>
            <span class="nav-link-text" href="reports.php">Reports</span>
          </a>
          
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
                <i> Welcome <?php //cho $_SESSION['un']; ?> </i>
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
        <li class="breadcrumb-item active"> Trcking Deatils </li>
      </ol>
      <!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Tracking Details</div>


          <!-- Databse Connection-->
          <?php if (isset($_SESSION['message'])): ?>
	       <div  class="alert alert-info">
		   <?php
			echo "<strong>". $_SESSION['message']. "</strong>";
			unset($_SESSION['message']);
		    ?>
	       </div>
          <?php endif ?>
    

           

          <form method="post" action="track_warehouse.php"  autocomplete="off">

            <label>Order ID</label>
			<input type="text" name="id"      class="form-control"      />
    
</br>


	<button class="btn btn-success" type="submit" name="search" >Save</button>

		 </form>

        <div class="card-body">
          <div class="table-responsive">


            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>OrderID</th>
                  <th>Customer</th>
                  <th>Address</th>
                  <th>price</th>
				  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>OrderID</th>
                  <th>Customer</th>
                  <th>Address</th>
                  <th>price</th>
				  <th>Status</th>
                  <th>Action</th>
                </tr>
              </tfoot>


              <?php if (isset($_POST['search'])) {while($row = mysqli_fetch_array($result))
               {
              echo "<tr>";
              echo "<td>" . $row['order_id'] . "</td>";
              echo "<td>" . $row['customer'] . "</td>";
              echo "<td>" . $row['address'] . "</td>";
              echo "<td>" . $row['price'] . "</td>";
			   echo "<td>" . $row['status'] . "</td>";
			   } ?>
<td>
<a href="reg.php?confirm=<?php echo $row['order_id']; ?>" class="btn btn-danger">Confirm</a>  </td>
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
          <small>Copyright © Courier management 2021</small>
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

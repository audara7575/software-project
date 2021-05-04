<?php
ob_start();
error_reporting(0);
// connection
$con=mysqli_connect("localhost","root","","student");
// Check connection
if (mysqli_connect_errno())
{
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$months ='';
$expenses = '';
$revenues = '';
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Budget Document</title>
</head>

<body>
    <!-- jQuery cdn -->
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>

<h1>Budget Pie Charts</h1>

<?php $sql = mysqli_query($con, "SELECT * FROM 'payement' ");
while($row = mysqli_fetch_array($sql)){
	$id		= $row['Brnach_ID'];
	$expense	= $row['month'];
	$revenue	= $row['total'];
	$month	  =  date('Y-m', strtotime($row['payement']));
	$date	  =  date('M, Y', strtotime($row['payement']));
?>
<div style="height:360px; width:360px; margin-top:60px; float:left;">
<h3 align="center"><?php echo $date; ?></h3>

<div id="Chart_<?php echo $id; ?>" ></div>
</div>
<script>

new Morris.Bar({
  // ID of the element in which to draw the chart.
  element: 'Chart_<?php echo $id; ?>',
  // The name of the data record attribute that contains x-values.
  xkey: 'month',
  // A list of names of data record attributes that contain y-values.
  ykeys: ['r','e'],
  // Labels for the ykeys -- will be displayed when you hover over the chart.
  labels: ['Revenue','Expense'],

  hideHover: 'auto',
  lineColors: ['#26B99A', '#34495E'],
  // Chart data records -- each entry in this array corresponds to a point on the chart.
  data: [
    { month: '<?php echo $month; ?>', r: <?php echo $revenue; ?> , e: <?php echo $expense; ?>}
	],
  resize: true
});
</script>
<?php } ?>
</body>
</html>

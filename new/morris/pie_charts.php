<?php
ob_start();
error_reporting(0);
// connection
$db_conx = mysqli_connect("localhost", "root", "", "chart");
// Evaluate the connection
if (mysqli_connect_errno()) {
    echo mysqli_connect_error("Our database server is down at the moment. :(");
    exit();
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

<?php $sql = mysqli_query($db_conx, "SELECT * FROM chart_data ORDER BY budget_date");
while($row = mysqli_fetch_array($sql)){
	$id		= $row['id'];
	$expense	= $row['expense'];
	$revenue	= $row['revenue'];
	$month	  =  date('Y-m', strtotime($row['budget_date']));
	$date	  =  date('M, Y', strtotime($row['budget_date']));
?>
<div style="height:360px; width:360px; margin-top:60px; float:left;">
<h3 align="center"><?php echo $date; ?></h3>

<div id="Chart_<?php echo $id; ?>" ></div>
</div>
<script>

new Morris.Donut({
  // ID of the element in which to draw the chart.
  element: 'Chart_<?php echo $id; ?>',
  // Chart data records -- each entry in this array corresponds to a point on the chart.
  data: [
    { label: '<?php echo $month; ?>', value: <?php echo $revenue; ?> },
    { label: '<?php echo $month; ?>', value: <?php echo $expense; ?> }
	],
  colors: ['#26B99A', '#34495E'],
  formatter: function (y) { return '$' + y },
  resize: true
});
</script>
<?php } ?>
</body>
</html>
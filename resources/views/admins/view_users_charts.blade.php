<?php
  $current_month_users=date('M');//will display date (the month)
  $last_month_users=date('M',strtotime('-1 month'));
  $last_to_last_month_users=date('M',strtotime('-2 month'));
  $dataPoints = array(
	  array('y' => $current_month_users, "label" => "current month"),
	  array('y' => $last_month_users, "label" => "last month"),
	  array('y' => $last_to_last_month_users, "label" => "last to last month")
	);
	
	?>

<!DOCTYPE HTML>
<html>
<head>
<script>
window.onload = function () {
 
var chart = new CanvasJS.Chart("chartContainer", {
	title: {
		text: "Push-ups Over a Week"
	},
	axisY: {
		title: "Number of Push-ups"
	},
	data: [{
		type: "line",
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
 
}
</script>
</head>
<body>
<div id="chartContainer" style="height: 370px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>
</html>  



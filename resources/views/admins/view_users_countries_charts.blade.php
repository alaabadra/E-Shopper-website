@extends('layout')
@section('title')
    VIEW USERS countries CHART Page
@endsection
@section('content')
<script>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<div id="chartContainer" style="height: 300px; width: 100%;"></div>
window.onload = function() {

var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	title: {
		text: "Desktop Search Engine Market Share - 2016"
	},


	data: [{
		type: "pie",
		startAngle: 240,
		yValueFormatString: "##0.00\"%\"",
		indexLabel: "{label} {y}",
		dataPoints: [
			{y: <?php echo $getUsersCountries[0]['count']?>, label: "<?php echo $getUsersCountries[0]['country']?>"},
			{y: <?php echo $getUsersCountries[1]['count']?>, label: "<?php echo $getUsersCountries[1]['country']?>"},
			{y: <?php echo $getUsersCountries[2]['count']?>, label: "<?php echo $getUsersCountries[2]['country']?>"}
		]
	}]
});
chart.render();

}
</script>
@endsection

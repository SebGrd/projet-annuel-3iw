<h2 class="ml-1">Statistiques</h2>

<div class="main flex flex-col justify-between h-80">
	<?php if (isset($session)): ?>
		<?= $_FB::render($form); ?>
	<?php endif; ?>

	<div class="flex flex-wrap justify-center text-center h-80">
		<div class="col-24 text-center"><b>Base de données</b></div>
		<div id="chart1" class="chart col-24 flex flex-col justify-center btn btn-light h-80"></div>
	</div>
</div>

<!-- amCharts 4 -->
<script src="https://cdn.amcharts.com/lib/version/4.10.20/core.js"></script>
<script src="https://cdn.amcharts.com/lib/version/4.10.20/charts.js"></script>
<script src="https://cdn.amcharts.com/lib/version/4.10.20/themes/material.js"></script>
<script src="https://cdn.amcharts.com/lib/version/4.10.20/themes/animated.js"></script>

<script>
	// Create chart instance
	var chart = am4core.create("chart1", am4charts.PieChart);

	// Create pie series
	var series = chart.series.push(new am4charts.PieSeries());
	series.dataFields.category = "obj";
	series.dataFields.value = "count";

	// Add data
	chart.data = <?php echo $countData; ?>;
	// chart.data = [{
	// 	"obj": "Lithuania",
	// 	"count": 501.9
	// }, {
	// 	"obj": "Czech Republic",
	// 	"count": 301.9
	// }, {
	// 	"obj": "Ireland",
	// 	"count": 201.1
	// }, {
	// 	"obj": "Germany",
	// 	"count": 165.8
	// }];

	// And, for a good measure, let's add a legend
	chart.legend = new am4charts.Legend();
</script>
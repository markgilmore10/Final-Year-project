<div class="box box-success">
	
	<div class="box-header with-border">
    
    	<h3 class="box-title">Staff</h3>
  
  	</div>

  	<div class="box-body">
  		
		<div class="chart-responsive">
			
			<div class="chart" id="bar-chart1" style="height: 300px;"></div>

		</div>

  	</div>

</div>

<script>

    var bar = new Morris.Bar({
        element: 'bar-chart1',
        resize: true,
        data: [
            {y: '2016', a: 100, b: 90},
            {y: '2017', a: 50, b: 65},
            {y: '2018', a: 20, b: 40},
            {y: '2019', a: 64, b: 65},
            {y: '2020', a: 73, b: 90},
            {y: '2020', a: 73, b: 90},
            {y: '2020', a: 73, b: 90}
        ],
        barColors: ['#0af'],
        xkey: 'y',
        ykeys: ['a'],
        labels: ['sales'],
        preUnits: '€',
        hideHover: 'auto'
    });



</script>
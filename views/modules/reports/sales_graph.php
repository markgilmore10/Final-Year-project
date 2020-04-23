<?php

if(isset($_GET["initialDate"])){

    $initialDate = $_GET["initialDate"];
    $finalDate = $_GET["finalDate"];

}else{

$initialDate = null;
$finalDate = null;

}

$answer = SalesController::salesDatesRangeController($initialDate, $finalDate);

foreach ($answer as $key => $value) {

    //var_dump($value);

}


?>



<!-- sales graph -->

<div class="box box-solid bg-blue-gradient">
	
	<div class="box-header">
		
 		<i class="fa fa-th"></i>

  		<h3 class="box-title">Sales Graph</h3>
        
    </div>

    <div class="box-body border-radius-none newSalesGraph">

        <div class="chart" id="Sales-line-chart" style="height: 250px; width: 1400px;"></div>

    </div>

</div>

<script>
  var line = new Morris.Line({
    element          : 'Sales-line-chart',
    resize           : true,
    data             : [
      { y: '2011 Q1', item1: 2666 },
      { y: '2011 Q2', item1: 2778 },
      { y: '2011 Q3', item1: 4912 },
      { y: '2011 Q4', item1: 3767 },
      { y: '2012 Q1', item1: 6810 },
      { y: '2012 Q2', item1: 5670 },
      { y: '2012 Q3', item1: 4820 },
      { y: '2012 Q4', item1: 15073 },
      { y: '2013 Q1', item1: 10687 },
      { y: '2013 Q2', item1: 8432 }
    ],
    xkey             : 'y',
    ykeys            : ['item1'],
    labels           : ['Item 1'],
    lineColors       : ['#efefef'],
    lineWidth        : 2,
    hideHover        : 'auto',
    gridTextColor    : '#fff',
    gridStrokeWidth  : 0.4,
    pointSize        : 4,
    pointStrokeColors: ['#efefef'],
    gridLineColor    : '#efefef',
    gridTextFamily   : 'Open Sans',
    gridTextSize     : 10
  });
</script>
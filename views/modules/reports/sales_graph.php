<?php

if(isset($_GET["initialDate"])){

    $initialDate = $_GET["initialDate"];
    $finalDate = $_GET["finalDate"];

}else{

$initialDate = null;
$finalDate = null;

}

$answer = SalesController::salesDatesRangeController($initialDate, $finalDate);

$arrayDates = array();

foreach ($answer as $key => $value) {

    //var_dump($value);
    //var_dump($saledate);

    //captures only year and month
	$singleDate = substr($value["saledate"],0,7);

    //dates in arrayDates
	array_push($arrayDates, $singleDate);

}

var_dump($arrayDates);


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
      { y: '2011 Q1', Sales: 2666 },
      { y: '2012 Q2', Sales: 2778 },
      { y: '2013 Q3', Sales: 4912 },
      { y: '2014 Q4', Sales: 3767 }
    ],
    xkey             : 'y',
    ykeys            : ['Sales'],
    labels           : ['Sales'],
    lineColors       : ['#efefef'],
    lineWidth        : 2,
    hideHover        : 'auto',
    gridTextColor    : '#fff',
    gridStrokeWidth  : 0.4,
    pointSize        : 4,
    pointStrokeColors: ['#efefef'],
    gridLineColor    : '#efefef',
    gridTextFamily   : 'Open Sans',
    preUnits         : '€',
    gridTextSize     : 10
  });
</script>
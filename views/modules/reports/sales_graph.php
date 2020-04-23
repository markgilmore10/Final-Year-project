<?php

error_reporting(0);

if(isset($_GET["initialDate"])){

    $initialDate = $_GET["initialDate"];
    $finalDate = $_GET["finalDate"];

}else{

$initialDate = null;
$finalDate = null;

}

$answer = SalesController::salesDatesRangeController($initialDate, $finalDate);

$arrayDates = array();
$arraySales = array();
$monthlyPayments = array();

foreach ($answer as $key => $value) {

    //var_dump($value);
    //var_dump($saledate);

    //captures only year and month
	$singleDate = substr($value["saledate"],0,7);

    //dates in arrayDates
    array_push($arrayDates, $singleDate);
    
    //captures sales
    $arraySales = array($singleDate => $value["totalPrice"]);
    
    //adding sales in same months
    foreach ($arraySales as $key => $value) {
		
		$monthlyPayments[$key] += $value;
    }

}

$dontRepeatDates = array_unique($arrayDates);
//var_dump($dontRepeatDates);

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
      
    <?php

    if($dontRepeatDates != null){

        foreach($dontRepeatDates as $key){

            echo "{ y: '".$key."', Sales: ".$monthlyPayments[$key]." },";

        }

        echo "{ y: '".$key."', Sales: ".$monthlyPayments[$key]." }";

    }else{

        echo "{ y: '0', Sales: '0' }";
    }
 
     

    ?>

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
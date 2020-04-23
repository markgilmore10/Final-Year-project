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

</div>
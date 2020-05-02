<?php

$item = null;
$value = null;

$sales = SalesController::ShowSalesController($item, $value);
$users = UserController::ShowUsersController($item, $value);

$arrayStaff = array();
$arrayStaffList = array();

foreach ($sales as $key => $valueSales) {

  foreach ($users as $key => $valueUsers) {

    if($valueUsers["id"] == $valueSales["idSeller"]){

        #capture staff in an array
        array_push($arrayStaff, $valueUsers["name"]);

        #capture names and net values in the same array
        $arrayStaffList = array($valueUsers["name"] => $valueSales["netPrice"]);

        #We add the netprice of each seller

        foreach ($arrayStaffList as $key => $value) {

            $sumTotalSales[$key] += $value;

         }

    }
  
  }

}

#Avoiding repeated names
$dontrepeatnames = array_unique($arrayStaff);

?>


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
            <?php
    
                foreach($dontrepeatnames as $value){

                    echo "{y: '".$value."', a: '".$sumTotalSales[$value]."'},";

                }

            ?>
        ],
        barColors: ['#0af'],
        xkey: 'y',
        ykeys: ['a'],
        labels: ['sales'],
        preUnits: '€',
        hideHover: 'auto'
    });



</script>
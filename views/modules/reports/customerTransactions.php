<?php

$item = null;
$value = null;

$sales = SalesController::ShowSalesController($item, $value);
$customers = CustomerController::ShowCustomerController($item, $value);

$arrayCustomer = array();
$arrayCustomerList = array();

foreach ($sales as $key => $valueSales) {

  foreach ($customers as $key => $valueCustomers) {

    if($valueCustomers["id"] == $valueSales["idCustomer"]){

        #capture customer in an array
        array_push($arrayCustomer, $valueCustomers["name"]);

        #capture names and net values in the same array
        $arrayCustomerList = array($valueCustomers["name"] => $valueSales["netPrice"]);

        #We add the netprice of each customer

        foreach ($arrayCustomerList as $key => $value) {

            $sumTotalSales[$key] += $value;

         }

    }
  
  }

}

#Avoiding repeated names
$dontrepeatnames = array_unique($arrayCustomer);

?>









<div class="box box-danger">
	
	<div class="box-header with-border">
    
    	<h3 class="box-title">Customers</h3>
  
  	</div>

  	<div class="box-body">
  		
		<div class="chart-responsive">
			
			<div class="chart" id="bar-chart2" style="height: 300px;"></div>

		</div>

  	</div>

</div>

<script>

    var bar = new Morris.Bar({
        element: 'bar-chart2',
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
<?php

if($_SESSION["profile"] == "Manager" || $_SESSION["profile"] == "Staff"){

  echo '<script>

    window.location = "dashboard";

  </script>';

  return;

}

?>

<div class="content-wrapper">
  
  <section class="content-header">
    
    <h1>
      Reports
    </h1>

  </section>

  <section class="content">

    <div class="box">

    <div class="box-header with-border">

      <div class="input-group">

        <button type="button" class="btn btn-default" id="daterange-btn2">
          
          <span>
            <i class="fa fa-calendar"></i> Date range
          </span>

          <i class="fa fa-caret-down"></i>

        </button>
      </div>

      <div class="box-tools pull-right">

      <?php

      if(isset($_GET["initialDate"])){

        echo '<a href="views/modules/print_report.php?report=report&initialDate="'.$_GET["initialDate"].'&finalDate='.$_GET["finalDate"].'>';

      }else{

        echo '<a href="views/modules/print_report.php?report=report">';

      }

      ?>

          <button class="btn btn-success" style="margin-top:5px">Download to Excel</button>

        </a>
        
    </div>

    <div class="box-body">

      <div class="row">

        <div class="col-xs-12">
          
          <?php

          include "reports/sales_graph.php";

          ?>

        </div>

        <div class="col-md-6 col-xs-12">
             
            <?php

            include "reports/bestselling_products.php";

            ?>
 
        </div>

        <div class="col-md-6 col-xs-12">
             
            <?php

            include "reports/staffSales.php";

            ?>
 
        </div>

        <div class="col-md-6 col-xs-12">
             
            <?php

            include "reports/customerTransactions.php";

            ?>
 
        </div>

      </div>

    </div>

  </section>

</div>

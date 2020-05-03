<div class="content-wrapper">
  
  <section class="content-header">
    
    <h1>
      Dashboard
    </h1>

    <ol class="breadcrumb">

      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>

      <li class="active">Dashboard</li>

    </ol>

  </section>

  <section class="content">

    <div class ="row">

      <?php
    
        include "dashboard/box_views.php"

      ?>
    
    </div>

    <div class ="row">

      <div class="col-lg-12">

      <?php

        include "reports/sales_graph.php";
        
      ?>

      </div>

      <div class="col-lg-6">
        
        <?php

            include "reports/bestselling_products.php";

        ?>

      </div>

    
    </div>

</div>


    </div>

  </section>

</div>

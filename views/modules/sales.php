<?php

if($_SESSION["profile"] == "manager"){

  echo '<script>

    window.location = "dashboard";

  </script>';

  return;

}

?>
<div class="content-wrapper">

  <section class="content-header">

    <h1>

      Sales

    </h1>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">

        <a href="till">

          <button class="btn btn-primary" >
        
            Add sale
  
          </button>

        </a>

        <button type="button" class="btn btn-default pull-right" id="daterange-btn">
           
            <span>
              <i class="fa fa-calendar"></i> Date Range
            </span>

            <i class="fa fa-caret-down"></i>

        </button>

      </div>

      <div class="box-body">

        <table class="table table-bordered table-striped dt-responsive tables" width="100%">
       
          <thead>
           
           <tr>
             
             <th style="width:10px">#</th>
             <th>Receipt Number</th>
             <th>Staff</th>
             <th>Table Number</th>
             <th>Customer</th>
             <th>Net Price</th>
             <th>Discount</th>
             <th>Total Price</th>
             <th>Payment Method</th>
             <th>Date</th>
             <th>Actions</th>

           </tr> 

          </thead>

          <tbody>
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
          

                  echo '<td>'.($key+1).'</td>

                  <td>'.$value["code"].'</td>';

                  $itemUser = "id";
                  $valueUser = $value["idSeller"];

                  $userAnswer = UserController::ShowUsersController($itemUser, $valueUser);

                  echo '<td>'.$userAnswer["name"].'</td>

                  <td>'.$value["tableNo"].'</td>';

                  $itemCustomer = "idNumber";
                  $valueCustomer = $value["idCustomer"];
                  
                  $customerAnswer = CustomerController::ShowCustomerController($itemCustomer, $valueCustomer);

                  echo '<td>'.$customerAnswer["name"].'</td>

                  <td>$ '.number_format($value["netPrice"],2).'</td>

                  <td>'.$value["discount"].'</td>

                  <td>$ '.number_format($value["totalPrice"],2).'</td>

                  <td>'.$value["paymentMethod"].'</td>

                  <td>'.$value["saledate"].'</td>

                  <td>

                    <div class="btn-group">
                        
                      <div class="btn-group">
                        
                        <button class="btn btn-info btnPrintBill" saleCode="'.$value["code"].'">

                          <i class="fa fa-print"></i>

                        </button>
                        
                        <button class="btn btn-warning btnReopenSale" idSale="'.$value["id"].'"><i class="fa fa-pencil"></i></button>';

                        if ($_SESSION["profile"] == "administrator") {

                        echo '<button class="btn btn-danger btnDeleteSale" idSale="'.$value["id"].'"><i class="fa fa-times"></i></button>';

                        }

                        echo '</div>  

                      </td>

                    </tr>';
                    }

                  ?>
                              
                </tbody>

              </table>

              <?php

              $deleteSale = new SalesController();
              $deleteSale -> DeleteSaleController();

              ?>

      </div>
    
    </div>

  </section>

</div>


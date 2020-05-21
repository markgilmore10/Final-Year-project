<div class="content-wrapper">

  <section class="content-header">

    <h1>

      Open Tables

    </h1>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-body">

        <table class="table table-bordered table-striped dt-responsive tables" width="100%">
       
          <thead>
           
           <tr>
             
            <th style="width:10px">#</th>
            <th>Receipt Number</th>
            <th>Staff</th>
            <th>Table Number</th>
            <th>Net Price</th>
            <th>Date</th>
            <th>Actions</th>

           </tr> 

          </thead>

          <tbody>
          <?php



            $item = null;
            $value = null;


            //$answer = OpenTableController::index();
            $answer = OpenTableController::ShowTableController($item, $value);

            foreach ($answer as $key => $value) {
 

            echo '<td>'.($key+1).'</td>

            <td>'.$value["code"].'</td>';

            $itemUser = "id";
            $valueUser = $value["idSeller"];

            $userAnswer = UserController::ShowUsersController($itemUser, $valueUser);

            echo '<td>'.$userAnswer["name"].'</td>

            <td>'.$value["tableNo"].'</td>

            <td>$ '.number_format($value["netPrice"],2).'</td>

            <td>'.$value["date"].'</td>

            <td>

              <div class="btn-group">
                  
                <div class="btn-group">
                  
                <button class="btn btn-info btnPrintOpenBill" saleCode="'.$value["code"].'">

                  <i class="fa fa-print"></i>

                </button>';

                  echo '<button class="btn btn-warning btnReopenTable" idSale="'.$value["id"].'"><i class="fa fa-pencil"></i></button>

                    <button class="btn btn-danger btnDeleteTable" idSale="'.$value["id"].'"><i class="fa fa-times"></i></button>';

                  echo '</div>  

            </td>

          </tr>';
          }

          ?>
                    
        </tbody>

      </table>

      <?php

        $deleteTable = new OpenTableController();
        $deleteTable -> DeleteOpenTableController();

      ?>

      </div>
    
    </div>

  </section>

</div>
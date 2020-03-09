<div class="content-wrapper">

  <section class="content-header">

    <h1>

      Customers

    </h1>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">

        <button class="btn btn-primary" data-toggle="modal" data-target="#addCustomer">

        Add Customer

        </button>

      </div>
      <div class="box-body">
        <table class="table table-bordered table-striped dt-responsive tables" width="100%">
       
          <thead>
           
           <tr>
             
             <th style="width:10px">#</th>
             <th>Name</th>
             <th>Address</th>
             <th>Email</th>
             <th>Phone</th>
             <th>D.O.B</th>
             <th>Total purchases</th>
             <th>Last Purchase</th>
             <th>Registered</th>
             <th>Actions</th>

           </tr> 

          </thead>

          <tbody>
          
          <?php

            $item = null;
            $valor = null;

            $Customers = controllerCustomers::ctrShowCustomers($item, $valor);

            foreach ($Customers as $key => $value) {
              

              echo '<tr>
              
                      <td>'.($key+1).'</td>
                      <td>'.$value["name"].'</td>
                      <td>'.$value["address"].'</td>
                      <td>'.$value["email"].'</td>
                      <td>'.$value["phone"].'</td>
                      <td>'.$value["dob"].'</td>         
                      <td>'.$value["totalPurchases"].'</td>
                      <td>'.$value["lastPurchase"].'</td>
                      <td>'.$value["registerDate"].'</td>

                      <td>

                        <div class="btn-group">
                            
                          <button class="btn btn-warning btnEditCustomer" data-toggle="modal" data-target="#modEditCustomer" idCustomer="'.$value["id"].'"><i class="fa fa-pencil"></i></button>

                          <button class="btn btn-danger btnDeleteCustomer" idCustomer="'.$value["id"].'"><i class="fa fa-times"></i></button>

                        </div>  

                      </td>

                    </tr>';
            
              }

          ?>
            
          </tbody>

        </table>

      </div>
    
    </div>

  </section>

</div>
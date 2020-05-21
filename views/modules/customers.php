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
             <th>ID</th>
             <th>Address</th>
             <th>Email</th>
             <th>Phone Number</th>
             <th>D.O.B</th>
             <th>Discount</th>
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

            $Customers = CustomerController::ShowCustomerController($item, $valor);

            foreach ($Customers as $key => $value) {
              

              echo '<tr>

                      <td>'.($key+1).'</td>
                      <td>'.$value["name"].'</td>
                      <td>'.$value["idNumber"].'</td>
                      <td>'.$value["address"].'</td>
                      <td>'.$value["email"].'</td>
                      <td>'.$value["mobile"].'</td>
                      <td>'.$value["dob"].'</td>   
                      <td>'.$value["discount"].'</td> 
                      <td>'.$value["purchases"].'</td>       
                      <td>'.$value["lastPurchase"].'</td>
                      <td>'.$value["registerDate"].'</td>

                      <td>

                        <div class="btn-group">
                            
                          <button class="btn btn-warning btnEditCustomer" data-toggle="modal" data-target="#modEditCustomer" idCustomer="'.$value["id"].'"><i class="fa fa-pencil"></i></button>';


                          if ($_SESSION["profile"] == "administrator") {

                          echo '<button class="btn btn-danger btnDeleteCustomer" idCustomer="'.$value["id"].'"><i class="fa fa-times"></i></button>';
                          }

                        echo '</div>  

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

<div id="addCustomer" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="POST">

        <div class="modal-header" style="background: #3c8dbc; color: #fff">
          
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          
          <h4 class="modal-title">Add Customer</h4>

        </div>

        <div class="modal-body">

          <div class="box-body">

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input class="form-control input-lg" type="text" name="newCustomer" placeholder="Name" required>

              </div>

            </div>

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                <input class="form-control input-lg" type="number" min="0" name="newId" placeholder="ID Number" required>

              </div>

            </div>

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                <input class="form-control input-lg" type="text" name="newAddress" placeholder="Address" required>

              </div>

            </div>

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                <input class="form-control input-lg" type="text" name="newEmail" placeholder="Email" required>

              </div>

            </div>

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                <input class="form-control input-lg" type="text" name="newMobile" placeholder="Mobile Number" data-inputmask="'mask':'(999) 999-9999'" data-mask required>

              </div>

            </div>

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                <input class="form-control input-lg" type="text" name="newDob" placeholder="yyyy/mm/dd" data-inputmask="'alias': 'yyyy/mm/dd'" data-mask required>

              </div>

            </div>

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                <input class="form-control input-lg" type="number" min="0" name="newDiscount" placeholder="Discount" required>

              </div>

            </div>

          </div>

        </div>

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save</button>

        </div>

      </form>

      <?php

        $createCustomer = new CustomerController();
        $createCustomer -> CreateCustomerController();

      ?>

    </div>

  </div>

</div>

<div id="modEditCustomer" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Edit Customer</h4>

        </div>

        <div class="modal-body">

          <div class="box-body">

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input class="form-control input-lg" type="text" name="editCustomer" id="editCustomer" required>
                <input type="hidden" id="idCustomer" name="idCustomer">

              </div>

            </div>

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                <input class="form-control input-lg" type="number" min="0" name="editId" id="editId" required>

              </div>

            </div>

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                <input class="form-control input-lg" type="text" name="editAddress" id="editAddress" required>

              </div>

            </div>

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                <input class="form-control input-lg" type="text" name="editEmail" id="editEmail" required>

              </div>

            </div>

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                <input class="form-control input-lg" type="text" name="editMobile" id="editMobile" data-inputmask="'mask':'(999) 999-9999'" data-mask required>

              </div>

            </div>

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                <input class="form-control input-lg" type="text" name="editDob" id="editDob" placeholder="yyyy/mm/dd" data-inputmask="'alias': 'yyyy/mm/dd'" data-mask required>

              </div>

            </div>

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                <input class="form-control input-lg" type="number" min="0" name="editDiscount" id="editDiscount" required>

              </div>

            </div>

          </div>

        </div>

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>

          <button type="submit" class="btn btn-primary">Save</button>

        </div>

      </form>

      <?php

        $EditCustomer = new CustomerController();
        $EditCustomer -> EditCustomerController();

      ?>


      </div>

  </div>

</div>

<?php

  $deleteCustomer = new CustomerController();
  $deleteCustomer -> DeleteCustomerController();

?>


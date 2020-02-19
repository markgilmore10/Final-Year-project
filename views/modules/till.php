<div class="content-wrapper">

  <section class="content">

    <div class="row">
      
      <div class="col-lg-5 col-xs-12">
        
        <div class="box box-success">

          <div class="box-header with-border"></div>

          <form role="form" method="post" class="saleForm">

            <div class="box-body">
                
                <div class="box">

                    <!-- Employee Name -->              
                    <div class="form-group">

                      <div class="input-group">
                        
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>

                        <input type="text" class="form-control" name="newSeller" id="newSeller" value="<?php echo $_SESSION["name"]; ?>" readonly>

                        <input type="hidden" name="idSeller" value="<?php echo $_SESSION["id"]; ?>">

                      </div>

                    </div>


                    <!-- Receipt Number -->
                    <div class="form-group">

                      <div class="input-group">
                        
                        <span class="input-group-addon"><i class="fa fa-key"></i></span>

                        <?php 
                          $item = null;
                          $value = null;

                          $sales = ControllerSales::ShowSalesController($item, $value);

                          if(!$sales){

                            echo '<input type="text" class="form-control" name="newSale" id="newSale" value="10001" readonly>';
                          }
                          else{

                            foreach ($sales as $key => $value) {
                              
                            }

                            $code = $value["code"] +1;

                            echo '<input type="text" class="form-control" name="newSale" id="newSale" value="'.$code.'" readonly>';

                          }

                        ?>

                      </div>

                    </div>

                    <div class="row">

                      <!-- Tax and Total -->
                      <div class="col-xs-8 pull-right">

                        <table class="table">
                          
                          <thead>
                            
                            <th>Tax</th>
                            <th>Total</th>

                          </thead>


                          <tbody>
                            
                            <tr>
                              
                              <td style="width: 50%">

                                <div class="input-group">
                                  
                                  <input type="number" class="form-control" name="tax" id="tax" placeholder="0" min="0" required>

                                  <input type="hidden" name="tax" id="tax" required>

                                  <input type="hidden" name="netPrice" id="nPrice" required>
                                  
                                  <span class="input-group-addon"><i class="fa fa-percent"></i></span>

                                </div>
                              </td>

                              <td style="width: 50%">

                                <div class="input-group">
                                  
                                  <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>
                                  
                                  <input type="number" class="form-control" name="newSaleTotal" id="newSaleTotal" placeholder="00000" totalSale="" readonly required>

                                  <input type="hidden" name="saleTotal" id="saleTotal" required>

                                </div>

                              </td>

                            </tr>

                          </tbody>

                        </table>
                        
                      </div>

                      <hr>
                      
                    </div>

                    <hr>

                    <!-- Payment Method -->

                    <div class="form-group row">
                      
                      <div class="col-xs-6" style="padding-right: 0">

                        <div class="btn-toolbar">

                            <button type="button" class="btn btn-primary" value="cash" name="newPaymentMethod" id="newPaymentMethod" required>Cash</button>
                            <button type="button" class="btn btn-warning" value="card" name="newPaymentMethod" id="newPaymentMethod" required>Card</button>
                            <button type="button" class="btn btn-danger" value="voucher" name="newPaymentMethod" id="newPaymentMethod" required>Voucher</button>
                            
                        </div>

                      </div>

                    </div>

                    <br>
                    
                </div>

            </div>

            <div class="box-footer">
              <button type="submit" class="btn btn-primary pull-right">Save</button>
            </div>
          </form>

        </div>

      </div>


      <!-- Product Buttons -->


      <div class="col-lg-7 hidden-md hidden-sm hidden-xs">
        
          <div class="box box-warning">
            
            <div class="box-header with-border"></div>

                <div class="container">

                    <div class="row row-cols-3">

                        <button type = "button" class = "btn btn-default salesTable">Default Button</button>

                    </div>

                </div>

          </div>

      </div>

    </div>

  </section>

</div>
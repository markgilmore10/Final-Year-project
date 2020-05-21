<div class="content-wrapper">

  <section class="content">

    <div class="row">
      
      <div class="col-lg-5 col-xs-12">
        
        <div class="box box-success">

          <div class="box-header with-border"></div>

          <form role="form" method="post" class="saleForm"> <!-- Sale Form --> 

            <div class="box-body">
                
                <div class="box">

                <?php

                  $item = "id";
                  $value = $_GET["idSale"];

                  $sale = SalesController::ShowSalesController($item, $value);

                  $itemUser = "id";
                  $valueUser = $sale["idSeller"];

                  $seller = UserController::ShowUsersController($itemUser, $valueUser);
                
                  $itemCustomers = "id";
                  $valueCustomers = $sale["idCustomer"];

                  $customers = CustomerController::ShowCustomerController($itemCustomers, $valueCustomers);

                ?>

                <?php

                  echo '            
                    <div class="form-group">

                      <div class="input-group">
                        
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>

                        <input type="text" class="form-control" name="newSeller" id="newSeller" value="'.$seller["name"].'" readonly>

                        <input type="hidden" name="idSeller" value="'.$seller["id"].'">

                      </div>

                    </div>'; 

                    ?>

                    <?php

                      echo '
            
                      <div class="form-group">

                        <div class="input-group">
                          
                          <span class="input-group-addon"><i class="fa fa-key"></i></span>

                          <input type="text" class="form-control" id="reSale" name="reopenSale" value="'.$sale["code"].'" readonly>
                                                
                        </div>

                      </div>'; 
                    ?>

                    <!-- Table Number -->    
                    <?php

                        echo '

                        <div class="form-group">
  
                        <div class="input-group">
                          
                          <span class="input-group-addon"><i class="fa fa-user"></i></span>
  
                          <input type="text" class="form-control" name="tableNo" id="tableNo" value="'.$sale["tableNo"].'">
  
                        </div>

                      </div>'; 
                    ?>
                    
                    <!-- Customer Number -->              
                    <div class="form-group">

                      <div class="input-group">
                                      
                        <span class="input-group-addon"><i class="fa fa-users"></i></span>

                        <div id="customer_div">
                          
                          <input type="text" class="form-control" id="customerSearch" name="customerSearch" placeholder="Search Customer">

                          <div class="dropdown" id="results" style="display: none"></div>

                        </div>
                                      
                        <span class="input-group-addon"><button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#addNewCustomer" data-dismiss="modal">Add Customer</button></span>
                                  
                      </div>
                                
                    </div>

                    <!-- Products -->
                    <div class="form-group row newProduct">
                      <?php

                        $productList = json_decode($sale["products"], true);
                        //$productList2 = json_decode($openSale["products"], true);

                        if (is_array($productList)) {
                        foreach ($productList as $key => $value) {

                          $item = "id";
                          $valueProduct = $value["id"];
                          $order = "id";
                          
                          $answer = ProductsController::ShowProductsController($item, $valueProduct, $order);

                          $lastStock = $answer["stock"] + $value["quantity"];
                          
                          echo '<div class="row" style="padding:5px 15px">
                    
                                <div class="col-xs-6" style="padding-right:0px">
                    
                                  <div class="input-group">
                        
                                    <span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs removeProduct" idProduct="'.$value["id"].'"><i class="fa fa-times"></i></button></span>

                                    <input type="text" class="form-control newProductDescription" idProduct="'.$value["id"].'" name="addProduct" value="'.$value["product"].'" readonly required>

                                  </div>

                                </div>

                                <div class="col-xs-3">
                      
                                  <input type="number" class="form-control newProductQuantity" name="newProductQuantity" min="1" value="'.$value["quantity"].'" stock="'.$lastStock.'" newStock="'.$value["stock"].'" required>

                                </div>

                                <div class="col-xs-3 enterPrice" style="padding-left:0px">

                                  <div class="input-group">

                                    <span class="input-group-addon"><i class="ion ion-social-euro"></i></span>
                           
                                    <input type="text" class="form-control newProductPrice" realPrice="'.$answer["sellingPrice"].'" name="newProductPrice" value="'.$value["totalPrice"].'" readonly required>
           
                                  </div>
                       
                                </div>

                              </div>';
                        }
                      
                      }
                        ?>

                    </div>

                    <input type="hidden" name="productsList" id="productsList">
                    <!-- Total -->

                    <div class="row">
                      
                      <div class="col-xs-8 pull-right">

                        <table class="table">
                          
                          <thead>
                            
                            <th>Discount</th>
                            <th>Total</th>

                          </thead>


                          <tbody>
                            
                            <tr>
                              
                              <td style="width: 50%">

                                <div class="input-group">
                                  
                                  <input type="number" class="form-control" name="newDiscountSale" id="newDiscountSale" min="0">

                                  <input type="hidden" name="newDiscountPrice" id="newDiscountPrice" value="<?php echo $sale["discount"]; ?>" required>

                                  <input type="hidden" name="newNetPrice" id="newNetPrice" value="<?php echo $sale["netPrice"]; ?>" required>
                                  
                                  <span class="input-group-addon"><i class="fa fa-percent"></i></span>

                                </div>

                              </td>

                              <td style="width: 50%">

                                <div class="input-group">
                                  
                                  <span class="input-group-addon"><i class="ion ion-social-euro"></i></span>
                                  
                                  <input type="number" class="form-control" name="newSaleTotal" id="newSaleTotal" placeholder="00000" totalSale="<?php echo $sale["netPrice"]; ?>" value="<?php echo $sale["totalPrice"]; ?>" readonly required>

                                  <input type="hidden" name="saleTotal" id="saleTotal" value="<?php echo $sale["totalPrice"]; ?>" required>

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
                      
                      <div>

                        <div class="btn-toolbar">

                            <button type="submit" class="btn btn-primary pull-right" value="Cash" name="newPaymentMethod" id="newPaymentMethod" required>Cash</button>
                            <button type="submit" class="btn btn-warning pull-right" value="Card" name="newPaymentMethod" id="newPaymentMethod" required>Card</button>
                            <button type="submit" class="btn btn-danger pull-right" value="Voucher" name="newPaymentMethod" id="newPaymentMethod" required>Voucher</button>
                            <button type="submit" class="btn btn-primary pull-right" value="hold" name="openTable">Hold</button>

                        </div>

                      </div>

                    </div>

                    <br>
                    
                </div>

            </div>

          </form>

          <?php

            $reopenSale = new SalesController();
            $reopenSale -> ReOpenTableController();
            
          ?>

        </div>

      </div>


      <!-- Product Buttons -->
      <div class="col-lg-7 hidden-md hidden-sm hidden-xs">
        
          <div class="box box-warning">
            
            <div class="box-header with-border"></div>

            <div class="box-body">
              
              <table class="table table-bordered salesTable">
                  
                <thead>

                   <tr>
                     
                     <th>Product</th>
                    
                   </tr> 

                </thead>

              
              </table>

            </div>

          </div>

    </div>

  </section>

</div>

<div id="addNewCustomer" class="modal fade" role="dialog">
  
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
                <input class="form-control input-lg" type="text" name="newDob" placeholder="Date of Birth" data-inputmask="'alias': 'yyyy/mm/dd'" data-mask required>

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

<div id="splitBill" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="POST">

        <div class="modal-header" style="background: #3c8dbc; color: #fff">
          
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          
          <h4 class="modal-title">Split Bill</h4>

        </div>

        <div class="modal-body">

          <div class="box-body">

            <div class="form-group">

              

            </div>

          </div>

        </div>

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Split</button>

        </div>

      </form>

      <?php

        $createCustomer = new CustomerController();
        $createCustomer -> CreateCustomerController();

      ?>

    </div>

  </div>

</div>


<script>
    $(document).on("click", ".customer_row", function () {

        var $number = $(this).find('.number').html();

        var $id = $(this).data("id");

        var $discount = $(this).data("discount");

        $("#customerSearch").val($number);

        $("#customerSearch").val();

        $("#newDiscountSale").val($discount);

        totalPrice();

        lessDiscount();

        $("#results").hide();

    });

    $(document).on("keyup", "#customerSearch", function () {

        var size = $(this).val().length;

        if (size > 2) {
            $.ajax({
                url: "ajax/customers.ajax.php",
                type: "post",
                data: {
                    search: true,
                    number: $(this).val(),
                },
                dataType: 'json',
                success: function (response) {
                    $("#results").html(response);
                    $("#results").show();
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    $("#results").html('<div class="customer_row" data-id="">Error. Please Try Again</div>');
                    $("#results").show();
                    console.log(errorThrown)
                }
                
            });
            
            
        } else {
            $("#results").html("");
            $("#results").hide();
        }
    })
</script>
<?php

if($_SESSION["profile"] == "staff"){

  echo '<script>

    window.location = "dashboard";

  </script>';

  return;

}

?>

<div class="content-wrapper">

  <section class="content-header">

    <h1>

      Product management

    </h1>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">

        <button class="btn btn-primary" data-toggle="modal" data-target="#addProduct">Add Product</button>

      </div>

      <div class="box-body">

        <table class="table table-bordered table-striped dt-responsive productsTable" width="100%">
       
          <thead>
           
           <tr>
             
             <th style="width:10px">#</th>
             <th>Code</th>
             <th>Product</th>
             <th>Category</th>
             <th>Stock</th>
             <th>Buying price</th>
             <th>Selling Price</th>
             <th>Edit/Delete</th>

           </tr> 

          </thead>

        </table>

        <input type="hidden" value="<?php echo $_SESSION['profile']; ?>" id="hiddenProfile">

      </div>
    
    </div>

  </section>

</div>

<!-- Add Product -->
<div id="addProduct" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="POST" enctype="multipart/form-data">

        <div class="modal-header" style="background: #3c8dbc; color: #fff">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Add Product</h4>

        </div>

        <div class="modal-body">

          <div class="box-body">

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                <select class="form-control input-lg" id="newCategory" name="newCategory" required>

                  <option value="">Select Category</option>

                  <?php

                    $item = null;
                    $value1 = null;

                    $categories = ControllerCategories::ShowCategoriesController($item, $value1);
                  
                    foreach ($categories as $key => $value):
                  ?>
                      <option value="<?= $value["id"] ?>" data-vat="<?= $value["Vat"] ?>" data-tax="<?= $value["Tax"] ?>" ><?= $value["Category"] ?></option>
                    
                  <?php
                    endforeach;
                  ?>

                </select>

              </div>

            </div>

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-code"></i></span>

                <input class="form-control input-lg" type="text" id="newCode" name="newCode" placeholder="Add Code" required>

              </div>

            </div>

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span>

                <input class="form-control input-lg" type="text" id="newDescription" name="newDescription" placeholder="Add Product" required>

              </div>

            </div>

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-check"></i></span>

                <input class="form-control input-lg" type="number" id="newStock" name="newStock" placeholder="Add Stock" min="0" required>

              </div>

            </div>

            <div class="form-group row">

              <div class="col-xs-12 col-sm-6">

                <div class="input-group"> 

                  <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span> 

                  <input type="number" class="form-control input-lg" id="newBuyingPrice" name="newBuyingPrice" step="any" min="0" placeholder="Buying price" required>
                  <input type="hidden" class="form-control input-lg" id="newVatPrice" name="newVatPrice" step="any" min="0" value="" required>
                  <input type="hidden" class="form-control input-lg" id="newTaxPrice" name="newTaxPrice" step="any" min="0" value="" required>

                </div>

              </div>

              <div class="col-xs-12 col-sm-6">  

                <div class="input-group"> 

                  <span class="input-group-addon"><i class="fa fa-arrow-down"></i></span> 

                  <input type="number" class="form-control input-lg" id="newBuyingPricePlus" name="newBuyingPricePlus" step="any" min="0" placeholder="Selling price" required>

                </div>

              </div>

            </div> 

            <br>

            <div class="form-group row">

              <!-- INPUT SELLING PRICE -->
              <div class="col-xs-12 col-sm-6">  

                <div class="input-group"> 

                  <span class="input-group-addon"><i class="fa fa-arrow-down"></i></span> 

                  <input type="number" class="form-control input-lg" id="newSellingPrice" name="newSellingPrice" step="any" min="0" placeholder="Selling price" required>

                </div> 

                <br>

                <!-- CHECKBOX PERCENTAGE -->
                <div class="col-xs-6"> 

                  <div class="form-group">   

                    <label>     

                      <input type="checkbox" class="minimal percentage" checked>

                      Markup

                    </label>

                  </div>

                </div>

                <!-- INPUT PERCENTAGE -->
                <div class="col-xs-6" style="padding:0">

                  <div class="input-group"> 

                    <input type="number" class="form-control input-lg newPercentage" min="0" value="40" required>

                    <span class="input-group-addon"><i class="fa fa-percent"></i></span>

                  </div>

                </div>

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

          $addProduct = new ProductsController();
          $addProduct -> AddProductsController();

      ?>

    </div>

  </div>

</div>


<!-- Edit Product -->
<div id="editAProduct" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="POST" enctype="multipart/form-data">

        <div class="modal-header" style="background: #3c8dbc; color: #fff">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Edit Product</h4>

        </div>

        <div class="modal-body">

          <div class="box-body">
            
            <!-- Edit Product -->
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                <select class="form-control input-lg"  name="editCategory" required>

                  <option id="editCategory"></option>

                </select>

              </div>

            </div>
            
            <!-- Edit Code -->
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-code"></i></span>

                <input class="form-control input-lg" type="text" id="editCode" name="editCode" required>

              </div>

            </div>

            <!-- Edit Product -->
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span>

                <input class="form-control input-lg" type="text" id="editProducts" name="editProducts" required>

              </div>

            </div>

            <!-- Edit Stock -->
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-check"></i></span>

                <input class="form-control input-lg" type="number" id="editStock" name="editStock" placeholder="Stock" required>

              </div>

            </div>

            <!-- Edit Buying Price -->
            <div class="form-group row">

              <div class="col-xs-12 col-sm-6">

                <div class="input-group"> 

                  <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span> 

                  <input type="number" class="form-control input-lg" id="editBuyingPrice" name="editBuyingPrice" step="any" min="0" placeholder="Buying price">
                  <input type="hidden" class="form-control input-lg" id="newVatPrice" name="newVatPrice" step="any" min="0" value="" required>
                  <input type="hidden" class="form-control input-lg" id="newTaxPrice" name="newTaxPrice" step="any" min="0" value="" required>
                </div>

              </div>

              <div class="col-xs-12 col-sm-6">  

                <div class="input-group"> 

                  <span class="input-group-addon"><i class="fa fa-arrow-down"></i></span> 

                  <input type="number" class="form-control input-lg" id="editBuyingPricePlus" name="editBuyingPricePlus" step="any" min="0"y required>

                </div>

              </div>

            </div> 

            <br>

            <div class="form-group row">

              <!-- INPUT SELLING PRICE -->
              <div class="col-xs-12 col-sm-6">  

                <div class="input-group"> 

                  <span class="input-group-addon"><i class="fa fa-arrow-down"></i></span> 

                  <input type="number" class="form-control input-lg" id="editSellingPrice" name="editSellingPrice" step="any" min="0" placeholder="Selling price" required>

                </div> 

                <br>

                <!-- CHECKBOX PERCENTAGE -->
                <div class="col-xs-6"> 

                  <div class="form-group">   

                    <label>     

                      <input type="checkbox" class="minimal percentage" checked>

                      Markup

                    </label>

                  </div>

                </div>

                <!-- INPUT PERCENTAGE -->
                <div class="col-xs-6" style="padding:0">

                  <div class="input-group"> 

                    <input type="number" class="form-control input-lg newPercentage" min="0" value="40" required>

                    <span class="input-group-addon"><i class="fa fa-percent"></i></span>

                  </div>

                </div>

              </div>

            </div>

          </div>

        </div>

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>

          <button type="submit" class="btn btn-primary">Save Changes</button>

        </div>

      </form>

      <?php

        $editProduct = new ProductsController();
        $editProduct -> EditProductsController();

      ?>   

    </div>

  </div>

</div>

<?php

  $deleteProduct = new ProductsController();
  $deleteProduct -> DeleteProductsController();

 ?>   
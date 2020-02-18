<div class="content-wrapper">

  <section class="content-header">

    <h1>

      Manage Products

    </h1>

    <ol class="breadcrumb">

      <li><a href="home"><i class="fa fa-dashboard"></i> Home</a></li>

      <li class="active">Manage Products</li>

    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">

        <button class="btn btn-primary" data-toggle="modal" data-target="#addProduct">

          Add products

        </button>

      </div>

      <div class="box-body">

        <table class="table table-bordered table-striped dt-responsive ProductsTable" width="100%">
       
          <thead>

            <!--  <tr>
                <th>Name</th>
                <th>Position</th>
                <th>Office</th>
                <th>Extn</th>
                <th>Start date</th>
                <th>Salary</th> -->
           
         <tr>
             
             <th style="width:10px">#</th>
             <th>Code</th>
             <th>Description</th>
             <th>Category</th>
             <th>Stock</th>
             <th>Cost</th>
             <th>Selling price</th>
             <th>Sales</th>
             <th>Date added</th>
             <th>Actions</th>

           </tr> 

          </thead>

          <tbody>

          <?php
          require_once("C:\\xampp\htdocs\pos\controllers\categories.controller.php");
          require_once("C:\\xampp\htdocs\pos\models\categories.model.php");
          #include "'C:\\xampp\\htdocs/pos/controllers/categories.controller.php";

          $item = null;
          $value = null;

          $products = ProductsController::ShowProductsController($item, $value);

          #var_dump($products);

          foreach ($products as $key => $value){

            echo'<tr>
              
                    <td>'.($key+1).'</td>
                    <td>'.$value["code"].'</td>
                    <td>'.$value["description"].'</td>';

                    $item = "id";
                    $values = $value["idCategory"];
                    $category = ControllersCategories::ShowCategoriesController($item, $value);


                    echo '<td>'.$category["category"].'</td>
                    <td>'.$value["stock"].'</td>
                    <td>'.$value["buyingPrice"].'</td>
                    <td>'.$value["sellingPrice"].'</td>
                    <td>'.$value["sales"].'</td>
                    <td>'.$value["date"].'</td>
                    <td><button class="btn btn-success btn-xs">Active</button></td>
                    <td>

                      <div class="btn-group">
                          
                        <button class="btn btn-warning"><i class="fa fa-pencil"></i></button>

                        <button class="btn btn-danger"><i class="fa fa-times"></i></button>

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


<!--=====================================
=            Add Product Module           =
======================================-->


<div id="addProduct" class="modal fade" role="dialog">

  <div class="modal-dialog">

   
    <div class="modal-content">

      <form role="form" method="POST" enctype="multipart/formdata">

        

        <div class="modal-header" style="background: #3c8dbc; color: #fff">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Add product</h4>

        </div>

       

        <div class="modal-body">

          <div class="box-body">

           

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-code"></i></span>

                <input class="form-control input-lg" type="text" name="newCode" placeholder="Add code" required>

              </div>

            </div>

            

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span>

                <input class="form-control input-lg" type="text" name="newDescription" placeholder="Add Description" required>

              </div>

            </div>

            

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                <select class="form-control input-lg" name="newCategory">

                  <option value="">Select Category</option>
                  <option value="Food">Food</option>
                  <option value="Drinks">Drinks</option>

                </select>

              </div>

            </div>

             

             <div class="form-group">

              <div class="input-group">

                 <span class="input-group-addon"><i class="fa fa-Check"></i></span>

                 <input class="form-control input-lg" type="Number" name="newStock" min="0" placeholder="Stock" required>

                </div>

              </div>

             

             <div class="form-group row">

                <div class="col-xs-6">  
                    <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span>

                        <input class="form-control input-lg" type="Number" name="newCost" min="0" placeholder="Cost" required>

                    </div>
                </div>
              </div>

                

                <div class="col-xs-6"> 

                    <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-arrow-down"></i></span>

                        <input class="form-control input-lg" type="Number" name="newSellingPrice" min="0" placeholder="Selling Price" required>

                    </div>
                    </div>

                    <br>

                    

                    <div class="col-xs-6">

                        <div class="form-group">

                            <label>

                                <input type="checkbox" class="minimal percentage" checked>
                                Use percentage 
                            </label>



                     </div>    

                

              

              <div class="col-xs-6" style="padding:0">

                <div class="input-group">
                    <input type="number" class="form-control input-lg newPercentage" min="0" value="40" required>

                    <span class="input-group-addon"><i class="fa fa-percent"></i></span>


              
            </div>
            </div>
            </div>
            </div>
            
             
             
           

        

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>

          <button type="submit" class="btn btn-primary">Save Product</button>

        </div>

      </form>

    </div>

  </div>

</div>



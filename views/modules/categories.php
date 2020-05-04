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
        Manage Categories
      </h1>
    
    </section>
 
    <section class="content">

      <div class="box">

        <div class="box-header with-border">

          <button class="btn btn-primary" data-toggle="modal" data-target="#addCategory">Add Category</button>

        </div>

        <div class="box-body">

          <table class="table table-bordered table-striped dt-responsive tables" width="100%">
         
            <thead>
             
             <tr>
               
               <th style="width:10px">#</th>
               <th>Category</th>
               <th>VAT</th>
               <th>Tax</th>
               <th>Actions</th>

             </tr> 

            </thead>

            <tbody>

              <?php

                $item = null; 
                $value = null;

                $categories = ControllerCategories::ShowCategoriesController($item, $value);

                foreach ($categories as $key => $value) {

                  echo '<tr>
                          <td>'.($key+1).'</td>
                          <td class="text-uppercase">'.$value['Category'].'</td>
                          <td class="text-uppercase">'.$value['Vat'].'</td>
                          <td class="text-uppercase">'.$value['Tax'].'</td>
                          <td>

                            <div class="btn-group">
                                
                              <button class="btn btn-warning btnEditCategory" idCategory="'.$value["id"].'" data-toggle="modal" data-target="#editCategories"><i class="fa fa-pencil"></i></button>';

                              if ($_SESSION["profile"] == "administrator") {

                              echo '<button class="btn btn-danger btnDeleteCategory" idCategory="'.$value["id"].'"><i class="fa fa-times"></i></button>';
                              
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


<div id="addCategory" class="modal fade" role="dialog">

    <div class="modal-dialog">

        <div class="modal-content">

            <form role="form" method="POST">

                <div class="modal-header" style="background: #3c8dbc; color: #fff">

                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add Categories</h4>

                </div>

                <div class="modal-body">

                    <div class="box-body">

                        <div class="form-group">

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-th"></i></span>
                                <input class="form-control input-lg" type="text" name="newCategory" placeholder="Add Category" required>

                            </div>

                        </div>

                        <div class="form-group">

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-th"></i></span>
                                <input class="form-control input-lg" type="number" min="0" id="newVat" name="newVat" placeholder="Add VAT" required>

                            </div>

                        </div>

                        <div class="form-group">

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-th"></i></span>
                                <input class="form-control input-lg" type="number" min="0" id="newTax" name="newTax" placeholder="Add Tax" required>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="modal-footer">

                  <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Save Category</button>

                </div>

            </form>
        </div>

    </div>

</div>

<?php

  $createCategory = new ControllerCategories();
  $createCategory -> CreateCategoryController();

?>

<!-- Edit Categories -->
<div id="editCategories" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="POST">

        <div class="modal-header" style="background: #3c8dbc; color: #fff">

          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Edit Categories</h4>

        </div>

        <div class="modal-body">

          <div class="box-body">

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-th"></i></span>
                <input class="form-control input-lg" type="text" id="editCategory" name="editCategory" required>
                <input type="hidden" name="idCategory" id="idCategory" required>

              </div>

            </div>

            <div class="form-group">

              <div class="input-group">

                  <span class="input-group-addon"><i class="fa fa-th"></i></span>
                  <input class="form-control input-lg" type="number" min="0" id="newVat" name="newVat" placeholder="Add VAT" required>

              </div>

            </div>

            <div class="form-group">

              <div class="input-group">

                  <span class="input-group-addon"><i class="fa fa-th"></i></span>
                  <input class="form-control input-lg" type="number" min="0" id="newTax" name="newTax" placeholder="Add Tax" required>

              </div>

            </div>

          </div>

        </div>

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>

        </div>

        <?php
  
          $editCategory = new ControllerCategories();
          $editCategory -> EditCategoryController();
        ?>

      </form>

    </div>

  </div>

</div>

<?php
  
  $deleteCategory = new ControllerCategories();
  $deleteCategory -> DeleteCategoryController();
?>


<div class="content-wrapper">

  <section class="content-header">

    <h1> Users </h1>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">

        <button class="btn btn-primary" data-toggle="modal" data-target="#addUser">

          Add user

        </button>

      </div>

      <div class="box-body">

        <table class="table table-bordered table-striped dt-responsive tables" width="100%">

          <thead>

            <tr>

              <th style="width:10px">#</th>
              <th>Name</th>
              <th>Username</th>
              <th>Profile</th>
              <th>Status</th>
              <th>Last login</th>
              <th>Actions</th>

            </tr>

          </thead>

          <tbody>
          
            <?php

              $item = null; 
              $value = null;

              $users = UserController::ShowUsersController($item, $value);

              foreach ($users as $key => $value) {

                echo '

                  <tr>
                    <td>'.($key+1).'</td>
                    <td>'.$value["name"].'</td>
                    <td>'.$value["user"].'</td>';

                    echo '<td>'.$value["profile"].'</td>';

                    if($value["status"] != 0){

                      echo '<td><button class="btn btn-success btnActivate btn-xs" userId="'.$value["id"].'" userStatus="0">Activated</button></td>';

                    }else{

                      echo '<td><button class="btn btn-danger btnActivate btn-xs" userId="'.$value["id"].'" userStatus="1">Deactivated</button></td>';
                    }
                    
                    echo '<td>'.$value["lastLogin"].'</td>

                    <td>

                      <div class="btn-group">
                          
                        <button class="btn btn-warning btnEditUser" idUser="'.$value["id"].'" data-toggle="modal" data-target="#editUser"><i class="fa fa-pencil"></i></button>

                        <button class="btn btn-danger btnDeleteUser" userId="'.$value["id"].'" username="'.$value["user"].'"><i class="fa fa-times"></i></button>

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


<!------- Add User ------->

<div id="addUser" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="POST" enctype="multipart/form-data">

        <div class="modal-header" style="background: #3c8dbc; color: #fff">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Add user</h4>

        </div>

        <div class="modal-body">

          <div class="box-body">

            <!------- Add Name ------->
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-user"></i></span>

                <input class="form-control input-lg" type="text" name="newName" placeholder="Add Name" required>

              </div>

            </div>

            <!------- Add Username ------->
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-key"></i></span>

                <input class="form-control input-lg" type="text" id="newUser" name="newUser" placeholder="Add Username" required>

              </div>

            </div>

            <!------- Add Password ------->
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-lock"></i></span>

                <input class="form-control input-lg" type="password" name="newPassword" placeholder="Add Password" required>

              </div>

            </div>

            <!------- Add Position ------->
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-key"></i></span>

                <select class="form-control input-lg" name="newProfile">

                  <option value="">Select Position</option>
                  <option value="administrator">Administrator</option>
                  <option value="manager">Manager</option>
                  <option value="staff">Staff</option>

                </select>

              </div>

            </div>

          </div>

        </div>

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>

          <button type="submit" class="btn btn-primary">Save</button>

        </div>

        <?php

          $createUser = new UserController();
          $createUser -> CreateUserController();

        ?>

      </form>

    </div>

  </div>

</div>

<!------- Edit User ------->

<div id="editUser" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="POST" enctype="multipart/form-data">

        <div class="modal-header" style="background: #3c8dbc; color: #fff">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Edit user</h4>

        </div>

        <div class="modal-body">

          <div class="box-body">

            <!------- Edit name ------->
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-user"></i></span>

                <input class="form-control input-lg" type="text" id="EditName" name="EditName" value="" required>

              </div>

            </div>

            <!------- Edit Username ------->
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-key"></i></span>

                <input class="form-control input-lg" type="text" id="EditUser" name="EditUser" value="" readonly>

              </div>

            </div>

            <!------- Edit Password ------->
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-lock"></i></span>

                <input class="form-control input-lg" type="password" name="EditPassword" placeholder="Edit Password">

                <input type="hidden" name="CurrentPassword" id="CurrentPassword">

              </div>

            </div>

            <!------- Edit Position ------->
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-key"></i></span>

                <select class="form-control input-lg" name="EditProfile">

                  <option value="" id="EditProfile" placeholder="Edit Position"></option>
                  <option value="administrator">Administrator</option>
                  <option value="manager">Manager</option>
                  <option value="staff">Staff</option>

                </select>

              </div>

            </div>

          </div>

        </div>


        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>

          <button type="submit" class="btn btn-primary">Save</button>

        </div>

        <?php

          $editUser = new UserController();
          $editUser -> EditUserController();

        ?>

      </form>

    </div>

  </div>

</div>

<?php

  $deleteUser = new UserController();
  $deleteUser -> DeleteUserController();

?> 


<div class="content-wrapper">

  <section class="content-header">

    <h1>
      Users
    </h1>

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
        </table>
      </div>

      <div class="box-footer">

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

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-user"></i></span>

                <input class="form-control input-lg" type="text" name="newName" placeholder="Add name" required>

              </div>

            </div>

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-key"></i></span>

                <input class="form-control input-lg" type="text" id="newUser" name="newUser" placeholder="Add username" required>

              </div>

            </div>

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-lock"></i></span>

                <input class="form-control input-lg" type="password" name="newPasswd" placeholder="Add password" required>

              </div>

            </div>

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-key"></i></span>

                <select class="form-control input-lg" name="newProfile">

                  <option value="">Select profile</option>
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
            $createUser = new ControllerUsers();
            $createUser -> CreateUser();
          ?>

      </form>

    </div>

  </div>

</div>
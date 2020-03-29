<div id="back"></div>

<div class="login-box">

  <div class="login-box-body">

    <p class="login-box-msg">Sign In</p>

    <form method="post">

      <div class="form-group has-feedback">

        <input type="text" class="form-control" placeholder="User" name="loginUser" required>

        <span class="glyphicon glyphicon-user form-control-feedback"></span>

      </div>

      <div class="form-group has-feedback">

        <input type="password" class="form-control" placeholder="Password" name="loginPassword" required>

        <span class="glyphicon glyphicon-lock form-control-feedback"></span>

      </div>

      <div class="row">

        <div class="col-xs-4">

          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>

        </div>
       
      </div>

      <?php

        $login = new UserController();
        $login -> UserLoginController();

      ?>

    </form>

  </div>

</div>

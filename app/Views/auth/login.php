<div class="register-box">
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="#" class="h1"><b>Admin</b>LTE</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Iniciar Sesi&oacute;n</p>
      <?php 
        $validation = \Config\Services::validation();
      ?>
      <form action="<?php echo site_url('auth/login/check_user/')?>" method="post">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Correo electr&oacute;nico" name="email" value="<?php if (isset($email)) {echo $email;}?>">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" name="password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <?php
            $errores = $validation->getErrors('list');
            foreach ($errores as $r) {
                echo '<div class="alert alert-danger" role="alert">'.$r.'</div>';
            }
        ?>
          <!-- /.col -->
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Entrar</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <a href="<?php echo site_url('/auth/register/');?>" class="text-center">Crear una cuenta.</a>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->
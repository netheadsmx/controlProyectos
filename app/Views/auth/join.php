<div class="register-box">
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="#" class="h1"><b>Admin</b>LTE</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Unirte a una empresa existente</p>
      <?php 
        $validation = \Config\Services::validation();
      ?>
      <form action="<?php echo site_url('auth/register/check_if_exist')?>" method="post">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Buscar por Nombre Corto" name="nombre_corto">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-industry"></span>
            </div>
          </div>
        </div>
        <?php echo ($validation->showError('nombre_corto','custom_error')); ?>
          <!-- /.col -->
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Buscar</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
      <a href="#" class="text-center">Registrar mi empresa.</a>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->
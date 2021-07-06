<div class="register-box">
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="#" class="h1"><b>Admin</b>LTE</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Es momento de seleccionar una empresa o compa&ntilde;&iacute;a con la cual crear tu cuenta. Existen dos opciones:</p>
      <?php 
        $validation = \Config\Services::validation();
        if (isset($error)) {
          echo $error;
        }
      ?>        
        <div class="row">
          <div class="col-12">
            <h6>Opci&oacute;n 1:</h6><p>Si la empresa a la que perteneces a&uacute;n no tiene una cuenta en LTE o quieres llevar tus proyectos personales, puedes</p>
            <a type="button" class="btn btn-primary btn-block" href="<?php echo site_url('auth/register/new/');?>">Crear Cuenta de Empresa</a><br>
            <h6>Opci&oacute;n 2: </h6><p>Si la empresa a la que perteneces ya tiene una cuenta en LTE, puedes</p>
            <a type="button" class="btn btn-primary btn-block" href="<?php echo site_url('/auth/register/join/'); ?>">Unirte a tu empresa</a>
          </div>
        </div>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->
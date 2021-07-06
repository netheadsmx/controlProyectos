<div class="register-box">
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="#" class="h1"><b>Admin</b>LTE</a>
    </div>
    <div class="card-body">
      <?php 
        $validation = \Config\Services::validation();
      ?>
      <form action="<?php echo site_url('auth/register/confirmjoin')?>" method="post">
        <div class="input-group mb-3">
          <input type="hidden" name="idEmpresa" value="<?php echo $idCliente?>">
          <p class="login-box-msg">Confirmar unirte al espacio de trabajo de:</p>
          <h5 class="login-box-msg"><?php echo $nombre_cliente;?></h6>
          <p class="login-box-msg">Enviaremos un correo a los administradores de la empresa para confirmar que te puedes unir a su espacio de trabajo.</p>
          <!-- /.col -->
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Confirmar</button>
            <a class="btn btn-default btn-block" role="button" href="<?php echo site_url('/auth/register/join/');?>">No es mi empresa</a>
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
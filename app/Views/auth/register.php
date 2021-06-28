<div class="register-box">
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="#" class="h1"><b>Admin</b>LTE</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Iniciar el resgistro</p>
      <?php 
        $validation = \Config\Services::validation();
      ?>
      <form action="<?php echo site_url('auth/register/check_user_data')?>" method="post">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Nombre" name="nombre" value="<?php if (isset($nombre)) {echo $nombre;}?>">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <?php echo ($validation->showError('nombre','custom_error')); ?>
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Apelido" name="apellidos" value="<?php if (isset($apellidos)) {echo $apellidos;}?>">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <?php echo ($validation->showError('apellidos','custom_error')); ?>
        <div class="input-group mb-3">
          <input type="email" class="form-control" placeholder="Correo electr&oacute;nico" name="email" value="<?php if (isset($email)) {echo $email;}?>">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <select id="pais" name="pais" class="form-control">
            <option value="0" selected>Selecciona un pais</option>
            <?php
              foreach($paises as $p)
              {
                echo '<option value="'.$p['idPaises'].'">'.$p['nombre_pais'].'</option>';
              }
            ?>
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </select>
        </div>
        <?php echo ($validation->showError('email','custom_error')); ?>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" name="password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <?php echo ($validation->showError('password','custom_error')); ?>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Confirmar password" name="confirm">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <?php echo ($validation->showError('confirm','custom_error')); ?>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="agreeTerms" value="agree" name="terminos">
              <label for="agreeTerms">
               Acepto los <a href="#">t&eacute;rminos y condiciones</a>
              </label>
            </div>
          </div>
          <?php echo ($validation->showError('terminos','custom_error')); ?>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Registrar</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <a href="login.html" class="text-center">Ya tengo una cuenta.</a>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->
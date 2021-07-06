<div class="register-box">
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="#" class="h1"><b>Admin</b>LTE</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Nuevo Emprendedor o Compa&ntilde;ia</p>
      <?php 
        $validation = \Config\Services::validation();
      ?>
      <form action="<?php echo site_url('auth/register/check_new_company')?>" method="post">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Nombre Corto" name="nombre_corto" value="<?php if (isset($nombre_corto)) {echo $nombre_corto;}?>">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-industry"></span>
            </div>
          </div>
        </div>
        <?php echo ($validation->showError('nombre_corto','custom_error')); ?>
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Nombre Legal" name="legal" value="<?php if (isset($legal)) {echo $legal;}?>">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-file-contract"></span>
            </div>
          </div>
        </div>
        <?php echo ($validation->showError('legal','custom_error')); ?>
        <div class="input-group mb-3">
          <select id="pais" name="pais" class="form-control">
            <option value="0" disabled selected>Selecciona un pa&iacute;s</option>
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
        <?php echo ($validation->showError('pais','custom_error')); ?> 
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Ciudad" name="ciudad" value="<?php if (isset($ciudad)) {echo $ciudad;}?>">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-city"></span>
            </div>
          </div>
        </div>
        <?php echo ($validation->showError('ciudad','custom_error')); ?> 
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Tel&eacute;fono de contacto" name="telefono" value="<?php if (isset($telefono)) {echo $telefono;}?>">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-phone"></span>
            </div>
          </div>
        </div>
        <?php echo ($validation->showError('telefono','custom_error')); ?> 
          <!-- /.col -->
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Registrar</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
      <a href="login.html" class="text-center">Mi empresa ya est&aacute; registrada.</a>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->
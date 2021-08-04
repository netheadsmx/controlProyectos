  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-3">
            <h1 class="m-0">Colaboradores</h1>
          </div><!-- /.col -->
          <div class="col-sm-6" id="mensajes">

          </div>
          <div class="col-sm-3">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
              <li class="breadcrumb-item active">Colaboradores</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <section class="col-lg-12 connectedSortable">
            <div class="card">
              <div class="card-header">
                Colaboradores
              </div>
              <div class="card-body">
                <div style="margin-bottom:10px;">
                  <button type="button" class="btn btn-default" onclick="editarColabBtn()">Editar</button>
                  <button type="button" onclick="eliminarColabBtn()" class="btn btn-danger"><i class="fas fa-trash-alt"></i> Eliminar</button>
                </div>
                <table id="colabsTbl" class="table table-bordered table-hover" style="width:100%">
                  <thead>
                  <tr>
                    <td></td>
                    <td>Nombre</td>
                    <td>Correo</td>
                    <td>Tipo de Usuario</td>
                    <td>Estado</td>
                  </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="card">
              <div class="card-header">
                Solicitudes e Invitaciones
              </div>
              <div class="card-body">
                <div style="margin-bottom:10px;">
                  <button type="button" class="btn btn-success" onclick="invitarColabBtn();"><i class="fas fa-plus"></i> Invitar</button>
                  <button type="button" class="btn btn-primary" onclick="aceptarColabBtn();"><i class="fas fa-check"></i> Aceptar</button>
                  <button type="button" class="btn btn-danger" onclick="eliminarSolBtn()"><i class="fas fa-times-circle"></i> Rechazar</button>
                </div>
                <table id="solTbl" class="table table-bordered table-hover" style="width:100%">
                  <thead>
                  <tr>
                    <td></td>
                    <td>Nombre</td>
                    <td>Correo</td>
                    <td>Fecha de Solicitud</td>
                    <td>Tipo</td>
                  </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
              </div>
            </div>
          </section>
          <!-- right col -->
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

    <!-- INVITAR COLAB MODAL -->
    <div class="modal fade" id="addColabModal">
        <div class="modal-dialog modal-md">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Invitar a un Colaborador</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form>
                  <input type="hidden" id="idColab" name="idColab">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Nombre *</label>
                    <input type="email" class="form-control" id="addColabNombre" placeholder="Nombre Colaborador" required>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Apellido *</label>
                    <input type="email" class="form-control" id="addColabApellido" placeholder="Apellido Colaborador" required>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Correo Electr&oacute;nico *</label>
                    <input type="email" class="form-control" id="addColabCorreo" placeholder="Correo Colaborador" required>
                  </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
              <button type="button" class="btn btn-primary" onclick="addColab();">Enviar Invitaci&oacute;n</button>
            </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
  </div>
  <!-- FIN INVITAR COLAB MODAL -->

  <!-- EDITAR COLAB MODAL -->
  <div class="modal fade" id="editarColabModal">
        <div class="modal-dialog modal-md">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Editar Colaborador</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form>
              <input type="hidden" id="idColab" name="idColab">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Nombre</label>
                    <input type="email" class="form-control" id="editColabNombre" placeholder="Nombre Colaborador" disabled>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Correo Electr&oacute;nico</label>
                    <input type="email" class="form-control" id="editColabCorreo" placeholder="Correo Colaborador" disabled>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Estado</label>
                    <select class="custom-select" name="estado" id="estado">
                      <?php
                          foreach ($estados as $e) {
                              echo '<option id="estado_'.$e['idEstados'].'" value="'.$e['idEstados'].'">'.$e['nombre'].'</option>';
                          }
                      ?>
                    </select>
                  </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
              <button type="button" class="btn btn-primary" onclick="updateColab();">Guardar Cambios</button>
            </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
  </div>
      <!-- FIN EDITAR COLAB MODAL -->

      <!-- CONFIRMACION ACEPTAR SOLICITUDES MODAL -->
  <div class="modal fade" id="confirmarSolModal">
        <div class="modal-dialog modal-md">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Aceptar Solicitud</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <p id="confirmNum"></p>
                <p>Deseas continuar?</p>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
              <button type="button" class="btn btn-primary" onclick="aceptarSol();">Aceptar</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
  </div>
      <!-- FCONFIRMACION ACEPTAR SOLICITUDES MODAL -->

     <!-- CONFIRMACION ELIMINAR SOLICITUD MODAL -->
     <div class="modal fade" id="confirmarDelSolModal">
        <div class="modal-dialog modal-md">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Eliminar Solicitud</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <p id="eliminarNum"></p>
                <p>Deseas continuar?</p>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
              <button type="button" class="btn btn-danger" onclick="eliminarSol();">Eliminar</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
  </div>
      <!-- CONFIRMACION ELIMINAR SOLICITUD MODAL -->
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Colaboradores</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
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
          <section class="col-lg-6 connectedSortable">
            <div class="card">
              <div class="card-header">
                Colaboradores registrados
              </div>
              <div class="card-body">
              <form id="frm-example" method="POST">
                <div>
                  <button type="button" class="btn btn-primary"><i class="fas fa-plus"></i> Agregar</button>
                  <button type="button" class="btn btn-default">Editar</button>
                  <button type="button" onclick="eliminarBtn()" class="btn btn-default">Eliminar</button>
                </div>
                <table id="colabsTbl" class="table table-bordered table-hover" style="width:100%">
                  <thead>
                  <tr>
                    <td></td>
                    <td>Nombre</td>
                    <td>Rol</td>
                    <td>Correo</td>
                  </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
                </form>
              </div>
            </div>
          </section>
          <section class="col-lg-6 connectedSortable">
            <div class="card">
              <div class="card-header">
                Solicitudes pendientes
              </div>
              <div class="card-body">
                <h5 class="card-title">Special title treatment</h5>
                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
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
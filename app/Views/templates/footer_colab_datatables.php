<!-- jQuery -->
<script src="<?php echo site_url('assets/plugins/jquery/jquery.min.js');?>"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo site_url('assets/plugins/bootstrap/js/bootstrap.bundle.min.js');?>"></script>
<!-- DataTables  & Plugins -->
<script src="<?php echo site_url('assets/plugins/datatables/jquery.dataTables.min.js');?>"></script>
<script src="<?php echo site_url('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js');?>"></script>
<script src="<?php echo site_url('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js');?>"></script>
<script src="<?php echo site_url('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js');?>"></script>
<script src="<?php echo site_url('assets/plugins/datatables-buttons/js/dataTables.buttons.min.js');?>"></script>
<script src="<?php echo site_url('assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js');?>"></script>
<script src="<?php echo site_url('assets/plugins/jszip/jszip.min.js');?>"></script>
<script src="<?php echo site_url('assets/plugins/pdfmake/pdfmake.min.js');?>"></script>
<script src="<?php echo site_url('assets/plugins/pdfmake/vfs_fonts.js');?>"></script>
<script src="<?php echo site_url('assets/plugins/datatables-buttons/js/buttons.html5.min.js');?>"></script>
<script src="<?php echo site_url('assets/plugins/datatables-buttons/js/buttons.print.min.js');?>"></script>
<script src="<?php echo site_url('assets/plugins/datatables-buttons/js/buttons.colVis.min.js');?>"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
<!-- AdminLTE App --> 
<script src="<?php echo site_url('assets/dist/js/adminlte.min.js');?>"></script>
<!-- AdminLTEdemo purposes -->
<script src="<?php echo site_url('assets/dist/js/demo.js');?>"></script>
<!-- Page specific script -->

<!-- Checks -->
<script type="text/javascript" src="//gyrocode.github.io/jquery-datatables-checkboxes/1.2.12/js/dataTables.checkboxes.min.js"></script>

<!-- Datetime -->
<script type="text/javascript" src="//cdn.datatables.net/plug-ins/1.10.25/dataRender/datetime.js"></script>
<script type="text/javascript" src="<?php echo site_url('/assets/plugins/moment/moment.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo site_url('/assets/plugins/moment/locale/es-mx.js')?>"></script>

<script>
  
$(document).ready(function() {
  colabsTbl();
  solicitudesTbl();
  moment.locale('es');
});

  function colabsTbl() {
    tableColabs = $("#colabsTbl").DataTable({
      "ajax": {
        url: "<?php echo site_url('/dashboard/colabs/getColabs');?>",
        type: "POST",
        dataSrc: ""
      },
      "columns": [
        {
            'data': 'idColaboradores',
            'checkboxes': {
               'selectRow': true
            }
         },
        {"data": "nombre_colab",
          "render": function(data, type, row) {
            return data +' '+ row.apellido_colab;
          }
        },
        {"data": "correo_colab",
          "render": function (data, type, row) {
            return '<a href="mailto:'+data+'">'+data+'</a>'
          }
        },
        {"data": "nombre_tipousuario"},
        {"data": "Estados_idEstados",
          "render" : function (data,type,row) {
            if (data==1) {
              return '<i class="fas fa-check-circle" style="color:green;"></i> Activo'
            } else if (data==2) {
              return '<i class="fas fa-clock" style="color:gray;"></i> Pendiente'
            } else if (data==3) {
              return '<i class="fas fa-pause-circle" style="color:orange;"></i> Deshabilitado'
            } 
          }
        }
      ],
      responsive : true,
      autoWidth : false,
      language : {
        url: "https://cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json"
      },
    });
}

function solicitudesTbl() {
    tableSol = $("#solTbl").DataTable({
      "ajax": {
        url: "<?php echo site_url('/dashboard/colabs/getSolicitudes');?>",
        type: "POST",
        dataSrc: ""
      },
      "columns": [
        {
            'data': 'idSolicitudes',
            'checkboxes': {
               'selectRow': true
            }
         },
        {"data": "nombre_sol",
          "render": function(data, type, row) {
            return data +' '+ row.apellido_sol;
          }
        },
        {"data": "correo_sol",
          "render": function (data, type, row) {
            return '<a href="mailto:'+data+'">'+data+'</a>'
          }
        },
        {"data": "fecha_sol"},
        {"data":"tipo",
          "render": function (data,type,row){
            if(data=='S') {
              return 'Solicitud'
            } else if (data == 'I') {
              return 'Invitaci&oacute;n'
            }
          }
        }
      ],
      "columnDefs":[
        {
          targets:3, render:function(data)
          {
            return moment(data).format('MMMM Do YYYY');
          }
        }
      ],
      responsive : true,
      autoWidth : false,
      language : {
        url: "https://cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json"
      },
    });
}

function eliminarColabBtn() {
  var elementos = getColabsSelected();
  if (elementos.length == 0) {
    document.getElementById("mensajes").innerHTML = "<div class='alert alert-warning alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><h5><i class='icon fas fa-exclamation-triangle'></i> Alert!</h5>Se debe de seleccionar al menos un colaborador.</div>";
  } else {
    document.getElementById("mensajes").innerHTML = "";
    $("#confirmarDelColabModal").modal("show");
  }
}

function invitarColabBtn() {
  $("#addColabModal").modal("show");
}

function editarColabBtn() {
  var elementos = getColabsSelected();
  if (elementos.length == 0) {
    document.getElementById("mensajes").innerHTML = "<div class='alert alert-warning alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><h5><i class='icon fas fa-exclamation-triangle'></i> Alert!</h5>Se debe de seleccionar a un colaborador.</div>";
  } else if (elementos.length > 1) {
    document.getElementById("mensajes").innerHTML = "<div class='alert alert-warning alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><h5><i class='icon fas fa-exclamation-triangle'></i> Alert!</h5>Se debe de editar un colaborador a la vez.</div>";
  } else {
    document.getElementById("mensajes").innerHTML = "";
    $.ajax ({
      type : "POST",
      url: "<?php echo site_url('/dashboard/colabs/getColabxId');?>",
      dataType: "json",
      data: {colabId:elementos[0]},
      success: function (result) {
        var nombrecolab = result[0]['nombre_colab'] +' '+result[0]['apellido_colab'];
        var correo = result[0]['correo_colab'];
        var estado = 'estado_'+result[0]['Estados_idEstados'];
        var tipo = 'tipo_'+result[0]['TipoUsuarios_idTipoUsuarios'];
        var idColab = result[0]['idColaboradores'];
        document.getElementById("idColab").value = idColab;
        document.getElementById("editColabNombre").value = nombrecolab;
        document.getElementById("editColabCorreo").value = correo;
        document.getElementById(tipo).selected = true;
        document.getElementById(estado).selected = true;
        if (result[0]['activado'] == 1) {
          document.getElementById("estado_2").disabled = true;
        }
        $("#editarColabModal").modal("show");
      },
      error: function (error) {
        $("#editarColabModal").modal("hide");
        document.getElementById("mensajes").innerHTML = "<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><h5><i class='icon fas fa-exclamation-triangle'></i> Error!</h5>Se ha presentado un error, favor de intentarlo mas tarde.</div>";
      }
    });
  }
}

function updateColab() {
  var id = document.getElementById("idColab").value; ;
  var estado = document.getElementById("estado").value; ;
  $.ajax ({
      type : "POST",
      url: "<?php echo site_url('/dashboard/colabs/updateColabxId');?>",
      dataType: "json",
      data: {colabId:id, estadoId:estado},
      success: function (result) {
        $("#editarColabModal").modal("hide");
        $('#colabsTbl').DataTable().ajax.reload();
      },
      error: function (error) {
        $("#editarColabModal").modal("hide");
        document.getElementById("mensajes").innerHTML = "<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><h5><i class='icon fas fa-exclamation-triangle'></i> Error!</h5>Se ha presentado un error, favor de intentarlo mas tarde.</div>";
      }
    });
}

function getColabsSelected() {
  var form = this;
  var rows_selected = tableColabs.column(0).checkboxes.selected();
  // Iterate over all selected checkboxes
  var elements = [];
  $.each(rows_selected, function(index, rowId){
    // Create a hidden element
    elements.push(rowId);
  });
  return elements;
}

function getSolsSelected() {
  var form = this;
  var rows_selected = tableSol.column(0).checkboxes.selected();
  // Iterate over all selected checkboxes
  var elements = [];
  $.each(rows_selected, function(index, rowId){
    // Create a hidden element
    elements.push(rowId);
  });
  return elements;
}

function addColab() {
  var nombre = document.getElementById("addColabNombre").value;
  var apellido = document.getElementById("addColabApellido").value;
  var correo = document.getElementById("addColabCorreo").value;
  $.ajax ({
      type : "POST",
      url: "<?php echo site_url('/dashboard/colabs/validarDatosInvitacion');?>",
      dataType: "json",
      data: {nombre:nombre, apellido:apellido,correo:correo},
      success: function (result) {
        $("#addColabModal").modal("hide");
        var texto = "";
        if (result['result'] == false) {
          for (var id in result['errors']) {
            texto += "<p>"+ result['errors'][id]+ "</p>"
          }
          document.getElementById("mensajes").innerHTML = "<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><h5><i class='icon fas fa-exclamation-triangle'></i> Error!</h5>"+texto+"</div>";
        } else {
          document.getElementById("mensajes").innerHTML = "<div class='alert alert-success alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><h5><i class='icon fas fa-exclamation-triangle'></i>Bien!</h5>Se ha enviado la invitaci&oacute;n con &eacute;xito</div>";
        }
        $('#solTbl').DataTable().ajax.reload();
      },
      error: function (error) {
        $("#addColabModal").modal("hide");
        document.getElementById("mensajes").innerHTML = "<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><h5><i class='icon fas fa-exclamation-triangle'></i> Error!</h5>Se ha presentado un error, favor de intentarlo mas tarde.</div>";
      }
    });  
}

function aceptarColabBtn()
{
  var aceptados = getSolsSelected();
  limpiar_mensajes();
  if (aceptados == 0) {
    document.getElementById("mensajes").innerHTML = "<div class='alert alert-warning alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><h5><i class='icon fas fa-exclamation-triangle'></i> Alert!</h5>Se debe de seleccionar a una solicitud.</div>";
  } else if (aceptados.length == 1) {
    document.getElementById("confirmNum").innerHTML = "Se aceptara una solicitud.";
    $("#confirmarSolModal").modal("show");
  } else if (aceptados.length > 1) {
    document.getElementById("confirmNum").innerHTML = "Se aceptaran "+aceptados.length+" solicitudes.";
    $("#confirmarSolModal").modal("show");
  }
}

function aceptarSol() {
  var aceptados = getSolsSelected();
  var tipocolab = parseInt(document.getElementById("colabselected").value);
  $("#confirmarSolModal").modal("hide");
  $.ajax ({
      type : "POST",
      url: "<?php echo site_url('/dashboard/colabs/aceptarSolicitudes');?>",
      dataType: "json",
      data: {solicitudes:aceptados,colab:tipocolab},
      success: function (result) {
        if (result['error'] == false) {
          $("#confirmarSolModal").modal("hide");
          $('#solTbl').DataTable().ajax.reload();
          $('#colabsTbl').DataTable().ajax.reload();
          document.getElementById("mensajes").innerHTML = "<div class='alert alert-success alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><h5><i class='icon fas fa-exclamation-triangle'></i>Bien!</h5>Se han aceptado las solicitudes con &eacute;xito.</div>";
        } else {
          document.getElementById("mensajes").innerHTML = "<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><h5><i class='icon fas fa-exclamation-triangle'></i> Error!</h5>"+result['descripcion']+"</div>";
        }
      },
      error: function (error) {
        $("#confirmarSolModal").modal("hide");
        document.getElementById("mensajes").innerHTML = "<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><h5><i class='icon fas fa-exclamation-triangle'></i> Error!</h5>Se ha presentado un error, favor de intentarlo mas tarde.</div>";
      }
    });
}

function eliminarSolBtn()
{
  var aceptados = getSolsSelected();
  if (aceptados.length == 1) {
    document.getElementById("eliminarNum").innerHTML = "Se eliminar&aacute; una solicitud.";
  } else if (aceptados.length > 1) {
    document.getElementById("eliminarNum").innerHTML = "Se eliminar&aacute;n "+aceptados.length+" solicitudes.";
  }
  $("#confirmarDelSolModal").modal("show");
}

function eliminarSol()
{
  var eliminados = getSolsSelected();
  $("#confirmarDelSolModal").modal("hide");
  $.ajax ({
      type : "POST",
      url: "<?php echo site_url('/dashboard/colabs/eliminarSolicitudes');?>",
      dataType: "json",
      data: {eliminar:eliminados},
      success: function (result) {
        if (result['error'] == false) {
          $('#solTbl').DataTable().ajax.reload();
          document.getElementById("mensajes").innerHTML = "<div class='alert alert-success alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><h5><i class='icon fas fa-exclamation-triangle'></i>Bien!</h5>Se han eliminado las solicitudes con &eacute;xito.</div>";
        } else {
          document.getElementById("mensajes").innerHTML = "<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><h5><i class='icon fas fa-exclamation-triangle'></i> Error!</h5>"+result['descripcion']+"</div>";
        }
      },
      error: function (error) {
        document.getElementById("mensajes").innerHTML = "<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><h5><i class='icon fas fa-exclamation-triangle'></i> Error!</h5>Se ha presentado un error, favor de intentarlo mas tarde.</div>";
      }
    });
}

function limpiar_mensajes ()
{
  document.getElementById("mensajes").innerHTML = "";
}

function eliminarColab()
{
  var elementos = getColabsSelected();
  $.ajax ({
      type : "POST",
      url: "<?php echo site_url('/dashboard/colabs/eliminarColaborador');?>",
      dataType: "json",
      data: {eliminar:elementos},
      success: function (result) {
        $("#confirmarDelColabModal").modal("hide");
        if (result['error'] == false) {
          $('#colabsTbl').DataTable().ajax.reload();
          document.getElementById("mensajes").innerHTML = "<div class='alert alert-success alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><h5><i class='icon fas fa-exclamation-triangle'></i>Bien!</h5>Se han eliminado colaboradores con &eacute;xito.</div>";
        } else {
          document.getElementById("mensajes").innerHTML = "<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><h5><i class='icon fas fa-exclamation-triangle'></i> Error!</h5>"+result['descripcion']+"</div>";
        }
      },
      error: function (error) {
        document.getElementById("mensajes").innerHTML = "<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><h5><i class='icon fas fa-exclamation-triangle'></i> Error!</h5>Se ha presentado un error, favor de intentarlo mas tarde.</div>";
      }
    });
}

</script>
</body>
</html>

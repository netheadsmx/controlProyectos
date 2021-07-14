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

<!-- PRUEBAS -->
<script type="text/javascript" src="//gyrocode.github.io/jquery-datatables-checkboxes/1.2.12/js/dataTables.checkboxes.min.js"></script>

<script>
  
$(document).ready(function() {
  colabsTbl();
  
});

  function colabsTbl() {
    table = $("#colabsTbl").DataTable({
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
        {"data": "nombre_rol"},
        {"data": "correo_colab",
          "render": function (data, type, row) {
            return '<a href="mailto:'+data+'">'+data+'</a>'
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

function eliminarBtn() {
  var elementos = getSelected();
  console.log(elementos);
}

function getSelected() {
  var form = this;
  var rows_selected = table.column(0).checkboxes.selected();
  // Iterate over all selected checkboxes
  var elements = [];
  $.each(rows_selected, function(index, rowId){
    // Create a hidden element
    elements.push(rowId);
  });
  return elements;
}
  
</script>
</body>
</html>

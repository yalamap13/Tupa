var tabla;

$(document).ready(function() {
	tabla = $("#LlenarTabla").DataTable({
		"ajax": "Funcionalidad/UnidadOrganica/Listar.php",
            "order": [[ 1, "asc" ]],
            pageLength: 9,
            "columnDefs": 
              [
                { "width": "0.1%", "targets": 0 , "orderable": false },
                { "width": "0.1%", "targets": 1 },
                { "width": "0.50%", "targets": 2 },
                { "width": "5%", "targets": 3 },
                { "width": "0.10%", "targets": 4 },
                { "width": "0.10%", "targets": 5 }
              ],
            responsive: true,
		pagingType: "full_numbers",
		"language":
        {
            "decimal": ",",
            "thousands": ".",
            "emptyTable":     "No hay datos disponibles en la tabla",
            "info":           "Mostrando de _START_ a _END_ de _TOTAL_ entradas",
            "infoEmpty":      "Mostrando de 0 a 0 de 0 entradas",
            "infoFiltered":   "(Filtrando de _MAX_ filas totales)",
            "infoPostFix":    "",
            "thousands":      ",",
            "lengthMenu":     "&nbsp;&nbsp; Filas <html></html>: &nbsp; _MENU_",
            "loadingRecords": "Cargando...",
            "processing":     "Procesando...",
            "search":         "Buscar <html></i></html>:",
            "searchPlaceholder": "Buscar...",
            "zeroRecords":    "No se encontraron registros coincidentes",
            "paginate": {
            "first":      "primero",
            "last":       "último",
            "next":       "siguiente",
            "previous":   "anterior"
         },
      	"order": []
	}});
	
	tabla.on( 'order.dt search.dt', function () {
        tabla.column(1, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();
});

function Estado(id = null) {
      if(id) { 
                  $.ajax({
                        url: 'Funcionalidad/UnidadOrganica/Estado.php',
                        type: 'post',
                        data: {TransferirId : id},
                        dataType: 'json',
                        success:function(response) {
                              if(response.success == true) {                                          
                                    tabla.ajax.reload(null, false);
                              } else {                
                              }}
                  });
      } else {
            alert('Error Al Refrescar Pagina');
}}

function Crear() {
            $("#TransferirId").remove();
            $.ajax({
                  url: 'Funcionalidad/UnidadOrganica/Llamar.php',
                  type: 'post',
                  data: {},
                  dataType: 'json',
                  success:function(response) {
                        $("#TransferirYear").val(response.Year);
                        $(".AbrirModal").append('<input type="hidden" name="TransferirId" id="TransferirId" value=""/>');
                        $("#Formulario").unbind('submit').bind('submit', function() {
                                    var Aplicar = $(this);
                                    $.ajax({
                                    url: Aplicar.attr('action'),
                                    type: Aplicar.attr('method'),
                                    data: Aplicar.serialize(),
                                    dataType: 'json',
                                    success:function(response) {
                                    if(response.success == true) {
                                          $("#Formulario")[0].reset();         
                                          $('#AbrirModal').modal('hide');
                                          tabla.ajax.reload(null, false);
                                          sweetAlert("Nuevo Registro!", "Nuevo Registro Correctamente...", "success");                                                        
                                    } else {
                                          sweetAlert("Error al Crear Registro!", "Error", "warning");
                                    }} 
                              }); 
                        return false;
                  });
            }}); 
}

function Actualizar(id = null) {
      if(id) {
            $("#TransferirId").remove();
            $.ajax({
                  url: 'Funcionalidad/UnidadOrganica/Llamar.php',
                  type: 'post',
                  data: {TransferirId : id},
                  dataType: 'json',
                  success:function(response) {
                        $("#TransferirYear").val(response.Year);
                        $("#TransferirDenominacion").val(response.Denominacion);
                        $("#TransferirIniciales").val(response.Iniciales);
                        $(".AbrirModal").append('<input type="hidden" name="TransferirId" id="TransferirId" value="'+response.IdUnidadOrganica+'"/>');
                        $("#Formulario").unbind('submit').bind('submit', function() {
                                    var Aplicar = $(this);
                                    $.ajax({
                                    url: Aplicar.attr('action'),
                                    type: Aplicar.attr('method'),
                                    data: Aplicar.serialize(),
                                    dataType: 'json',
                                    success:function(response) {
                                    if(response.success == true) {
                                          $("#Formulario")[0].reset();         
                                          $('#AbrirModal').modal('hide');
                                          tabla.ajax.reload(null, false);
                                          sweetAlert("Actualización!", "Actualizo Correctamente...", "success")                                                           
                                    } else {
                                          sweetAlert("Error al Actualizar!", "Error", "warning")
                                    }} 
                              }); 
                        return false;
                  });
            }}); 
      } else {
            alert('Error Al Refrescar Pagina');
      }
}
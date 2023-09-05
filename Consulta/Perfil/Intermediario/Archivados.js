var tabla;

$(document).ready(function() {

	tabla = $("#LlenarTabla").DataTable({
		"ajax": "Funcionalidad/Expediente/ListarArchivados.php",
        "order": [ 1, "desc" ],
        pageLength: 9,
        dom: 'fBtip',
        responsive: true,
        buttons: [{
            extend: 'excelHtml5',
            text: '<i class="fa fa-file-excel-o fa-fw fa-1x boton-exportar"></i> Exportar',
            titleAttr: 'Excel',
            exportOptions: {
                columns: [0, 1, 2, 3 , 4, 5]
            }
        }],
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
            "last":       "ultimo",
            "next":       "siguiente",
            "previous":   "anterior"
         },
      	"order": []
	}});
});

function Estado(id = null) {
      if(id) { 
                  $.ajax({
                        url: 'Funcionalidad/Expediente/Estado.php',
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

function QuitarRequisito(IdExpedienteRequisito = null) {
      if(IdExpedienteRequisito) { 
                  $.ajax({
                        url: 'Funcionalidad/Expediente/QuitarRequisito.php',
                        type: 'post',
                        data: {TransladarIdExpedienteRequisito : IdExpedienteRequisito},
                        dataType: 'json',
                        success:function(response) {
                              if(response.success == true) {     
                                  tablarequisito.ajax.reload(null, false);  
                              } else {                
                              }}
                  });
      } else {
            sweetAlert("Error al quitar Proveedor!", "Error", "warning");
}};

function LlamarRequisito(Codigo = null) {
                  $.ajax({
                        url: 'Funcionalidad/Expediente/LlamarRequisito.php',
                        type: 'post',
                        data: {TransferirCodigo : Codigo},
                        dataType: 'json',
                        success:function(response) {
                              if(response.success == true) {   
                                    $(".RefrescarRequerimiento").load('Funcionalidad/Expediente/RefrescarRequisito.php');    
                              } else {                
                              }}
                  });
 };
 
function Crear(id = null) {
                $("#Formulario")[0].reset();
                $("#TransferirId").val(id);
                $('#Formulario').unbind('submit').bind('submit', function() {
                    var Aplicar = $(this);
                    $.ajax({
                    url: Aplicar.attr('action'),
                    type: Aplicar.attr('method'),
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response == '0') {
                            $('#Formulario')[0].reset();
                            $('#AbrirModal').modal('hide');
                            tabla.ajax.reload(null, false);
                            sweetAlert("Expediente!", "Expediente Creado Correctamente...", "success");
                        } else {
                            $('#Formulario')[0].reset();
                            $('#AbrirModal').modal('hide');
                            sweetAlert("Error al Crear Expediente o Datos Invalidos!", "Error", "warning");
                        }
                    }});
                    return false;
                });
}

function Derivar(id = null) {
      if(id) {
            $("#TransferirId").remove();
            $.ajax({
                  url: 'Funcionalidad/Expediente/Llamar.php',
                  type: 'post',
                  data: {TransferirId : id},
                  dataType: 'json',
                  success:function(response) {
                        $("#TransferirNombre").val(response.Nombre);
                        $("#TransferirUIT").val(response.UIT);
                        $(".AbrirModalDerivar").append('<input type="hidden" name="TransferirId" id="TransferirId" value="'+response.IdExpediente+'"/>');
                        $("#FormularioDerivar").unbind('submit').bind('submit', function() {
                                    var Aplicar = $(this);
                                    $.ajax({
                                    url: Aplicar.attr('action'),
                                    type: Aplicar.attr('method'),
                                    data: Aplicar.serialize(),
                                    dataType: 'json',
                                    success:function(response) {
                                    if(response.success == true) {
                                          $("#FormularioDerivar")[0].reset();         
                                          $('#AbrirModalDerivar').modal('hide');
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

function Requisito(id = null) {

         $("#LlenarTablaRequisito").dataTable().fnDestroy();
        
        	tablarequisito = $("#LlenarTablaRequisito").DataTable({
        	'ajax' : {
            'url' : 'Funcionalidad/Expediente/ListarExpedienteRequisito.php',
            'data' : {TransferirId : id},
            'type' : 'post'
            },
            order: [[ 1, "desc" ]],
            dom: 'fltip',
            pageLength: 9,
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
                    "search":         "Buscar <html></html>:",
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
	        $("#TransferirIdRequisito").val('');
            $("#TransferirIdRequisito").selectpicker("refresh");
            $("#TransferirIdRQ").remove();
            $.ajax({
                  url: 'Funcionalidad/Expediente/LlamarRequisito.php',
                  type: 'post',
                  data: {TransferirId : id},
                  dataType: 'json',
                  success:function(response) {
                        $("#TransferirNombreRQ").val(response.Nombre);
                        $("#TransferirUITRQ").val(response.UIT);
                        $("#TransferirValorRQ").val(response.Valor);
                        $("#TransferirDiasTramiteRQ").val(response.DiasTramite);
                        $("#TransferirIdOficinaRQ").val(response.IdOficina);
                        $("#TransferirIdTupaRQ").val(response.IdTupa);
                        $("#TransferirIdRQM").val(response.IdExpediente);
                        $(".AbrirModalRequisito").append('<input type="hidden" name="TransferirIdRQ" id="TransferirIdRQ" value="'+response.IdExpediente+'"/>');
                        $("#FormularioRequisito").unbind('submit').bind('submit', function() {
                                    var Aplicar = $(this);
                                    $.ajax({
                                    url: Aplicar.attr('action'),
                                    type: Aplicar.attr('method'),
                                    data: Aplicar.serialize(),
                                    dataType: 'json',
                                    success:function(response) {
                                    if(response.success == true) {    
                                          tablarequisito.ajax.reload(null, false);            
                                          $("#TransferirIdRequisito").val('');
                                          $("#TransferirIdRequisito").selectpicker("refresh");
                                    } else {
                                          sweetAlert("Error al Insertar Requisito!", "Error", "warning")
                                    }} 
                              }); 
                        return false;
                  });
            }}); 
}

function GuardarArchivo(Id = null) {
                $("#FormularioArchivo")[0].reset();
                $("#TransferirId").val(Id);
                $('#FormularioArchivo').unbind('submit').bind('submit', function() {
                    var Aplicar = $(this);
                    $.ajax({
                    url: Aplicar.attr('action'),
                    type: Aplicar.attr('method'),
                    data: new FormData(this),
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                            $('#FormularioArchivo')[0].reset();
                            $('#AbrirModalArchivo').modal('hide');
                            tabla.ajax.reload(null, false);
                            sweetAlert("Archivo!", "Nuevo Archivo Registrado...", "success");
                    }});
                    return false;
                });
}
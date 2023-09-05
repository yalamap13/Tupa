var tabla;
var tablarequisito;

$(document).ready(function() {

	tabla = $("#LlenarTabla").DataTable({
		"ajax": "Funcionalidad/Procedimiento/Listar.php",
        "order": [[ 1, "desc" ]],
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
            "search":         "Buscar <html></i></html>:",
            "searchPlaceholder": "Buscar...",
            "zeroRecords":    "No se encontraron registros coincidentes",
            "paginate": {
            "first":      "primero",
            "last":       "煤ltimo",
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
                        url: 'Funcionalidad/Procedimiento/Estado.php',
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

function QuitarRequisito(IdProcedimientoRequisito = null) {
      if(IdProcedimientoRequisito) { 
                  $.ajax({
                        url: 'Funcionalidad/Procedimiento/QuitarRequisito.php',
                        type: 'post',
                        data: {TransladarIdProcedimientoRequisito : IdProcedimientoRequisito},
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
                        url: 'Funcionalidad/Procedimiento/LlamarRequisito.php',
                        type: 'post',
                        data: {TransferirCodigo : Codigo},
                        dataType: 'json',
                        success:function(response) {
                              if(response.success == true) {   
                                    $(".RefrescarRequerimiento").load('Funcionalidad/Procedimiento/RefrescarRequisito.php');    
                              } else {                
                              }}
                  });
 };
 
function Crear() {
            $("#Formulario")[0].reset();
            $("#TransferirId").remove();
            $.ajax({success:function(response) {
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
                                    sweetAlert("Error al Crear!", "Error", "warning")
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
                  url: 'Funcionalidad/Procedimiento/Llamar.php',
                  type: 'post',
                  data: {TransferirId : id},
                  dataType: 'json',
                  success:function(response) {
                        $("#TransferirNombre").val(response.Nombre);
                        $("#TransferirUIT").val(response.UIT);
                        $("#TransferirValor").val(response.Valor);
                        $("#TransferirDiasTramite").val(response.DiasTramite);
                        $("#TransferirIdOficina").val(response.IdOficina);
                        $("#TransferirIdTupa").val(response.IdTupa);
                        $("#TransferirDerechoTramite").val(response.DerechoTramite);
                        $(".AbrirModal").append('<input type="hidden" name="TransferirId" id="TransferirId" value="'+response.IdProcedimiento+'"/>');
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

function FiltrarUIT() {
            var id = document.getElementById("TransferirIdTupa").value;    
            $.ajax({
                  url: 'Funcionalidad/Tupa/Llamar.php',
                  type: 'post',
                  data: {TransferirId : id},
                  dataType: 'json',
                  success:function(response) {
                        $("#TransferirUIT").val(response.UIT);
            }}); 
}

function CalcularValorUp() {

            var a = document.getElementById("TransferirUIT").value; 
            var b = document.getElementById("TransferirDerechoTramite").value;
            var c = document.getElementById("TransferirValor").value;
            var d = a*b;
            
            if(c == '') {
                $("#TransferirValor").val(0);   
            } else {
                $("#TransferirValor").val(d);   
            }
            
}

function CalcularValor(e, field) {
              key = e.keyCode ? e.keyCode : e.which
              // backspace
              if (key == 8) return true
              // 0-9
              if (key > 47 && key < 58) {
                if (field.value == "") return true
                regexp = /.[0-9]{12}$/
                return !(regexp.test(field.value))
              }
              // .
              if (key == 46) {
                if (field.value == "") return false
                regexp = /^[0-9]+$/
                return regexp.test(field.value)
              }
              // other key

            var a = document.getElementById("TransferirUIT").value; 
            var b = document.getElementById("TransferirDerechoTramite").value;
            var c = a*b;
            $("#TransferirValor").val(c);
            
            return false
}

function Requisito(id = null) {

         $("#LlenarTablaRequisito").dataTable().fnDestroy();
        
        	tablarequisito = $("#LlenarTablaRequisito").DataTable({
        	'ajax' : {
            'url' : 'Funcionalidad/Procedimiento/ListarProcedimientoRequisito.php',
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
                  url: 'Funcionalidad/Procedimiento/LlamarRequisito.php',
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
                        $("#TransferirIdRQM").val(response.IdProcedimiento);
                        $(".AbrirModalRequisito").append('<input type="hidden" name="TransferirIdRQ" id="TransferirIdRQ" value="'+response.IdProcedimiento+'"/>');
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
                                          sweetAlert("Error al Insertar Requisito o requisito ya existe!", "Error", "warning")
                                    }} 
                              }); 
                        return false;
                  });
            }}); 
}
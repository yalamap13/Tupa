var tabla;

$(document).ready(function() {
	tabla = $("#LlenarTabla").DataTable({
		"ajax": "Funcionalidad/Tupa/Listar.php",
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
});

function Estado(id = null) {
      if(id) { 
                  $.ajax({
                        url: 'Funcionalidad/Tupa/Estado.php',
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
                $("#Formulario")[0].reset();
                Archivo = document.getElementById("DivArchivo");
                Archivo.style.display = "";
                $('#Formulario').unbind('submit').bind('submit', function() {
                    var Aplicar = $(this);
                    $.ajax({
                    url: Aplicar.attr('action'),
                    type: Aplicar.attr('method'),
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    success: function(response) {
                            $('#Formulario')[0].reset();
                            $('#AbrirModal').modal('hide');
                            tabla.ajax.reload(null, false);
                            sweetAlert("Nuevo Registro!", "Nuevo Registro Correctamente...", "success");
                    }});
                    return false;
                });
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

function Actualizar(id = null) {
      if(id) {
            $("#TransferirId").remove();
            $.ajax({
                  url: 'Funcionalidad/Tupa/Llamar.php',
                  type: 'post',
                  data: {TransferirId : id},
                  dataType: 'json',
                  success:function(response) {
                        $("#TransferirYear").val(response.Year);
                        $("#TransferirDenominacion").val(response.Denominacion);
                        $("#TransferirUIT").val(response.UIT);
                        $("#TransferirResolucion").val(response.Resolucion);
                        Archivo = document.getElementById("DivArchivo");
                        Archivo.style.display = "none";
                        $(".AbrirModal").append('<input type="hidden" name="TransferirId" id="TransferirId" value="'+response.IdTupa+'"/>');
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
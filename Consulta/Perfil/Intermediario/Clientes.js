var tabla;

$(document).ready(function() {
	tabla = $("#LlenarTabla").DataTable({
		"ajax": "Funcionalidad/Clientes/Listar.php",
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
	
	tabla.on( 'order.dt search.dt', function () {
        tabla.column(1, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();
});

function Estado(id = null) {
      if(id) { 
                  $.ajax({
                        url: 'Funcionalidad/Clientes/Estado.php',
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
            $("#Formulario")[0].reset();
            $("#TransferirId").remove();
            document.querySelector('#NombreRazonSocial').innerText = 'Nombres';
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
                                    sweetAlert("Error al Crear!", "Error", "warning");
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
                  url: 'Funcionalidad/Clientes/Llamar.php',
                  type: 'post',
                  data: {TransferirId : id},
                  dataType: 'json',
                  success:function(response) {
                      
                        $("#TransferirNumeroDocumento").val(response.NumeroDocumento);
                        $("#TransferirNombres").val(response.Nombres);
                        $("#TransferirApellidos").val(response.Apellidos);
                        $("#TransferirSexo").val(response.Sexo);
                        $("#TransferirCelular").val(response.Celular);
                        $("#TransferirTelefono").val(response.Telefono);
                        $("#TransferirDireccion").val(response.Direccion);
                        $("#TransferirCorreoElectronico").val(response.CorreoElectronico);
                        $("#TransferirIdTipoDocumento").val(response.IdTipoDocumento);
                        $("#TransferirResponsable").val(response.Responsable);
                        
                        if (response.Documento == 'RUC') {
                           diva = document.getElementById("divApellido");
                           divs = document.getElementById("divSexo");
                           divn = document.getElementById("inpNumDoc");
                           divr = document.getElementById("inpRuc");
                           divr = document.getElementById("inpRuc");
                           divp = document.getElementById("divResponsable");
                           diva.style.display = "none";
                           divs.style.display = "none";
                           divn.style.display = "none";
                           divr.style.display = "";
                           divp.style.display = "";
                           document.querySelector('#NombreRazonSocial').innerText = 'Razón Social';
                        } else {
                            diva = document.getElementById("divApellido");
                            divs = document.getElementById("divSexo");
                            divn = document.getElementById("inpNumDoc");
                            divr = document.getElementById("inpRuc");
                            divp = document.getElementById("divResponsable");
                            diva.style.display = "";
                            divs.style.display = "";
                            divn.style.display = "";
                            divr.style.display = "none";
                            divp.style.display = "none";
                            document.querySelector('#NombreRazonSocial').innerText = 'Nombres';
                        }
                        
                        
                        $(".AbrirModal").append('<input type="hidden" name="TransferirId" id="TransferirId" value="'+response.IdCliente+'"/>');
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
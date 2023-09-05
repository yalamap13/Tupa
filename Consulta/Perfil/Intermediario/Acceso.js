function IngresoClick(){
            var Usuario = $('#Usuario').val();
            var Clave = $('#Clave').val();
            $.ajax({
                url:'Consulta/Usuario/IniciarUsuario.php',
                type:'Post',
                data:'Usuario='+Usuario+'&Clave='+Clave+"&Boton=Ingresar"
            }).done(function(Respuesta){
                            if ($('#Usuario').val()==''){
                                sweetAlert("Usuario Vacio", "Ingresar Usuario!", "warning");
                                session_destroy();
                            }else if ($('#Clave').val()==''){
                                sweetAlert("Clave Vacia", "Ingresar Clave!", "warning"); 
                                session_destroy();
                            }else if(Respuesta == "Denegado"){
                                sweetAlert("Usuario/Clave no Validos!", "Usuario/Clave Incorrectos", "warning") 
                                session_destroy();                                
                            }else if(Respuesta == "Concedido"){
                                sweetAlert.close()
                                sweetAlert.closeModal()
                                location.href='Consulta/Perfil/'; 
                            }
});
}

function IngresoEnter(e) {
            if (e.keyCode == 13) {
            var Usuario = $('#Usuario').val();
            var Clave = $('#Clave').val();
            $.ajax({
                url:'Consulta/Usuario/IniciarUsuario.php',
                type:'Post',
                data:'Usuario='+Usuario+'&Clave='+Clave+"&Boton=Ingresar"
            }).done(function(Respuesta){
                            if ($('#Usuario').val()==''){
                                sweetAlert("Usuario Vacio", "Ingresar Usuario!", "warning");
                                session_destroy();
                            }else if ($('#Clave').val()==''){
                                sweetAlert("Clave Vacia", "Ingresar Clave!", "warning"); 
                                session_destroy();
                            }else if(Respuesta == "Denegado"){
                                sweetAlert("Usuario/Clave no Validos!", "Usuario/Clave Incorrectos", "warning") 
                                session_destroy();                                
                            }else if(Respuesta == "Concedido"){
                                sweetAlert.close()
                                sweetAlert.closeModal()
                                location.href='Consulta/Perfil/'; 
                            }
});
}}

function CerrarPerfil()
{
    $.ajax({
            url:'../Usuario/CerrarUsuario.php',
            type:'Post',
            data:'Salida=SalirPerfil'
    }).done(function(Respuesta){
               location.href='../../'
    });
}
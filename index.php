<!DOCTYPE html>
<html lang="en">

<?php
include 'Etiqueta/Encabezado.php';
?>

 <body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper auth-page">
      <div class="content-wrapper d-flex align-items-center auth auth-bg-1 theme-one" 
      style="background:-webkit-linear-gradient(left, #292825, #277595, var(--gray-dark));">
        <div class="row w-100">
          <div class="col-lg-3 mx-auto">
            <div class="auto-form-wrapper" style="display:inline-block;zoom:97%;">
               <form class="form-horizontal" onkeypress="IngresoEnter(event); return true;" method="Post" id="Formulario" name="Formulario">
                <img src="Recurso/img/Captura1.JPG" 
                style="zoom:45%;margin-top:-45px;margin-bottom: 25px;margin-left: -8px;text-align: center;"/>
                <div class="form-group">
                  <label class="label">Usuario</label>
                  <div class="input-group">
                    <div class="input-group-append">
                      <span class="input-group-text" style="border:1px solid #dadada;border-radius:0px;padding:10px;">
                        <i class="mdi mdi-account-box"></i>
                      </span>
                    </div>                    
                    <input type="text" class="form-control" style="border:1px solid #e4e4e4;border-radius:0px;text-transform:uppercase;" placeholder="Usuario" id="Usuario" name="Usuario">
                  </div>
                </div>
                <div class="form-group">
                  <label class="label">Contraseña</label>
                  <div class="input-group">
                    <div class="input-group-append">
                      <span class="input-group-text" style="border:1px solid #dadada;border-radius:0px;padding:10px;">
                        <i class="mdi mdi-account-key"></i>
                      </span>
                    </div>                    
                    <input type="password" class="form-control" placeholder="*********" id="Clave" name="Clave" style="border:1px solid #e4e4e4;border-radius:0px;text-transform:uppercase;">
                  </div>
                </div>
                <div class="form-group">
                  <button onclick="IngresoClick(); return false;" class="btn btn-primary submit-btn btn-block">Ingresar</button>
                </div>
              </form>
            </div>
            <ul class="auth-footer">
            </ul>
            <p class="footer-text text-center">Copyright © 2020.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  
<?php
include 'Etiqueta/PieDePagina.php';
?>

</body>

</html>

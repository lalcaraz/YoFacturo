<?php
if (doCheckLoginStatus())
{
    $Fiscal_RazonSocial="";
    $Fiscal_RFC="";
    $Fiscal_Domicilio="";
    $Fiscal_Ciudad="";
    $Fiscal_Estado="";
    $Fiscal_CP="";
    $Fiscal_Regimen="";
    $IVA="";
    
    $Expedicion_Lugar="";
    $Expedicion_Domicilio="";
    $Expedicion_Ciudad="";
    $Expedicion_Estado="";
    $Expedicion_CP="";
    $Expedicion_Telefono="";
    
    
    $Sicofi_Numero="";
    $Sicofi_Fecha="";
    $Sicofi_CodigoQR="qrcode.png";
    
    $Contador_Nombre="";
    $Contador_Domicilio="";
    $Contador_Ciudad="";
    $Contador_Estado="";
    $Contador_CP="";
    $Contador_Telefono="";
    
    $Usuario_Email="";
?>
    <div class="row">
        <div class="col-lg-2"> &nbsp; </div>
        <div class="col-lg-8">
            <blockquote>
                <p>Configuración</p> <cite>Tu información fiscal, algunos parámetros de la interfaz y algo más.</cite>
            </blockquote>
            <div class="panel">
                <div class="panel-heading">Tu información Fiscal</div>
                <form class="form-horizontal" method="post" action="">
                    <div class="form-group">
                        <label for="RazonSocial" class="col-lg-2 control-label">Razón Social</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="RazonSocial" name="RazonSocial" placeholder="Nombre registrado ante el SAT y/o la SHCP" onchange="document.getElementById('botonGuardar_InfoFiscal').disabled = false;" value="<?php echo $Fiscal_RazonSocial; ?>">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="RFC" class="col-lg-2 control-label">Registro Federal de Contribuyente</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="RFC" name="RFC" placeholder="Registro otorgado por el SAT y/o la SHCP" onchange="document.getElementById('botonGuardar_InfoFiscal').disabled = false;" value="<?php echo $Fiscal_RFC; ?>">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="Domicilio" class="col-lg-2 control-label">Domicilio Fiscal</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="Domicilio" name="Domicilio" placeholder="Domicilio fiscal (calle, numero exterior y colonia) registrado ante el SAT y/o la SHCP" onchange="document.getElementById('botonGuardar_InfoFiscal').disabled = false;" value="<?php echo $Fiscal_Domicilio; ?>">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="Ciudad" class="col-lg-2 control-label">Ciudad</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="Ciudad" name="Ciudad" placeholder="Ciudad donde estásregistrado ante el SAT y/o la SHCP" onchange="document.getElementById('botonGuardar_InfoFiscal').disabled = false;" value="<?php echo $Fiscal_Ciudad; ?>">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="Estado" class="col-lg-2 control-label">Estado</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="Estado" name="Estado" placeholder="Estado donde estás registrado ante el SAT y/o la SHCP" onchange="document.getElementById('botonGuardar_InfoFiscal').disabled = false;" value="<?php echo $Fiscal_Estado; ?>">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="CP" class="col-lg-2 control-label">Código Postal</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="CP" name="CP" placeholder="Código postal donde estás registrado ante el SAT y/o la SHCP" onchange="document.getElementById('botonGuardar_InfoFiscal').disabled = false;" value="<?php echo $Fiscal_CP; ?>">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="Regimen" class="col-lg-2 control-label">Régimen Fiscal</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="Regimen" name="Regimen" placeholder="Régimen Fiscal asignado por el SAT y/o la SHCP" onchange="document.getElementById('botonGuardar_InfoFiscal').disabled = false;" value="<?php echo $Fiscal_Regimen; ?>">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="IVA" class="col-lg-2 control-label">Porcentaje de IVA a cobrar</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="IVA" name="IVA" placeholder="IVA que debe recaudar, asignado por el SAT y/o la SHCP" onchange="document.getElementById('botonGuardar_InfoFiscal').disabled = false;" value="<?php echo $IVA; ?>">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <center><button id="botonGuardar_InfoFiscal" name="botonGuardar_InfoFiscal" type="submit" class="btn btn-default" disabled>Guardar cambios</button></center>
                    </div>
                </form>
            </div>
            
            
            <div class="panel">
                <div class="panel-heading">¿Donde se expiden tus facturas?</div>
                <form class="form-horizontal" method="post" action="">
                    
                    <div class="form-group">
                        <label for="Lugar" class="col-lg-2 control-label">Lugar de Expedición</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="Lugar" name="Lugar" placeholder="Lugar donde expides tus facturas (Sucursal, Oficina, Región)" onchange="document.getElementById('botonGuardar_InfoExpedicion').disabled = false;" value="<?php echo $Expedicion_Lugar; ?>">
                        </div>
                    </div>
                        
                    <div class="form-group">
                        <label for="Domicilio" class="col-lg-2 control-label">Domicilio de Expedición</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="Domicilio" name="Domicilio" placeholder="Domicilio donde donde expides tus facturas" onchange="document.getElementById('botonGuardar_InfoExpedicion').disabled = false;" value="<?php echo $Expedicion_Domicilio; ?>">
                        </div>
                    </div>
                        
                    <div class="form-group">
                        <label for="Ciudad" class="col-lg-2 control-label">Ciudad</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="Ciudad" name="Ciudad" placeholder="Ciudad donde expides tus facturas" onchange="document.getElementById('botonGuardar_InfoExpedicion').disabled = false;" value="<?php echo $Expedicion_Ciudad; ?>">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="Estado" class="col-lg-2 control-label">Estado</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="Estado" name="Estado" placeholder="Estado donde expides tus facturas" onchange="document.getElementById('botonGuardar_InfoExpedicion').disabled = false;" value="<?php echo $Expedicion_Estado; ?>">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="CP" class="col-lg-2 control-label">Código Postal</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="CP" name="CP" placeholder="Código postal donde expides tus facturas" onchange="document.getElementById('botonGuardar_InfoExpedicion').disabled = false;" value="<?php echo $Expedicion_CP; ?>">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="Telefono" class="col-lg-2 control-label">Teléfono</label>
                        <div class="col-lg-10">
                            <input type="tel" class="form-control" id="Telefono" name="Telefono" placeholder="Teléfono para contactar a quien expide las facturas." onchange="document.getElementById('botonGuardar_InfoExpedicion').disabled = false;" value="<?php echo $Expedicion_Telefono; ?>">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <center><button id="botonGuardar_InfoExpedicion" name="botonGuardar_InfoExpedicion" type="submit" class="btn btn-default" disabled>Guardar cambios</button></center>
                    </div>
                </form>
            </div>
            
            
            <div class="panel">
                <div class="panel-heading">Información sobre el Código de Barras Bidimensional (CBB)</div>
                <form class="form-horizontal" method="post" enctype="multipart/form-data" action="">
                    <div class="form-group">
                        <label for="Sicofi" class="col-lg-2 control-label">Número de Aprobación SICOFI</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="Sicofi" name="Sicofi" placeholder="Número SICOFI otorgado por el SAT y/o la SHCP" onchange="document.getElementById('botonGuardar_InfoSicofi').disabled = false;" value="<?php echo $Sicofi_Numero; ?>">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="FechaSicofi" class="col-lg-2 control-label">Fecha de solicitud de Número SICOFI</label>
                        <div class="col-lg-10">
                            <input type="date" class="form-control" id="FechaSicofi" name="FechaSicofi" placeholder="Fecha de autorización del número SICOFI por el SAT y/o la SHCP. Ejemplo: Dia/Mes/Año" onchange="document.getElementById('botonGuardar_InfoSicofi').disabled = false;"value="<?php echo $Sicofi_Fecha; ?>">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="codigoQR" class="col-lg-2 control-label">Código QR</label>
                        <div class="col-lg-10">
                            <img src="user/<?php echo $Sicofi_CodigoQR; ?>" class="img-thumbnail" alt="<?php echo $Fiscal_RFC;?>">
                            <input type="file" value="" name="qrcode" id="qrcode" onchange="document.getElementById('botonGuardar_InfoSicofi').disabled = false;" accept="image/*">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <center><button id="botonGuardar_InfoSicofi" name="botonGuardar_InfoSicofi" type="submit" class="btn btn-default" disabled>Guardar cambios</button></center>
                    </div>
                </form>
            </div>
            
            
            
            <div class="panel">
                <div class="panel-heading">Información de tu Contador Público de confianza</div>
                <form class="form-horizontal" method="post" enctype="multipart/form-data" action="">
                    <div class="form-group">
                        <label for="Nombre" class="col-lg-2 control-label">Nombre</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="Nombre" name="Nombre" placeholder="Nombre de tu contador o despacho de contador preferido" onchange="document.getElementById('botonGuardar_InfoContador').disabled = false;" value="<?php echo $Contador_Nombre; ?>">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="Domicilio" class="col-lg-2 control-label">Domicilio</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="Domicilio" name="Domicilio" placeholder="Domicilio de tu contador" onchange="document.getElementById('botonGuardar_InfoContador').disabled = false;" value="<?php echo $Contador_Domicilio; ?>">
                        </div>
                    </div>
                        
                    <div class="form-group">
                        <label for="Ciudad" class="col-lg-2 control-label">Ciudad</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="Ciudad" name="Ciudad" placeholder="Ciudad donde reside tu contador" onchange="document.getElementById('botonGuardar_InfoContador').disabled = false;" value="<?php echo $Contador_Ciudad; ?>">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="Estado" class="col-lg-2 control-label">Estado</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="Estado" name="Estado" placeholder="Estado donde reside tu contador" onchange="document.getElementById('botonGuardar_InfoContador').disabled = false;" value="<?php echo $Contador_Estado; ?>">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="CP" class="col-lg-2 control-label">Código Postal</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="CP" name="CP" placeholder="Código postal donde reside tu contador" onchange="document.getElementById('botonGuardar_InfoContador').disabled = false;" value="<?php echo $Contador_CP; ?>">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="Telefono" class="col-lg-2 control-label">Teléfono</label>
                        <div class="col-lg-10">
                            <input type="tel" class="form-control" id="Telefono" name="Telefono" placeholder="Teléfono para contactar a tu contador." onchange="document.getElementById('botonGuardar_InfoContador').disabled = false;" value="<?php echo $Contador_Telefono; ?>">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <center><button id="botonGuardar_InfoContador" name="botonGuardar_InfoContador" type="submit" class="btn btn-default" disabled>Guardar cambios</button></center>
                    </div>
                </form>
            </div>
            
            
            <div class="panel">
                <div class="panel-heading">Información de acceso a la plataforma</div>
                <form class="form-horizontal" method="post" enctype="multipart/form-data" action="">
                    <div class="form-group">
                        <label for="Sicofi" class="col-lg-2 control-label">Correo Electrónico</label>
                        <div class="col-lg-10">
                            <input type="email" class="form-control" id="Sicofi" name="Sicofi" placeholder="Correo electrónico con el cual accedes aqui." onchange="document.getElementById('botonGuardar_InfoAcceso').disabled = false;" value="<?php echo $Usuario_Email; ?>">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="password0" class="col-lg-2 control-label">Contraseña actual</label>
                        <div class="col-lg-10">
                            <input type="password" class="form-control" id="password0" name="password0" placeholder="Escribe tu actual contraseña" onchange="document.getElementById('botonGuardar_InfoAcceso').disabled = false;">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="password1" class="col-lg-2 control-label">Contraseña nueva</label>
                        <div class="col-lg-10">
                            <input type="password" class="form-control" id="password1" name="password1" placeholder="Escribe tu nueva contraseña" onchange="document.getElementById('botonGuardar_InfoAcceso').disabled = false;">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="password2" class="col-lg-2 control-label">Confirmar contraseña nueva</label>
                        <div class="col-lg-10">
                            <input type="password" class="form-control" id="password2" name="password2" placeholder="Confirma tu nueva contraseña" onchange="document.getElementById('botonGuardar_InfoAcceso').disabled = false;">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <center><button id="botonGuardar_InfoAcceso" name="botonGuardar_InfoAcceso" type="submit" class="btn btn-default" disabled>Guardar cambios</button></center>
                    </div>
                </form>
            </div>
            
            
        </div>
        <div class="col-lg-2"> &nbsp; </div>
    </div>
<?php
}
else
    echo "No existe una sesión válida para acceder a éste recurso. <a href='index.php?action=logout'> Haga click aqui para corregirlo</a>";
?>
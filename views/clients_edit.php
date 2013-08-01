<?php
include_once ('functions/math.php');
if (doCheckLoginStatus())
{
    
$Cliente_Nombre='Diverza S.A.P.I. de C.V.';
$Cliente_RFC='XXX-XXXXXX-XXX';
$Cliente_Calle='Known Address 125';
$Cliente_Ciudad='Monterrey';
$Cliente_Estado='NL';
$Cliente_CP='64000';
$Cliente_Telefono='8110014102';
?>

<blockquote>
    <p>Editar Cliente</p> <cite>Mantenga los datos actualizados. Las facturas siempre deben tener los datos correctos.</cite>
</blockquote>

<form class="form-horizontal">
    
    <div class="form-group">
        <label for="RazonSocial" class="col-lg-2 control-label">Razón Social del Cliente</label>
        <div class="col-lg-10">
            <input type="text" class="form-control" id="RazonSocial" name="RazonSocial" placeholder="Nombre registrado ante el SAT y/o la SHCP" value="<?php echo $Cliente_Nombre;?>">
        </div>
    </div>
    
    <div class="form-group">
        <label for="RFC" class="col-lg-2 control-label">Registro Federal de Contribuyente</label>
        <div class="col-lg-10">
            <input type="text" class="form-control" id="RFC" name="RFC" placeholder="Registro asignado por el SAT y/o la SHCP al Cliente" value="<?php echo $Cliente_RFC;?>">
        </div>
    </div>
    
    <div class="form-group">
        <label for="Calle" class="col-lg-2 control-label">Calle y Número y Colonia</label>
        <div class="col-lg-10">
            <input type="text" class="form-control" id="Calle" name="Calle" placeholder="Domicilio Fiscal del Cliente" value="<?php echo $Cliente_Calle;?>">
        </div>
    </div>
    
    <div class="form-group">
        <label for="Ciudad" class="col-lg-2 control-label">Ciudad</label>
        <div class="col-lg-10">
            <input type="text" class="form-control" id="Ciudad" name="Ciudad" placeholder="Ciudad donde reside el Cliente" value="<?php echo $Cliente_Ciudad;?>">
        </div>
    </div>
    
    <div class="form-group">
        <label for="Estado" class="col-lg-2 control-label">Estado</label>
        <div class="col-lg-10">
            <input type="text" class="form-control" id="Estado" name="Estado" placeholder="Estado donde reside el Cliente" value="<?php echo $Cliente_Estado;?>">
        </div>
    </div>
    
    <div class="form-group">
        <label for="CodigoPostal" class="col-lg-2 control-label">Código Postal</label>
        <div class="col-lg-10">
            <input type="text" class="form-control" id="CodigoPostal" name="CodigoPostal" placeholder="Código Postal donde reside el Cliente" value="<?php echo $Cliente_CP;?>">
        </div>
    </div>
    
    <div class="form-group">
        <label for="Telefono" class="col-lg-2 control-label">Teléfono</label>
        <div class="col-lg-10">
            <input type="text" class="form-control" id="Telefono" name="Telefono" placeholder="Número Telefónico del Cliente, con clave de Larga Distancia" value="<?php echo $Cliente_Telefono;?>">
        </div>
    </div>
    
    <div class="form-group">
        <div class="pull-right">
            <a href="?view=clients" class="btn btn-danger">Cancelar</a>
            <button type="submit" class="btn btn-default">Guardar</button>
        </div>
    </div>
</form>

<?php
}
else
    echo "No existe una sesión válida para acceder a éste recurso. <a href='index.php?action=logout'> Haga click aqui para corregirlo</a>";
?>
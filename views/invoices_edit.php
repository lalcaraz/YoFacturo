<?php
include_once ('functions/math.php');
if (doCheckLoginStatus())
{

$FechaHoy = date("d").'/'.date("m").'/'.date('Y');
    
$Folio = 'A001';
$ClienteID=4;
$TotalFactura = '0.00';
$Cliente_Nombre = 'Diverza S.A.P.I. de C.V.';
$FechaEmision = '31/7/2013';
$IVA = 16;
$Partidas = '1, Servicio de Consultoría, 500.00
5, Servicio de Papelería (copias), 4.00
3, Traslados y otros, 40.00';
?>

<blockquote>
    <p>Factura Folio <strong><?php echo $Folio;?></strong></p> <cite>Por $<?php echo $TotalFactura;?>, emitida para <?php echo $Cliente_Nombre;?> el <?php echo $FechaEmision;?></cite>
</blockquote>

<form class="form-horizontal">
    
    <div class="form-group">
        <label for="ClienteID" class="col-lg-2 control-label">Cliente</label>
        <div class="col-lg-10">
            <select class="form-control" id="ClienteID" name="ClienteID">
                <option value="1">Diverza</option>
                <option value="2">Afirme</option>
                <option value="3">General Electric</option>
                <option value="4">Nuga-Sys</option>
                <option value="5">PepsiCo</option>
            </select>
        </div>
    </div>
    
    <div class="form-group">
        <label for="FechaEmision" class="col-lg-2 control-label">Fecha de Emisión</label>
        <div class="col-lg-10">
            <input type="date" class="form-control" id="FechaEmision" name="FechaEmision" value="31/07/2013" placeholder="Dia/Mes/Año">
        </div>
    </div>
    
    <div class="form-group">
        <label for="IVA" class="col-lg-2 control-label">Porcentaje de IVA a aplicar</label>
        <div class="col-lg-10">
            <input type="text" class="form-control" id="IVA" name="IVA" title="Este valor es configurable desde las opciones de emisión de facturas." readonly value="<?php echo $IVA;?>%">
        </div>
    </div>
    
    <div class="form-group">
        <label for="Partidas" class="col-lg-2 control-label">Partidas</label>
        <div class="col-lg-10">
            <div class="alert alert-block">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <h4>¡Acuérdate!</h4>
                <p>Por conveniencia, las partidas se escriben en separados por coma.</p>
                <p>El formato que debe seguirse es una partida por linea, cada elemento separado por una coma. Primero la cantidad en unidades, después la descripción y finalmente el precio por unidad sin IVA (éste se agrega en automático) y sin el símbolo de pesos. Al terminar la linea se presiona ENTER para iniciar una nueva.</p>
                <p>Ejemplo:</p>
                <p>1, Servicio de Consultoría, 500.00<br>5, Servicio de Papelería (copias), 4.00<br>3, Traslados y otros, 40.00</p>
            </div>
            <textarea class="form-control" rows="6" id="Partidas" name="Partidas" placeholder="Unidad, Descripción, Precio Unitario"><?php echo $Partidas;?></textarea>
        </div>
    </div>
    
    <div class="form-group">
        <div class="pull-right">
            <a href="?view=invoices" class="btn btn-danger">Cancelar</a>
            <button type="submit" class="btn btn-default">Guardar</button>
        </div>
    </div>
</form>

<?php
}
else
    echo "No existe una sesión válida para acceder a éste recurso. <a href='index.php?action=logout'> Haga click aqui para corregirlo</a>";
?>
<?php
include_once ('functions/math.php');
if (doCheckLoginStatus())
{
?>

<blockquote>
    <p>Nueva Factura</p> <cite>Genere una nueva factura. Elija el Cliente y las cantidades.</cite>
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
            <input type="text" class="form-control" id="FechaEmision" name="FechaEmision" value="<?php echo date("d").'/'.date("m").'/'.date("Y");?>" placeholder="Dia/Mes/Año">
        </div>
    </div>
    
    <div class="form-group">
        <label for="PorcentajeIVA" class="col-lg-2 control-label">Porcentaje de IVA a aplicar</label>
        <div class="col-lg-10">
            <select class="form-control" id="PorcentajeIVA" name="PorcentajeIVA">
                <option value="0">0% - Alim y Medicinas</option>
                <option value="10">10% - Zona Fronteriza</option>
                <option value="16" selected>16% - General</option>
            </select>
        </div>
    </div>
    
    <div class="form-group">
        <label for="Partidas" class="col-lg-2 control-label">Partidas</label>
        <div class="col-lg-10">
            <div class="alert alert-block">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <h4>¡Atención!</h4>
                <p>Por conveniencia, las partidas se escriben en separados por coma.</p>
                <p>El formato que debe seguirse es una partida por linea, cada elemento separado por una coma. Primero la cantidad en unidades, después la descripción y finalmente el precio por unidad sin IVA (éste se agrega en automático) y sin el símbolo de pesos. Al terminar la linea se presiona ENTER para iniciar una nueva.</p>
                <p>Ejemplo:</p>
                <p>1, Servicio de Consultoría, 500.00<br>5, Servicio de Papelería (copias), 4.00<br>3, Traslados y otros, 40.00</p>
            </div>
            <textarea class="form-control" rows="6" id="Partidas" name="Partidas" placeholder="Unidad, Descripción, Precio Unitario"></textarea>
        </div>
    </div>
    
    <div class="form-group">
        <label for="Descuento" class="col-lg-2 control-label">Descuento</label>
        <div class="col-lg-10">
            <input type="text" class="form-control" id="Descuento" name="Descuento" placeholder="Indique la cantidad numérica a descontar del Subtotal (ANTES del IVA) o coloque en forma de porcentaje.">
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
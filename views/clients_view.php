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

$Fiscal_IVA=16;
$FacturasEmitidas = array (
                            0 => array ("folio" => "A005", "cliente" => "Diverza",          "subtotal" => "3525.8", "estado" => 0),
                            1 => array ("folio" => "A004", "cliente" => "General Electric", "subtotal" => "4233.6", "estado" => 1),
                            2 => array ("folio" => "A003", "cliente" => "PepsiCo",          "subtotal" => "6674.77","estado" => 2),
                            3 => array ("folio" => "A002", "cliente" => "PepsiCo",          "subtotal" => "1238.98","estado" => 1),
                            4 => array ("folio" => "A001", "cliente" => "FEMSA",            "subtotal" => "6776.12","estado" => 0),
                            );
?>

<blockquote>
    <p>Información del Cliente</p> <cite>Verifica que los datos son correctos y vea las facturas que le has emitido.</cite>
</blockquote>

<form class="form-horizontal">
    
    <div class="form-group">
        <label for="RazonSocial" class="col-lg-2 control-label">Razón Social del Cliente</label>
        <div class="col-lg-10">
            <input type="text" class="form-control" id="RazonSocial" name="RazonSocial" placeholder="Nombre registrado ante el SAT y/o la SHCP" value="<?php echo $Cliente_Nombre;?>" readonly>
        </div>
    </div>
    
    <div class="form-group">
        <label for="RFC" class="col-lg-2 control-label">Registro Federal de Contribuyente</label>
        <div class="col-lg-10">
            <input type="text" class="form-control" id="RFC" name="RFC" placeholder="Registro asignado por el SAT y/o la SHCP al Cliente" value="<?php echo $Cliente_RFC;?>" readonly>
        </div>
    </div>
    
    <div class="form-group">
        <label for="Calle" class="col-lg-2 control-label">Calle y Número y Colonia</label>
        <div class="col-lg-10">
            <input type="text" class="form-control" id="Calle" name="Calle" placeholder="Domicilio Fiscal del Cliente" value="<?php echo $Cliente_Calle;?>" readonly>
        </div>
    </div>
    
    <div class="form-group">
        <label for="Ciudad" class="col-lg-2 control-label">Ciudad</label>
        <div class="col-lg-10">
            <input type="text" class="form-control" id="Ciudad" name="Ciudad" placeholder="Ciudad donde reside el Cliente" value="<?php echo $Cliente_Ciudad;?>" readonly>
        </div>
    </div>
    
    <div class="form-group">
        <label for="Estado" class="col-lg-2 control-label">Estado</label>
        <div class="col-lg-10">
            <input type="text" class="form-control" id="Estado" name="Estado" placeholder="Estado donde reside el Cliente" value="<?php echo $Cliente_Estado;?>" readonly>
        </div>
    </div>
    
    <div class="form-group">
        <label for="CodigoPostal" class="col-lg-2 control-label">Código Postal</label>
        <div class="col-lg-10">
            <input type="text" class="form-control" id="CodigoPostal" name="CodigoPostal" placeholder="Código Postal donde reside el Cliente" value="<?php echo $Cliente_CP;?>" readonly>
        </div>
    </div>
    
    <div class="form-group">
        <label for="Telefono" class="col-lg-2 control-label">Teléfono</label>
        <div class="col-lg-10">
            <input type="text" class="form-control" id="Telefono" name="Telefono" placeholder="Número Telefónico del Cliente, con clave de Larga Distancia" value="<?php echo $Cliente_Telefono;?>" readonly>
        </div>
    </div>
</form>

<table class="table table-hover">
    <thead>
        <tr>
            <td><center><strong>Folio</strong></center></td>
            <td><center><strong>Cliente</strong></center></td>
            <td><center><strong>Subtotal</strong></center></td>
            <td><center><strong>IVA</strong></center></td>
            <td><center><strong>Total</strong></center></td>
            <td><center><strong>Estado</strong></center></td>
            <td><center>&nbsp;</center></td>
        </tr>
    </thead>
    <tbody>
	    <?php foreach($FacturasEmitidas as $Factura)
	        {
	    ?>
	    <tr>
	        <td><center><a href="?view=invoices&invoiceID=<?php echo $Factura['folio'];?>&action=view" style="text-decoration:none;"><?php echo $Factura['folio'];?></a></center></td>
	        <td><center><?php echo $Factura['cliente'];?></center></td>
	        <td><center>$<?php echo number_format((float)$Factura['subtotal'], 2, '.', '');?></center></td>
	        <td><center>$<?php echo number_format((float)$Factura['subtotal']*(intval($Fiscal_IVA)/100), 2, '.', '');?></center></td>
	        <td><center>$<?php echo number_format((float)$Factura['subtotal']*(number_format((float)(intval($Fiscal_IVA)/100)+1.0, 2, '.', '')), 2, '.', '');;?></center></td>
	        <td>
	            <center>
	                <?php
	                    switch($Factura['estado'])
	                    {
	                        case 0: echo "Borrador"; break;
	                        case 1: echo "Emitida"; break;
	                        case 2: echo "Cancelada"; break;
	                    }
	                ?>
	            </center>
	        </td>
	        <td><center>
	                <?php
	                    switch($Factura['estado'])
	                    {
	                        case 0: //Estado = Borrador
	                ?>
	                <a href="?view=invoices&invoiceID=<?php echo $Factura['folio'];?>&action=generate">
	                	<span class="label label-success" style="width:60px; float:left; height:20px;">Emitir</span>
	                </a>
	                <span style="width:5px; float:left; height:20px;"> &nbsp; </span>
	                <a href="?view=invoices&invoiceID=<?php echo $Factura['folio'];?>&action=cancel">
	                	<span class="label label-danger" style="width:60px; float:left; height:20px;">Cancelar</span>
	                </a>
	                <span style="width:5px; float:left; height:20px;"> &nbsp; </span>
	                <a href="?view=invoices&invoiceID=<?php echo $Factura['folio'];?>&action=edit">
	                	<span class="label label-warning" style="width:60px; float:left; height:20px;">Editar</span>
	                </a>
	                <?php
	                            break;
	                        case 1: // Estado = Emitida
	                ?>
	                <a href="?view=invoices&invoiceID=<?php echo $Factura['folio'];?>&action=cancel">
	                	<span class="label label-danger" style="width:93px; float:left; height:20px;">Cancelar</span>
	                </a>
	                <span style="width:5px; float:left; height:20px;"> &nbsp; </span>
	                <!-- Solo utilizar si hay espacio en el disco para guardar las facturas.
                    <a href="?view=invoices&invoiceID=<?php echo $Factura['folio'];?>&action=pdf">
                    	<span class="label label-info" style="width:92px; float:left; height:20px;">PDF</span>
                    </a>
                    -->
                    <a href="functions/doGeneratePDFInvoice.php?invoiceID=<?php echo $Factura['folio'];?>" target="_blank">
                    	<span class="label label-info" style="width:92px; float:left; height:20px;">PDF</span>
                    </a>
	                <!--
	                <span style="width:5px; float:left; height:20px;"> &nbsp; </span>
	                <a href="?view=invoices&invoiceID=<?php echo $Factura['folio'];?>&action=view">
	                	<span class="label" style="width:60px; float:left; height:20px;">Ver</span>
	                </a>
	                -->
	                <?php
	                            break;
	                        case 2: // Estado = Cancelada
	                ?>
	                <!--
	                <a href="?view=invoices&invoiceID=<?php echo $Factura['folio'];?>&action=view">
	                	<span class="label" style="width:60px; float:left; height:20px;">Ver</span>
	                </a>
	                -->
	                <?php
	                            break;
	                    }
	                ?>
	            </center>
	        </td>
	    </tr>
	    <?php
	        }
	    ?>
	</tbody>
</table>
<div>        <!-- Paginador -->
    <ul class="pager">
      <li class="previous"><a href="#">&larr; Más Recientes</a></li>
      <li class="next"><a href="#">Más Antigüos &rarr;</a></li>
    </ul>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="pull-right">
            <a href="?view=clients" class="btn btn-default">Cerrar</a>
        </div>
    </div>
</div>

<div class="height:50px;"> &nbsp; </div>

<?php
}
else
    echo "No existe una sesión válida para acceder a éste recurso. <a href='index.php?action=logout'> Haga click aqui para corregirlo</a>";
?>
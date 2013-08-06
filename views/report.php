<?php
if (doCheckLoginStatus())
{
	include_once('functions/math.php');

    $Fiscal_IVA=16;
    $FacturasEmitidas = array (
                                0 => array ("folio" => "A005", "cliente" => "Diverza",          "subtotal" => "3525.8", "estado" => 1),
                                1 => array ("folio" => "A004", "cliente" => "General Electric", "subtotal" => "4233.6", "estado" => 1),
                                2 => array ("folio" => "A003", "cliente" => "PepsiCo",          "subtotal" => "6674.77","estado" => 1),
                                3 => array ("folio" => "A002", "cliente" => "PepsiCo",          "subtotal" => "1238.98","estado" => 1),
                                4 => array ("folio" => "A001", "cliente" => "FEMSA",            "subtotal" => "6776.12","estado" => 1),
                                );
	if ( (!isset($_GET['month'])) or (empty($_GET['month'])) )
		{$_GET['month'] = intval(date("m"));}
	if ( (intval($_GET['month']) > 0) and (intval($_GET['month']) < 13) and (intval($_GET['month']) <= date("m")) )
	{
	
?>
    <div class="row">
        <div class="col-lg-2"> &nbsp; </div>
        <div class="col-lg-8">
            <blockquote>
                <p>Reportes</p> <cite>Reporte de facturas emitidas para el mes de <?php echo nombreMes(intval($_GET['month']));?> de 2013. Las canceladas o en borrador no cuentan.</cite>
            </blockquote>
            <div style="text-align: center; text-decoration: none; height: 50px;">
            	<?php
            		for($x=1;$x<=date("m");$x++)
            		{
            			if ($x != 1) echo "|";
	            		if ($x == $_GET['month']) echo " ".nombreMes(intval($x))." ";
	            		else echo "<a href='?view=report&month=".$x."'> ".nombreMes(intval($x))." </a>";
            		}
            	?>
            </div>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <td><center><strong>Folio</strong></center></td>
                        <td><center><strong>Cliente</strong></center></td>
                        <td><center><strong>Subtotal</strong></center></td>
                        <td><center><strong>IVA</strong></center></td>
                        <td><center><strong>Total</strong></center></td>
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
                        <td><center>$<?php echo number_format((float)$Factura['subtotal']*(number_format((float)(intval($Fiscal_IVA)/100)+1.0, 2, '.', '')), 2, '.', '');?></center></td>
                    </tr>
                    <?php
                        }
                    ?>
                </tbody>
            </table>
            
            <center><a href='functions/doReportInvoices.php?month=<?php echo intval($_GET['month']);?>' target="_blank" style="text-decoration:none;">Descargar en PDF</a></center>
            <br>
        </div>
        <div class="col-lg-2"> &nbsp; </div>
    </div>
<?php
    }
    else
    {
    	if (intval($_GET['month']) > 12) echo "<center>Ese mes no existe en el Calendario Gregoriano. ¿Cómo mides tus meses?</center><br>";
    	else
	    if (intval($_GET['month']) > date("m")) echo "<center>Para ese mes, aun no tengo información. Apenas estamos en ".nombreMes(intval(date("m"))).".</center><br>";
    }
?>
<?php
}
else
    echo "No existe una sesión válida para acceder a éste recurso. <a href='index.php?action=logout'> Haga click aqui para corregirlo</a>";
?>
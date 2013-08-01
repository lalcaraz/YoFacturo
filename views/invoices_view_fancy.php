<?php
include_once ('functions/math.php');
if (doCheckLoginStatus())
{
?>

<blockquote>
    <p>Factura Folio <strong>A001</strong></p> <cite>Por $0.00, emitida para Diverza S.A.P.I. de C.V. el 31/7/2013</cite>
</blockquote>

<div class="panel panel-primary">
    <div class="panel-heading"> <h3 class="panel-title"> &nbsp; </h3> </div>

    <div class="row">
        <div class="col-lg-6 col-offset-6">
            <address>
                <strong>John Dow Gómez</strong><br>
                AALL-830901-6M6 <br>
                795 Folsom Ave, Suite 600<br>
                San Francisco, CA 94107<br>
                Régimen Fiscal de las Personas Fisicas con Actividad Empresarial o Profesional<br>
            </address>
        </div>
    </div>
    
    <div class="row">
        <div class="col-lg-5 col-offset-1">
            <strong>Folio: A001</strong><br>
            Fecha: 31/7/2013<br>
            Estado: BORRADOR<br>
            Tipo de Pago: Una exhibición.<br>
            Vencimiento: 31/7/2013
        </div>
        <div class="col-lg-6">
            <strong>Expedido en:</strong>
            <address>
                Building 7 <br>
                795 Folsom Ave, Suite 600<br>
                San Francisco, CA 94107<br>
                Tel. 55-5555-5925
            </address>
        </div>
    </div>
    
    <div style="width:100%; height:2px; background:#418bca;">&nbsp;</div>
    <div style="width:100%; height:10px;>&nbsp;"></div>
    
    <div class="row">
        <div class="col-lg-12">
            <div class="pull-right">Lugar de Emisión, a DIA de MES de AÑO</div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-lg-12">
            <center><h1>FACTURA</h1></center>
        </div>
    </div>
    
    <div class="row">
        <div class="col-lg-5 col-offset-1">
            <strong>CLIENTE</strong><br>
            XXXX-123456-ABC<br>
            <br>
            CALLE Y NUMERO<br>
            COLONIA, CODIGO POSTAL<br>
            MUNICIPIO, ESTADO<br>
            TELEFONO<br>
        </div>
    </div>
    
    <div style="width:100%; height:20px;>&nbsp;"></div>
    
    <div class="row">
        <div class="col-lg-10 col-offset-1">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <td><center><strong>Partida</strong></center></td>
                        <td><center><strong>Cantidad</strong></center></td>
                        <td><center><strong>Descripción</strong></center></td>
                        <td><center><strong>Precio Unitario</strong></center></td>
                        <td><center><strong>Precio</strong></center></td>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $SubTotal=0;
                        $IVA=16;
                        for($x=1; $x<=3; $x++)
                        {
                        $Cantidad = rand(4,45);
                        $PrecioUnitario = rand (22,$x*10);
                        $Precio = intval($Cantidad)*intval($PrecioUnitario);
                    ?>
                    <tr>
                        <td><center><?php echo $x;?></center></td>
                        <td><center><?php echo $Cantidad; ?></center></td>
                        <td><center>Descripción</center></td>
                        <td><center>$<?php echo $PrecioUnitario;?></center></td>
                        <td><center>$<?php echo $Precio; ?></center></td>
                        
                    </tr>
                    <?php
                        $SubTotal += $Precio;
                        }
                    ?>
                    <tr>
                        <td colspan="4" style="text-align:right;">Subtotal</td>
                        <td><center>$<?php echo $SubTotal; ?></center></td>
                    </tr>
                    <tr>
                        <td colspan="3"><center><?php echo num2letras($SubTotal*1.16);?></center></td>
                        <td style="text-align:right;">IVA (<?php echo $IVA;?>%)</td>
                        <td><center>$<?php echo $SubTotal*($IVA/100); ?></center></td>
                    </tr>
                    <tr>
                        <td colspan="3"><center>Pago mediante transferencia electrónica.</center></td>
                        <td style="text-align:right;"><strong>Total</strong></td>
                        <td><center>$<?php echo $SubTotal*1.16; ?></center></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    
    <div style="width:100%; height:20px;>&nbsp;"></div>
    
    <div class="row">
        <div class="col-lg-4">
                <!-- Aqui va la imágen del Código QR -->
            <?php $qrCode = 'http://chart.apis.google.com/chart?cht=qr&chs=200x200&chl=www.lalcaraz.com&chld=H|0'; ?>
           <center><img src=<?php echo '"'.$qrCode.'"';?>> </center> 
        </div>
        <div class="col-lg-8">
            NUMERO DE APROBACION SICOFI: <strong><?php echo 'XXXXXX';?></strong> <br><br>
            LA REPRODUCCIÓN APÓCRIFA DE ESTE COMPROBANTE CONSTITUYE UN DELITO EN LOS TÉRMINOS DE LAS DISPOSICIONES FISCALES.<br><br>
            ESTE COMPROBANTE TENDRÁ UNA VIGENCIA DE DOS AÑOS A PARTIR DE LA FECHA DE APROBACIÓN DE LA ASIGNACIÓN DE FOLIOS LA CUAL ES:  <strong><?php echo '20/12/2012';?></strong><br><br>
PAGO EN UNA SOLA EXHIBICIÓN
        </div>
    </div>
    
    <div class="panel-footer" style="height:40px;"><div class="pull-right"> &nbsp; </div></div>
</div>

<div class="row">
    <div class="col-lg-2 col-offset-10">
        <a href="?view=invoices" class="btn btn-default">Cerrar</a>
    </div>
</div>

 <div style="width:100%; height:20px;>&nbsp;"></div>

<?php
}
else
    echo "No existe una sesión válida para acceder a éste recurso. <a href='index.php?action=logout'> Haga click aqui para corregirlo</a>";
?>
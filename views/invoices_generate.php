<?php
if (doCheckLoginStatus())
{
    $Folio = 'A001';
    $TotalFactura = '0.00';
    $Cliente_Nombre = 'Diverza S.A.P.I. de C.V.';
    $FechaEmision = '31/7/2013';
?>

<blockquote>
    <p>Factura Folio <strong><?php echo $Folio;?></strong></p> <cite>Por $<?php echo $TotalFactura;?>, emitida para <?php echo $Cliente_Nombre;?> el <?php echo $FechaEmision;?></cite>
</blockquote>
<div class="panel panel-primary">
    <div class="panel-heading"> <h3 class="panel-title">Factura Sellada Digitalmente </h3> </div>
    La factura ha sido firmada y emitida correctamente.<br>
    Ya puede descargarse en <a href="?view=invoices&invoiceID=<?php echo $Folio;?>&action=pdf">PDF aqui</a>.
</div>

<div class="row">
    <div class="col-lg-2 col-offset-10">
        <a href="?view=invoices" class="btn btn-default">Continuar</a>
    </div>
</div>

<div style="width:100%; height:20px;>&nbsp;"></div>

<?php
}
else
    echo "No existe una sesión válida para acceder a éste recurso. <a href='index.php?action=logout'> Haga click aqui para corregirlo</a>";
?>
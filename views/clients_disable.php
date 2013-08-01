<?php
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
    <p>Cliente <strong><?php echo $Cliente_Nombre;?></strong></p> <cite>Con RFC <?php echo $Cliente_RFC; ?> que reside en <?php echo $Cliente_Ciudad; ?>, <?php echo $Cliente_Estado; ?></cite>
</blockquote>
<div class="panel panel-danger">
    <div class="panel-heading"> <h3 class="panel-title">Cliente Desactivado </h3> </div>
    El cliente ha sido desactivado.<br>
    Ya no puede emitirle nuevas facturas hasta que lo vuelva a habilitar. Las facturas ya emitidas no serán afectadas.
</div>

<div class="row">
    <div class="col-lg-2 col-offset-10">
        <a href="?view=clients" class="btn btn-default">Continuar</a>
    </div>
</div>

<div style="width:100%; height:20px;>&nbsp;"></div>

<?php
}
else
    echo "No existe una sesión válida para acceder a éste recurso. <a href='index.php?action=logout'> Haga click aqui para corregirlo</a>";
?>
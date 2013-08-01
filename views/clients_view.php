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
        <?php for($x=1; $x<=10; $x++)
            {
            $RandomNum = rand(10,$x*10);
        ?>
        <tr>
            <td><center>A<?php echo ($x < 10 ? '00': '0').$x;?></center></td>
            <td><center>Cliente Random</center></td>
            <td><center>$<?php echo $RandomNum; ?>.00</center></td>
            <td><center>$<?php echo $RandomNum*0.16;?></center></td>
            <td><center>$<?php echo $RandomNum*1.16;?></center></td>
            <td><center>Emitida</center></td>
            <td><center>
                    <a href="?view=invoices&invoiceID=1&action=generate"><span class="label label-success">Emitir</span></a>
                    <a href="?view=invoices&invoiceID=1&action=cancel"><span class="label label-danger">Cancelar</span></a>
                    <a href="?view=invoices&invoiceID=1&action=edit"><span class="label label-warning">Editar</span></a>
                    <a href="?view=invoices&invoiceID=1&action=pdf"><span class="label label-info">PDF</span></a>
                    <a href="?view=invoices&invoiceID=1&action=view"><span class="label">Ver</span></a>
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
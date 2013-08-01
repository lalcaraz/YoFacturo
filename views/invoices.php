<?php
if (doCheckLoginStatus())
{
?>
    <div class="row">
        <div class="col-lg-2"> &nbsp; </div>
        <div class="col-lg-8">
            <?php 
            if ( (isset($_GET['invoiceID'])) and ( (!empty($_GET['invoiceID'])) and ($_GET['invoiceID'] != null) ) )
                {?>
                                <!-- Muestra la factura que se solicita -->
            <?php
                $InvoiceToAffect=$_GET['invoiceID'];    // Factura que va a utilizarse para las acciones.
                switch ($_GET['action'])
                {
                    case 'view': include_once ('views/invoices_view.php');
                        break;
                    case 'edit': include_once ('views/invoices_edit.php');
                        break;
                    case 'pdf': include_once ('views/invoices_pdf.php');
                        break;
                    case 'cancel': include_once ('views/invoices_cancel.php');
                        break;
                    case 'generate': include_once ('views/invoices_generate.php');
                        break;
                    default: echo "Opción no válida, <a href='?view=invoices'>Haga click aqui para regresar al listado.<br>";
                        break;
                }
            ?>
            <?php }
            else
            if ( (isset($_GET['action'])) and ( (!empty($_GET['action'])) and ($_GET['action'] != null) ) )
                {?>
                                <!-- Código para acciones como Editar, Nuevo, PDF, Cancelar,  -->
            <?php
                switch ($_GET['action'])
                {
                    case 'new': include_once('views/invoices_new.php');
                        break;
                    default: echo "Opción no válida, <a href='?view=invoices'>Haga click aqui para regresar al listado.<br>";
                        break;
                }
            ?>
            <?php }
            else
                {?>
            <blockquote>
                <p>Facturas</p> <cite>Controla tus facturas emitidas, cancela las que no fueron pagadas o realiza borradores para proteger folios a futuro.</cite>
            </blockquote>
            
            <div class="pull-right"><a href='?view=invoices&action=new' class="btn btn-default btn-mini">Nueva Factura</a></div>
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

              <?php } ?>
        </div>
        <div class="col-lg-2"> &nbsp; </div>
    </div>
<?php
}
else
    echo "No existe una sesión válida para acceder a éste recurso. <a href='index.php?action=logout'> Haga click aqui para corregirlo</a>";
?>
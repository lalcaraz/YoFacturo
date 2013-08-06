<?php
if (doCheckLoginStatus())
{
    $Fiscal_IVA=16;
    $FacturasEmitidas = array (
                                0 => array ("folio" => "A005", "cliente" => "Diverza",          "subtotal" => "3525.8", "estado" => 0),
                                1 => array ("folio" => "A004", "cliente" => "General Electric", "subtotal" => "4233.6", "estado" => 1),
                                2 => array ("folio" => "A003", "cliente" => "PepsiCo",          "subtotal" => "6674.77","estado" => 2),
                                3 => array ("folio" => "A002", "cliente" => "PepsiCo",          "subtotal" => "1238.98","estado" => 1),
                                4 => array ("folio" => "A001", "cliente" => "FEMSA",            "subtotal" => "6776.12","estado" => 0),
                                );
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
                                <a href="?view=invoices&invoiceID=<?php echo $Factura['folio'];?>&action=pdf">
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

              <?php } ?>
        </div>
        <div class="col-lg-2"> &nbsp; </div>
    </div>
<?php
}
else
    echo "No existe una sesión válida para acceder a éste recurso. <a href='index.php?action=logout'> Haga click aqui para corregirlo</a>";
?>
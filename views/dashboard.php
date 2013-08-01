<?php
if (doCheckLoginStatus())
{
?>
    <div class="row">
        <div class="col-lg-2"> &nbsp; </div>
        <div class="col-lg-8">
            
            <div> <!-- Se muestra un resúmen rápido de la plataforma -->
                <div class="jumbotron">
                    <h1>Hola ¡<?php echo $_SESSION['LoggedUser'];?>!</h1>
                    <p><small>Al dia de hoy mas emitido <?php $TotalFacturas=12; echo $TotalFacturas." "; echo ($TotalFacturas<=1 ? "factura" : "facturas"); ?> en el mes.</small></p>
                    <p><small>Has agregado <?php $TotalClientes=1; echo $TotalClientes." "; echo ($TotalClientes<=1 ? "nuevo cliente" : "nuevos clientes"); ?> en el mes.</small></p>
                    <p><a class="btn btn-primary btn-mini pull-right">Generar Reporte</a></p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6"> <!-- Se muestran las últimas facturas emitidas. -->
                    <blockquote>
                        <p>Tus últimas 5 facturas emitidas</p>
                    </blockquote>
                    
                    <div class="pull-right"><a href="?view=invoices&action=new" class="btn btn-default btn-mini">Nueva Factura</a></div>
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
                            <?php for($x=1; $x<=5; $x++)
                                {
                                $RandomNum = rand(10,$x*10);
                            ?>
                            <tr>
                                <td>A<?php echo ($x < 10 ? '00': '0').$x;?></td>
                                <td>Cliente Random</td>
                                <td>$<?php echo $RandomNum; ?>.00</td>
                                <td>$<?php echo $RandomNum*0.16;?></td>
                                <td>$<?php echo $RandomNum*1.16;?></td>
                            </tr>
                            <?php
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="col-lg-6"> <!-- Se muestra los clientes y el porcentaje de facturas emitidas. -->
                    <blockquote>
                        <p>Tus mejores 5 clientes</p>
                    </blockquote>
                    
                    <div class="pull-right"><button type="button" class="btn btn-default btn-mini">Nuevo Cliente</button></div>
                    <div style="height: 40px;"> &nbsp; </div>
                    <div id="chart_div" style="width:100%; height: 250px;"></div>
                </div>
            </div>
            
            <div> <!-- Se muestran opciones de configuración y otros -->
                <div class="panel"> <!-- Información de cómo estás facturando -->
                    <!-- Default panel contents -->
                    <div class="panel-heading">Resúmen de Emisiones</div>
                    <p>
                        <div class="row">
                            <div class="col-lg-4">
                                Tu Contador es:
                                <address>
                                    <strong>Contador</strong><br>
                                    795 Folsom Ave, Suite 600<br>
                                    San Francisco, CA 94107<br>
                                    <abbr title="Phone">P:</abbr> (123) 456-7890
                                </address>
                            </div>
                            <div class="col-lg-4">
                                Tus facturas se emiten en:
                                <address>
                                    <strong>Emision</strong><br>
                                    795 Folsom Ave, Suite 600<br>
                                    San Francisco, CA 94107<br>
                                    <abbr title="Phone">P:</abbr> (123) 456-7890
                                </address>
                            </div>
                            <div class="col-lg-4">
                                Tu dirección fiscal es:
                                <address>
                                    <strong>Dir. Fiscal</strong><br>
                                    795 Folsom Ave, Suite 600<br>
                                    San Francisco, CA 94107<br>
                                    <abbr title="Phone">P:</abbr> (123) 456-7890
                                </address>
                            </div>
                        </div>
                        
                    </p>
                    
                    <!-- List group -->
                    <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        Hoy es <?php echo date("d");?> de <?php echo date("M"); ?>. Faltan <?php echo (intval(cal_days_in_month(CAL_GREGORIAN, date("m"), date("Y"))) - intval(date("d")) );?> dias para cerrar el mes.
                        <div class="progress progress-striped">
                            <div class="progress-bar progress-bar-info" style="width: <?php echo intval( (intval(date("d")) * 100)/(intval(date("m"))) );?>%;"></div>
                        </div>
                        Haz capturado <?php echo "totalfacturaspormes(".intval(date("m")).")"; ?> facturas de las cuales has emitido correctamente <?php echo "totalfacturasemitidaspormes(".intval(date("m")).")"; ?> y has cancelado <?php echo "totalfacturascanceladaspormes(".intval(date("m")).")"; ?>.
                    </li>
                    <li class="list-group-item">El total del IVA a pagar por éste mes es de <?php echo "TIVAPorMes(".intval(date("m")).")";?> y el total percibido sin IVA es de <?php echo "SubtotalPorMes(".intval(date("m")).")";?>.</li>
                    <li class="list-group-item">
                        Se han capturado <small><?php echo "10"; ?></small> facturas en total.

                        <div class="progress">
                            <div class="progress-bar progress-bar-success" style="width: 70%">Emitidas</div> <!-- Emitidas -->
                            <div class="progress-bar progress-bar-danger" style="width: 10%">Canceladas</div> <!-- Canceladas -->
                            <div class="progress-bar progress-bar-info" style="width: 20%">Borrador</div> <!-- Borrador -->
                        </div>
                    </li>
                    <li class="list-group-item">Tienes <?php echo "totalclientes"; ?> clientes capturados y has facturado a <?php echo "totalclientesconfactura";?> clientes.</li>
                    
                    <li class="list-group-item">Estoy siendo ejecutado en el servidor <?php  echo $_SERVER['SERVER_NAME'].' - '.$_SERVER['SERVER_ADDR']; ?> con éstas versiones de software: <?php echo $_SERVER['SERVER_SOFTWARE'];?>.</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-lg-2"> &nbsp; </div>
    </div>
<?php
}
else
    echo "No existe una sesión válida para acceder a éste recurso. <a href='index.php?action=logout'> Haga click aqui para corregirlo</a>";
?>
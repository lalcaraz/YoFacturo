<?php
if (doCheckLoginStatus())
{
    require_once ('functions/math.php');    
    $TotalFacturasEsteMes = array ("total" => 7, "emitidas" => 6, "canceladas" => 1, "borrador" => 0);
    $TotalNuevosClientesEsteMes = 4;
    $TotalIvaEsteMes = 200.00;
    $SubtotalEsteMes = 5425.80;
    $TotalFacturasGlobal = array ("total" => 114, "emitidas" => 94, "canceladas" => 16, "borrador" => 4);
    $PorcentajesFacturasGlobal = array ("emitidas"   => doGetPercent($TotalFacturasGlobal['total'],$TotalFacturasGlobal['emitidas']),
                                        "canceladas" => doGetPercent($TotalFacturasGlobal['total'],$TotalFacturasGlobal['canceladas']),
                                        "borrador"   => doGetPercent($TotalFacturasGlobal['total'],$TotalFacturasGlobal['borrador']));
    $TotalClientesGlobal = array ("total" => 32, "con_factura" => 23);
    
    $Fiscal_RazonSocial="";
    $Fiscal_RFC="";
    $Fiscal_Domicilio="";
    $Fiscal_Ciudad="";
    $Fiscal_Estado="";
    $Fiscal_CP="";
    $Fiscal_Regimen="";
    $Fiscal_IVA="16";
    
    $Expedicion_Lugar="";
    $Expedicion_Domicilio="";
    $Expedicion_Ciudad="";
    $Expedicion_Estado="";
    $Expedicion_CP="";
    $Expedicion_Telefono="";
    
    $Contador_Nombre="";
    $Contador_Domicilio="";
    $Contador_Ciudad="";
    $Contador_Estado="";
    $Contador_CP="";
    $Contador_Telefono="";
    
    $Ultimas5FacturasEmitidas = array (
                                        0 => array ("folio" => "A005", "cliente" => "Diverza",          "subtotal" => "3525.8"),
                                        1 => array ("folio" => "A004", "cliente" => "General Electric", "subtotal" => "4233.6"),
                                        2 => array ("folio" => "A003", "cliente" => "PepsiCo",          "subtotal" => "6674.77"),
                                        3 => array ("folio" => "A002", "cliente" => "PepsiCo",          "subtotal" => "1238.98"),
                                        4 => array ("folio" => "A001", "cliente" => "FEMSA",            "subtotal" => "6776.12"),
                                        );
?>
    <div class="row">
        <div class="col-lg-2"> &nbsp; </div>
        <div class="col-lg-8">
            
            <div> <!-- Se muestra un resúmen rápido de la plataforma -->
                <div class="jumbotron">
                    <h1>Hola ¡<?php echo $_SESSION['LoggedUser'];?>!</h1>
                    <p><small>Al dia de hoy mas emitido <?php echo $TotalFacturasEsteMes['emitidas']." "; echo ($TotalFacturasEsteMes['total']<=1 ? "factura" : "facturas"); ?> en el mes.</small></p>
                    <p><small>Has agregado <?php  echo $TotalNuevosClientesEsteMes." "; echo ($TotalNuevosClientesEsteMes<=1 ? "nuevo cliente" : "nuevos clientes"); ?> en el mes.</small></p>
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
                            <?php foreach($Ultimas5FacturasEmitidas as $Factura)
                                {
                            ?>
                            <tr>
                                <td><?php echo $Factura['folio'];?></td>
                                <td><?php echo $Factura['cliente'];?></td>
                                <td>$<?php echo number_format((float)$Factura['subtotal'], 2, '.', '');?></td>
                                <td>$<?php echo number_format((float)$Factura['subtotal']*(intval($Fiscal_IVA)/100), 2, '.', '');?></td>
                                <td>$<?php echo number_format((float)$Factura['subtotal']*(number_format((float)(intval($Fiscal_IVA)/100)+1.0, 2, '.', '')), 2, '.', '');;?></td>
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
                                    <strong><?php echo $Contador_Nombre;?></strong><br>
                                    <?php echo $Contador_Domicilio;?><br>
                                    <?php echo $Contador_Ciudad;?>, <?php echo $Contador_Estado;?> <?php echo $Contador_CP;?><br>
                                    <abbr title="Teléfono">T:</abbr> <?php echo $Contador_Telefono;?>
                                </address>
                            </div>
                            <div class="col-lg-4">
                                Tus facturas se emiten en:
                                <address>
                                    <strong><?php echo $Expedicion_Lugar;?></strong><br>
                                    <?php echo $Expedicion_Domicilio;?><br>
                                    <?php echo $Expedicion_Ciudad;?>, <?php echo $Expedicion_Estado;?> <?php echo $Expedicion_CP;?><br>
                                    <abbr title="Teléfono">T:</abbr> <?php echo $Expedicion_Telefono;?>
                                </address>
                            </div>
                            <div class="col-lg-4">
                                Tu dirección fiscal es:
                                <address>
                                    <strong><?php echo $Fiscal_RazonSocial;?></strong><br>
                                    <?php echo $Fiscal_Domicilio;?><br>
                                    <?php echo $Fiscal_Ciudad;?>, <?php echo $Fiscal_Estado;?> <?php echo $Fiscal_CP;?><br>
                                    <abbr title="Registro Federal de Contribuyente">RFC:</abbr> <?php echo $Fiscal_RFC;?>
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
                        Haz capturado <?php echo $TotalFacturasEsteMes['total']; ?> facturas de las cuales has emitido correctamente <?php echo $TotalFacturasEsteMes['emitidas']; ?> y has cancelado <?php echo $TotalFacturasEsteMes['canceladas']; ?>.
                    </li>
                    <li class="list-group-item">El total del IVA a pagar por éste mes es de $<?php echo number_format((float)$TotalIvaEsteMes, 2, '.', '');?>MXN y el total percibido sin IVA es de $<?php echo number_format((float)$SubtotalEsteMes, 2, '.', '');?>MXN.</li>
                    <li class="list-group-item">
                        Se han capturado <small><?php echo $TotalFacturasGlobal['total']; ?></small> facturas en total.

                        <div class="progress">
                            <div class="progress-bar progress-bar-success" style="width: <?php echo round($PorcentajesFacturasGlobal['emitidas']);?>%">Emitidas</div> <!-- Emitidas -->
                            <div class="progress-bar progress-bar-danger" style="width: <?php echo round($PorcentajesFacturasGlobal['canceladas']);?>%">Canceladas</div> <!-- Canceladas -->
                            <div class="progress-bar progress-bar-info" style="width: <?php echo round($PorcentajesFacturasGlobal['borrador']);?>%">Borrador</div> <!-- Borrador -->
                        </div>
                    </li>
                    <li class="list-group-item">Tienes <?php echo $TotalClientesGlobal['total']." "; echo ($TotalClientesGlobal['total']<=1 ? "cliente capturado" : "clientes capturados"); ?> y has facturado a <?php echo $TotalClientesGlobal['con_factura']." "; echo ($TotalClientesGlobal['con_factura']<=1 ? "cliente" : "clientes"); ?></li>
                    
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
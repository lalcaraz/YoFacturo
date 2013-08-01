<?php
include_once ('functions/math.php');
require_once("helpers/dompdf/dompdf_config.inc.php"); // Librería para generar el PDF

if (doCheckLoginStatus())
{
$HTMLCode = '<!DOCTYPE html>
    <html lang="es">
    <head>
        <title>YoFacturo</title>
        <meta http-equiv="content-type" content="text/html; charset=utf-8">
    </head>
    <body>
    </body>
    </html>';

$Fiscales_Nombre='John Dow Gómez';
$Fiscales_RFC='AALL-830901-6M6';
$Fiscales_Direccion='795 Folsom Ave, Suite 600';
$Fiscales_Ciudad='San Francisco';
$Fiscales_Estado='CA';
$Fiscales_CP='89178';
$Fiscales_Regimen='de las Personas Fisicas con Actividad Empresarial o Profesional';

$Folio = 'A001';
$Estado = 'BORRADOR';
$FechaEmision = '31/7/2013';
$FechaEmision_Explode = explode('/',$FechaEmision);
$Vencimiento = '31/7/2013';
    
$Expedido_Edificio='Building 7';
$Expedido_Calle='795 Folsom Ave, Suite 600';
$Expedido_Ciudad='San Francisco';
$Expedido_Estado='CA';
$Expedido_CP='94107';
$Expedido_Telefono='55-555-5925';
    
$Cliente_Nombre='Diverza S.A.P.I. de C.V.';
$Cliente_RFC='XXX-XXXXXX-XXX';
$Cliente_Calle='Known Address 125';
$Cliente_Ciudad='Monterrey';
$Cliente_Estado='NL';
$Cliente_CP='64000';
$Cliente_Telefono='8110014102';

$IVA=16;
$Partidas = '1, Servicio de Consultoría, 500.20
5, Servicio de Papelería (copias), 4.44
3, Traslados y otros, 40.12';
    
$qrCode = 'user/qrcode.png';
$Sicofi = 'XXXXXX';
$VigenciaSicofi = '20/8/2016';

$FormaPago='transferencia electrónica';

$HTMLCode = '
    
        <table style="width:100%; font-size: 13px; border: 2px solid #418bca;">
            <tr>
                <td colspan="2" style="width:100%; height: 30px; background:#418bca;">
                </td>
            </tr>
            <tr>
                <td colspan="2" style="width:100%; height: 25px; ">
                </td>
            </tr>
            <tr>
                <td style="width:50%;">
                </td>
                <td style="width:50%;  padding-left:40px;">
                    <b>'.$Fiscales_Nombre.'</b><br>
                    '.$Fiscales_RFC.' <br>
                    '.$Fiscales_Direccion.'<br>
                    '.$Fiscales_Ciudad.', '.$Fiscales_Estado.' '.$Fiscales_CP.'<br>
                    Régimen Fiscal '.$Fiscales_Regimen.'<br>
                </td>
            </tr>
            <tr>
                <td style="width:50%; padding-left:50px;">
                    <b>Folio: '.$Folio.'</b><br>
                    Fecha: '.$FechaEmision.'<br>
                    Estado: '.$Estado.'<br>
                    Tipo de Pago: Una exhibición.<br>
                    Vencimiento: '.$Vencimiento.'
                </td>
                <td style="width:50%; padding-left:40px;">
                    <b>Expedido en:</b>
                    '.$Expedido_Edificio.' <br>
                    '.$Expedido_Calle.'<br>
                    '.$Expedido_Ciudad.', '.$Expedido_Estado.' '.$Expedido_CP.'<br>
                    Tel. '.$Expedido_Telefono.'
                </td>
            </tr>
            <tr>
                <td colspan="2" style="width:100%; height: 25px; ">
                </td>
            </tr>
            <tr>
                <td colspan="2" style="width:100%; height: 1px; background:#418bca;">
                </td>
            </tr>
            <tr>
                <td colspan="2" style="width:100%; height: 25px; ">
                </td>
            </tr>
            <tr>
                <td style="width:100%; padding-right:20px;" colspan="2" align="right">
                    '.$Expedido_Ciudad.', '.$Expedido_Estado.', '.$FechaEmision_Explode[0].' de '.nombreMes(intval($FechaEmision_Explode[1])).' de '.$FechaEmision_Explode[2].'
                </td>
            </tr>
            <tr>
                <td style="width:100%;" colspan="2">
                    <center><h1>FACTURA</h1></center>
                </td>
            </tr>
            <tr>
                <td style="width:50%; padding-left: 30px;">
                    <b>'.$Cliente_Nombre.'</b><br>
                    '.$Cliente_RFC.'<br>
                    <br>
                    '.$Cliente_Calle.'<br>
                    '.$Cliente_Ciudad.', '.$Cliente_Estado.' '.$Cliente_CP.'<br>
                    '.$Cliente_Telefono.'<br>
                </td>
                <td style="width:50%;">
                </td>
            </tr>
            <tr>
                <td colspan="2" style="width:100%; height: 25px; ">
                </td>
            </tr>
            <tr>
                <td colspan="2" style="width: 100%;">';
        $HTMLCode .= '
                    <table style="width: 70%;" align="center">
                        <tr>
                            <td><center><b>Partida</b></center></td>
                            <td><center><b>Cantidad</b></center></td>
                            <td><center><b>Descripción</b></center></td>
                            <td><center><b>Precio Unitario</b></center></td>
                            <td><center><b>Precio</strong></b></td>
                        </tr>'; 
                            $SubTotal=0;
                            $x=1;
                            $PartidasSeparadas = explode("\n", $Partidas);
                            foreach ($PartidasSeparadas as $PartidaIndividual)
                            {
                                $PartidaPorElemento = explode(",", $PartidaIndividual);
                                $Cantidad = intval($PartidaPorElemento[0]);
                                $Descripcion = $PartidaPorElemento[1];
                                $PrecioUnitario = $PartidaPorElemento[2];
                                $Precio = $Cantidad*$PrecioUnitario;
                                $HTMLCode .= '
                                <tr>
                                    <td><center>'.$x.'</center></td>'.
                                    '<td><center>'.$Cantidad.'</center></td>'.
                                    '<td><center>'.$Descripcion.'</center></td>'.
                                    '<td><center>$'.number_format((float)$PrecioUnitario, 2, '.', '').'</center></td>'.
                                    '<td><center>$'.number_format((float)$Precio, 2, '.', '').'</center></td>'.
                                    
                                '</tr>';
                                $SubTotal += $Precio;
                                $x++;
                            }

                            
                        $HTMLCode .= 
                        '<tr>
                            <td colspan="5" style="height: 10px;"></td>
                        </tr>
                        <tr>
                            <td colspan="4" style="text-align:right;">Subtotal</td>
                            <td><center>'.number_format((float)$SubTotal, 2, '.', '').'</center></td>
                        </tr>
                        <tr>
                            <td colspan="3"><center>'.num2letras(number_format((float)$SubTotal*1.16, 2, '.', '')).'</center></td>
                            <td style="text-align:right;">IVA ('.number_format((float)$IVA, 2, '.', '').'%)</td>
                            <td><center>$'.number_format((float)$SubTotal*($IVA/100), 2, '.', '').'</center></td>
                        </tr>
                        <tr>
                            <td colspan="3"><center>Pago mediante '.$FormaPago.'</center></td>
                            <td style="text-align:right;"><b>Total</b></td>
                            <td><center>$'.number_format((float)$SubTotal*1.16, 2, '.', '').'</center></td>
                        </tr>
                    </table>';
    $HTMLCode .= '
                </td>
            </tr>
            <tr>
                <td colspan="2" style="width:100%; height: 20px; ">
                </td>
            </tr>
            <tr>
                <td style="width:50%;  padding-left:20px;">
                    <center><img src='.$qrCode.'></center>
                </td>
                <td style="width:50%;  padding-right:20px;">
                    NUMERO DE APROBACION SICOFI: <b>'.$Sicofi.'</b> <br><br>
            LA REPRODUCCIÓN APÓCRIFA DE ESTE COMPROBANTE CONSTITUYE UN DELITO EN LOS TÉRMINOS DE LAS DISPOSICIONES FISCALES.<br><br>
            ESTE COMPROBANTE TENDRÁ UNA VIGENCIA DE DOS AÑOS A PARTIR DE LA FECHA DE APROBACIÓN DE LA ASIGNACIÓN DE FOLIOS LA CUAL ES:  <b>'.$VigenciaSicofi.'</b><br><br>
PAGO EN UNA SOLA EXHIBICIÓN
                </td>
            </tr>
            <tr>
                <td colspan="2" style="width:100%; height: 20px; background: #cccccc; ">
                </td>
            </tr>
        </table>
    ';

    echo $HTMLCode; 
?>
    <div style="height: 50px;"></div>
    <div class="row">
        <div class="col-lg-2 col-offset-10">
            <a href="?view=invoices" class="btn btn-default">Cerrar</a>
        </div>
    </div>
    <div style="height: 50px;"></div>
<?php
}
else
    echo "No existe una sesión válida para acceder a éste recurso. <a href='index.php?action=logout'> Haga click aqui para corregirlo</a>";
?>
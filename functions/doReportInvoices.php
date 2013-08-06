<?php
if (isset($_GET['month']) and (!empty($_GET['month'])) and (intval($_GET['month']) < 12) and (intval($_GET['month']) > 1) and (intval($_GET['month']) <= date("m")) )
{

	function nombreMes($numero_mes)
	{
	    switch ($numero_mes)
	    {
	        case 1: return "Enero"; break;
	        case 2: return "Febrero"; break;
	        case 3: return "Marzo"; break;
	        case 4: return "Abril"; break;
	        case 5: return "Mayo"; break;
	        case 6: return "Junio"; break;
	        case 7: return "Julio"; break;
	        case 8: return "Agosto"; break;
	        case 9: return "Septiembre"; break;
	        case 10: return "Octubre"; break;
	        case 11: return "Noviembre"; break;
	        case 12: return "Diciembre"; break;
	        default: return null;
	    }
	}
	
	$Fiscal_IVA=16;
    $FacturasEmitidas = array (
                                0 => array ("folio" => "A001", "cliente" => "Diverza",          "subtotal" => "3525.8", "estado" => 1),
                                1 => array ("folio" => "A002", "cliente" => "General Electric", "subtotal" => "4233.6", "estado" => 1),
                                2 => array ("folio" => "A003", "cliente" => "PepsiCo",          "subtotal" => "6674.77","estado" => 1),
                                3 => array ("folio" => "A004", "cliente" => "PepsiCo",          "subtotal" => "1238.98","estado" => 1),
                                4 => array ("folio" => "A005", "cliente" => "FEMSA",            "subtotal" => "6776.12","estado" => 1),
                                5 => array ("folio" => "A006", "cliente" => "Diverza",          "subtotal" => "3525.8", "estado" => 1),
                                6 => array ("folio" => "A007", "cliente" => "General Electric", "subtotal" => "4233.6", "estado" => 1),
                                7 => array ("folio" => "A008", "cliente" => "PepsiCo",          "subtotal" => "6674.77","estado" => 1),
                                8 => array ("folio" => "A009", "cliente" => "PepsiCo",          "subtotal" => "1238.98","estado" => 1),
                                9 => array ("folio" => "A010", "cliente" => "FEMSA",            "subtotal" => "6776.12","estado" => 1),
                                );

	require_once("../helpers/dompdf/dompdf_config.inc.php"); // Librería para generar el PDF
	
	$FacturasTabla="";
	$TotalGeneral=0;
	$TotalIVA=0;
	$x=0;
	foreach($FacturasEmitidas as $Factura)
	{	
		$color = ($x%2 == 0)? '#d4d2c2': '#ebeae3';
		$FacturasTabla.='<tr style="background:'.$color.'; color:black; height: 30px;"><td><center>'.$Factura['folio'].'</center></td>'.
							'<td><center>'.$Factura['cliente'].'</center></td>'.
							'<td><center>$'.number_format((float)$Factura['subtotal'], 2, '.', '').'</center></td>'.
							'<td><center>$'.number_format((float)$Factura['subtotal']*(intval($Fiscal_IVA)/100), 2, '.', '').'</center></td>'.
							'<td><center>$'.number_format((float)$Factura['subtotal']*(number_format((float)(intval($Fiscal_IVA)/100)+1.0, 2, '.', '')), 2, '.', '').'</center></td></tr>';
		$TotalIVA += number_format((float)$Factura['subtotal']*(intval($Fiscal_IVA)/100), 2, '.', '');
		$TotalGeneral += number_format((float)$Factura['subtotal']*(number_format((float)(intval($Fiscal_IVA)/100)+1.0, 2, '.', '')), 2, '.', '');
		$x++;
	}
	
	$html =
	  '<html><body>'.
	  '<p style="text-align:center; font-size: 40px; height:55px; color: white; background: black;">Reporte de Facturas Emitidas</p>'.
	  '<p style="font-size: 20px; text-align:center; height:20px;"> Para el periodo del 1ro al '.intval(cal_days_in_month(CAL_GREGORIAN, date(intval($_GET['month'])), date("Y"))).' de '.nombreMes($_GET['month']).'</p>'.
	  '<br>'.
	  '<table style="width:70%;" align="center">
                <thead>
                    <tr style="font-weight:bold; text-align:center; font-size: 20px;">
                        <td>Folio</td>
                        <td>Cliente</td>
                        <td>Subtotal</td>
                        <td>IVA '.$Fiscal_IVA.'%</td>
                        <td>Total</td>
                    </tr>
                </thead>
                <tbody>
                	<tr><td colspan="5"></td></tr>';
                
     $html.= $FacturasTabla;
     $html.=	'</tbody>'.
            '</table>';
     $html.='<br>';
     $html.='<p style="height: 20px; text-align: right; width: 70%;">Total Facturas Emitidas - <strong>'.$x.'</strong></p>'.
     		'<p style="height: 20px; text-align: right; width: 70%;">Total IVA - <strong>$'.$TotalIVA.'</strong></p>'.
     		'<p style="height: 20px; text-align: right; width: 70%;">Gran Total - <strong>$'.$TotalGeneral.'</strong></p>';
     $html.='<p style="text-align:center; font-size: 20px; height:25px; color: white; background: black;">Reporte generado el '.date('d/m/Y h:i:s a', time()).'</p>';
     $html.=
	  '</body></html>';
	  
	
	$dompdf = new DOMPDF();
	$dompdf->load_html($html);
	$dompdf->render();
	$dompdf->stream("Facturas_".nombreMes($_GET['month'])."_2013.pdf");
	
}
?>
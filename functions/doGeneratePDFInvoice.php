<?php

require_once("../helpers/dompdf/dompdf_config.inc.php"); // Librería para generar el PDF

function num2letras($num, $fem = false, $dec = true) { 
   $matuni[2]  = "dos"; 
   $matuni[3]  = "tres"; 
   $matuni[4]  = "cuatro"; 
   $matuni[5]  = "cinco"; 
   $matuni[6]  = "seis"; 
   $matuni[7]  = "siete"; 
   $matuni[8]  = "ocho"; 
   $matuni[9]  = "nueve"; 
   $matuni[10] = "diez"; 
   $matuni[11] = "once"; 
   $matuni[12] = "doce"; 
   $matuni[13] = "trece"; 
   $matuni[14] = "catorce"; 
   $matuni[15] = "quince"; 
   $matuni[16] = "dieciseis"; 
   $matuni[17] = "diecisiete"; 
   $matuni[18] = "dieciocho"; 
   $matuni[19] = "diecinueve"; 
   $matuni[20] = "veinte"; 
   $matunisub[2] = "dos"; 
   $matunisub[3] = "tres"; 
   $matunisub[4] = "cuatro"; 
   $matunisub[5] = "quin"; 
   $matunisub[6] = "seis"; 
   $matunisub[7] = "sete"; 
   $matunisub[8] = "ocho"; 
   $matunisub[9] = "nove"; 

   $matdec[2] = "veint"; 
   $matdec[3] = "treinta"; 
   $matdec[4] = "cuarenta"; 
   $matdec[5] = "cincuenta"; 
   $matdec[6] = "sesenta"; 
   $matdec[7] = "setenta"; 
   $matdec[8] = "ochenta"; 
   $matdec[9] = "noventa"; 
   $matsub[3]  = 'mill'; 
   $matsub[5]  = 'bill'; 
   $matsub[7]  = 'mill'; 
   $matsub[9]  = 'trill'; 
   $matsub[11] = 'mill'; 
   $matsub[13] = 'bill'; 
   $matsub[15] = 'mill'; 
   $matmil[4]  = 'millones'; 
   $matmil[6]  = 'billones'; 
   $matmil[7]  = 'de billones'; 
   $matmil[8]  = 'millones de billones'; 
   $matmil[10] = 'trillones'; 
   $matmil[11] = 'de trillones'; 
   $matmil[12] = 'millones de trillones'; 
   $matmil[13] = 'de trillones'; 
   $matmil[14] = 'billones de trillones'; 
   $matmil[15] = 'de billones de trillones'; 
   $matmil[16] = 'millones de billones de trillones'; 
   
   //Zi hack
   $float=explode('.',$num);
   $num=$float[0];

   $num = trim((string)@$num); 
   if ($num[0] == '-') { 
      $neg = 'menos '; 
      $num = substr($num, 1); 
   }else 
      $neg = ''; 
   while ($num[0] == '0') $num = substr($num, 1); 
   if ($num[0] < '1' or $num[0] > 9) $num = '0' . $num; 
   $zeros = true; 
   $punt = false; 
   $ent = ''; 
   $fra = ''; 
   for ($c = 0; $c < strlen($num); $c++) { 
      $n = $num[$c]; 
      if (! (strpos(".,'''", $n) === false)) { 
         if ($punt) break; 
         else{ 
            $punt = true; 
            continue; 
         } 

      }elseif (! (strpos('0123456789', $n) === false)) { 
         if ($punt) { 
            if ($n != '0') $zeros = false; 
            $fra .= $n; 
         }else 

            $ent .= $n; 
      }else 

         break; 

   } 
   $ent = '     ' . $ent; 
   if ($dec and $fra and ! $zeros) { 
      $fin = ' coma'; 
      for ($n = 0; $n < strlen($fra); $n++) { 
         if (($s = $fra[$n]) == '0') 
            $fin .= ' cero'; 
         elseif ($s == '1') 
            $fin .= $fem ? ' una' : ' un'; 
         else 
            $fin .= ' ' . $matuni[$s]; 
      } 
   }else 
      $fin = ''; 
   if ((int)$ent === 0) return 'Cero ' . $fin; 
   $tex = ''; 
   $sub = 0; 
   $mils = 0; 
   $neutro = false; 
   while ( ($num = substr($ent, -3)) != '   ') { 
      $ent = substr($ent, 0, -3); 
      if (++$sub < 3 and $fem) { 
         $matuni[1] = 'una'; 
         $subcent = 'as'; 
      }else{ 
         $matuni[1] = $neutro ? 'un' : 'uno'; 
         $subcent = 'os'; 
      } 
      $t = ''; 
      $n2 = substr($num, 1); 
      if ($n2 == '00') { 
      }elseif ($n2 < 21) 
         $t = ' ' . $matuni[(int)$n2]; 
      elseif ($n2 < 30) { 
         $n3 = $num[2]; 
         if ($n3 != 0) $t = 'i' . $matuni[$n3]; 
         $n2 = $num[1]; 
         $t = ' ' . $matdec[$n2] . $t; 
      }else{ 
         $n3 = $num[2]; 
         if ($n3 != 0) $t = ' y ' . $matuni[$n3]; 
         $n2 = $num[1]; 
         $t = ' ' . $matdec[$n2] . $t; 
      } 
      $n = $num[0]; 
      if ($n == 1) { 
         $t = ' ciento' . $t; 
      }elseif ($n == 5){ 
         $t = ' ' . $matunisub[$n] . 'ient' . $subcent . $t; 
      }elseif ($n != 0){ 
         $t = ' ' . $matunisub[$n] . 'cient' . $subcent . $t; 
      } 
      if ($sub == 1) { 
      }elseif (! isset($matsub[$sub])) { 
         if ($num == 1) { 
            $t = ' mil'; 
         }elseif ($num > 1){ 
            $t .= ' mil'; 
         } 
      }elseif ($num == 1) { 
         $t .= ' ' . $matsub[$sub] . '?n'; 
      }elseif ($num > 1){ 
         $t .= ' ' . $matsub[$sub] . 'ones'; 
      }   
      if ($num == '000') $mils ++; 
      elseif ($mils != 0) { 
         if (isset($matmil[$sub])) $t .= ' ' . $matmil[$sub]; 
         $mils = 0; 
      } 
      $neutro = true; 
      $tex = $t . $tex; 
   } 
   $tex = $neg . substr($tex, 1) . $fin; 
   //Zi hack --> return ucfirst($tex);
   $end_num=ucfirst($tex).' pesos '.$float[1].'/100 M.N.';
   return $end_num; 
} 

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

if ( (isset($_GET['invoiceID'])) and ( !empty($_GET['invoiceID']) ) )
	{
    $FolioFactura = $_GET['invoiceID'];
 
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
        
    $qrCode = '../user/qrcode.png';
    $Sicofi = 'XXXXXX';
    $VigenciaSicofi = '20/8/2016';
    
    $FormaPago='transferencia electrónica';
    $HTMLCode = '<!DOCTYPE html>
        <html lang="es">
        <head>
            <title>YoFacturo</title>
            <meta http-equiv="content-type" content="text/html; charset=utf-8">
        </head>
        <body>
    ';
        
    $HTMLCode .= '
        
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
    $HTMLCode .= '    </body>
        </html>';
        //echo $HTMLCode;
        
        
        $dompdf = new DOMPDF();
        $dompdf->load_html($HTMLCode);
        $dompdf->set_paper("letter","portrait");
        $dompdf->render();
        
        $file_to_save = 'Factura_'.$Folio.'_'.$Cliente_Nombre.'.pdf';
        $dompdf->stream($file_to_save);
        
        
    }
    else
    	echo "Error";
?>
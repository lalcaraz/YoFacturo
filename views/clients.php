<?php
if (doCheckLoginStatus())
{
?>
    <div class="row">
        <div class="col-lg-2"> &nbsp; </div>
        <div class="col-lg-8">
            <?php 
            if ( (isset($_GET['clientID'])) and ( (!empty($_GET['clientID'])) and ($_GET['clientID'] != null) ) )
                {?>
                                <!-- Muestra la factura que se solicita -->
            <?php
                $InvoiceToAffect=$_GET['clientID'];    // Factura que va a utilizarse para las acciones.
                switch ($_GET['action'])
                {
                    case 'view': include_once ('views/clients_view.php');
                        break;
                    case 'edit': include_once ('views/clients_edit.php');
                        break;
                    case 'disable': include_once ('views/clients_disable.php');
                        break;
                    case 'enable': include_once ('views/clients_enable.php');
                        break;
                    default: echo "Opción no válida, <a href='?view=clients'>Haga click aqui para regresar al listado.<br>";
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
                    case 'new': include_once('views/clients_new.php');
                        break;
                    default: echo "Opción no válida, <a href='?view=clients'>Haga click aqui para regresar al listado.<br>";
                        break;
                }
            ?>
            <?php }
            else
                {?>
            <blockquote>
                <p>Clientes</p> <cite>Controla tus clientes, edita sus datos e inactiva a quienes ya no les facturas.</cite>
            </blockquote>
            
            <div class="pull-right"><a href='?view=clients&action=new' class="btn btn-default btn-mini">Nuevo Cliente</a></div>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <td><center><strong>RFC</strong></center></td>
                        <td><center><strong>Cliente</strong></center></td>
                        <td><center><strong>Localidad</strong></center></td>
                        <td><center><strong>Estado</strong></center></td>
                        <td><center>&nbsp;</center></td>
                    </tr>
                </thead>
                <tbody>
                    <?php for($x=1; $x<=10; $x++)
                        {
                        $RandomNum = rand(10,$x*10);
                        $Cliente_RFC='XXXX'.rand(1,9).rand(1,9).rand(1,9).rand(1,9).rand(1,9).rand(1,9).'XXX';
                        $Cliente_Nombre='Cliente Random '.rand(1,9);
                        $Cliente_Localidad='Aqui, alla';
                        $Cliente_Estado=rand(0,1);
                    ?>
                    <tr>
                        <td><center><a href="?view=clients&clientID=1&action=view" style="text-decoration: none;"><?php echo $Cliente_RFC;?></a></center></td>
                        <td><center><?php echo $Cliente_Nombre;?></center></td>
                        <td><center><?php echo $Cliente_Localidad;?></center></td>
                        <td><center><?php echo ($Cliente_Estado == 0 ? "Inactivo":"Activo");?></center></td>
                        <td>
                        	<?php 
                        	if ($Cliente_Estado == 0) /* Cliente Inactivo*/
                        		{?>
	                            <a href="?view=clients&clientID=1&action=enable"><span class="label label-success" style="width:50px; float:left; height:20px;">Activar</span></a>
	                            <span style="width:5px; float:left; height:20px;"> &nbsp; </span>
	                            <a href="?view=clients&clientID=1&action=edit"><span class="label label-info" style="width:50px; float:left; height:20px;">Editar</span></a>
                            <?php   
                            	}
                            else
                            	{
	                        ?>
	                        <a href="?view=clients&clientID=1&action=disable"><span class="label label-danger" style="width:105px; float:left; height:20px;">Desactivar</span></a>
	                        <?php
                            	}
                            ?>
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
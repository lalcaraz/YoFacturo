<div class="navbar navbar-inverse navbar-fixed-top">
    <a class="navbar-brand" href="?view=dashboard">YoFacturo</a>
    <?php if (doCheckLoginStatus()) {?>
    <ul class="nav navbar-nav pull-left">
        <li><a href="?view=invoices">Facturas</a></li>
        <li><a href="?view=clients">Clientes</a></li>
        <li><a href="?view=config">Configuración</a></li>
    </ul>
    <ul class="nav navbar-nav pull-right">
        <li><a href="?action=logout">Cerrar Sesión</a></li>
    </ul>
    <form class="navbar-form pull-right" method="post" action="">
        <input type="text" class="form-control" style="width: 130px;" placeholder="Folio de Factura">
        <button type="submit" class="btn btn-default">Mostrar</button>
    </form>
    <?php } ?>
</div>
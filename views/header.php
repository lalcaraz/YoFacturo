<div class="navbar navbar-inverse">
    <a class="navbar-brand" href="?view=dashboard">YoFacturo</a>
    <ul class="nav navbar-nav pull-left">
        <li><a href="?view=invoices">Facturas</a></li>
        <li><a href="?view=clients">Clientes</a></li>
        <li><a href="?view=config">Configuración</a></li>
    </ul>
    <ul class="nav navbar-nav pull-right">
        <?php if (doCheckLoginStatus()) {?> <li><a href="?action=logout">Cerrar Sesión</a></li> <?php } ?>
    </ul>
</div>
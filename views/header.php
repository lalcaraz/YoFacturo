<div class="navbar navbar-inverse navbar-fixed-top">
    <a class="navbar-brand" href="?view=dashboard">YoFacturo</a>
    <?php if (doCheckLoginStatus()) {?>
    <ul class="nav navbar-nav pull-left">
        <li><a href="?view=invoices">Facturas</a></li>
        <li><a href="?view=clients">Clientes</a></li>
        <li><a href="?view=config">Configuración</a></li>
        <li><a href="?view=report">Reporte de Facturación</a></li>
    </ul>
    <ul class="nav navbar-nav pull-right">
        <li><a href="?action=logout">Cerrar Sesión</a></li>
    </ul>
    <form class="navbar-form pull-right" method="get" action="index.php">
        <input type="text" class="form-control" style="width: 130px;" placeholder="Folio de Factura" name="invoiceID" id="invoiceID" onchange="document.getElementById('submit_VerFactura').disabled = false;">
        <input type="text" id="view" name="view" value="invoices" hidden>
        <input type="text" id="action" name="action" value="view" hidden>
        <button type="submit" class="btn btn-default" name="submit_VerFactura" id="submit_VerFactura" disabled>Mostrar</button>
    </form>
    <?php } ?>
</div>